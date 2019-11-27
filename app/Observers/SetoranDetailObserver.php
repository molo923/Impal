<?php

namespace App\Observers;

use App\Observers\Traits\HandleStatus;
use App\SetoranDetail;

class SetoranDetailObserver
{
    use HandleStatus;

    public function created(SetoranDetail $setoranDetail)
    {
        if ($this->isSelesai($setoranDetail)
            && $this->isSelesai($setoranDetail->pivotParent)) {

            $this->updateStok($setoranDetail);
        }

        $setoranDetail->update([
            'store_price' => $setoranDetail->sub_total/$setoranDetail->weight
        ]);
    }

    public function saving(SetoranDetail $setoranDetail)
    {

        if ($setoranDetail->pivotParent->isDirty('status_id')
            && $this->isSelesai($setoranDetail->pivotParent)) {

            $this->setStatusSelesai($setoranDetail);
            $this->updateStok($setoranDetail);
        }

        if ($setoranDetail->pivotParent->isDirty('status_id')
            && $this->isReject($setoranDetail->pivotParent)) {

            $this->setStatusReject($setoranDetail);
            $this->updateStok($setoranDetail);
        }
    }

    private function updateStok($item): void
    {
        if ($this->isReject($item)) {

            $this->addRejectQuantity($item);
        } else {

            $this->addQuantity($item);
        }
    }

    private function addRejectQuantity($item): void
    {
        $item->kategorisampah->stok()->update([
            'quantity_reject' => $item->kategorisampah->stok->first()->quantity_reject + (double) $item->weight,
        ]);
    }

    private function addQuantity($item): void
    {
        $item->kategorisampah->stok()->update([
            'quantity_' . $item->setoran->type => $item->kategorisampah->stok->first()->{'quantity_' . $item->setoran->type} + (double) $item->weight,
        ]);
    }
}
