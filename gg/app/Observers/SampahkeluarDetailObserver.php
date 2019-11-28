<?php

namespace App\Observers;

use App\Observers\Traits\HandleStatus;
use App\SampahkeluarDetail;

class SampahkeluarDetailObserver
{
    use HandleStatus;

    public function created(SampahkeluarDetail $sampahkeluarDetail)
    {
        if ($this->isSelesai($sampahkeluarDetail)
            && $this->isSelesai($sampahkeluarDetail->pivotParent)) {

            $this->updateStok($sampahkeluarDetail);
        }
    }

    public function saving(SampahkeluarDetail $sampahkeluarDetail)
    {

        if ($sampahkeluarDetail->pivotParent->isDirty('status_id')
            && $this->isSelesai($sampahkeluarDetail->pivotParent)) {

            $this->setStatusSelesai($sampahkeluarDetail);
            $this->updateStok($sampahkeluarDetail);
        }

        if ($sampahkeluarDetail->pivotParent->isDirty('status_id')
            && $this->isReject($sampahkeluarDetail->pivotParent)) {

            $this->setStatusReject($sampahkeluarDetail);
            $this->updateStok($sampahkeluarDetail);
        }
    }

    private function updateStok($item): void
    {
        if ($this->isReject($item)) {

            $this->addJualRejectQuantity($item);
        } else {

            $this->addQuantity($item);
        }
    }

    private function addJualRejectQuantity($item): void
    {
        $item->kategorisampah->stok()->update([
            'quantity_jual_reject' => $item->kategorisampah->stok->first()->quantity_jual_reject + (double) $item->weight,
        ]);
    }

    private function addQuantity($item): void
    {
        $item->kategorisampah->stok()->update([
            'quantity_' . $item->sampahkeluar->type => $item->kategorisampah->stok->first()->{'quantity_' . $item->sampahkeluar->type} + (double) $item->weight,
        ]);
    }
}
