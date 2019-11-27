<?php


namespace App\Observers\Traits;


trait HandleStatus
{
    private function isSelesai($item): bool
    {
        return (int) $item->status_id === config('constants.statuses.SELESAI');
    }

    private function isReject($item): bool
    {
        return (int) $item->status_id === config('constants.statuses.REJECT');
    }

    private function setStatusSelesai($item): void
    {
        $item->status_id = (int) $item->status_id
        === config('constants.statuses.REJECT')
            ? config('constants.statuses.REJECT')
            : config('constants.statuses.SELESAI');
    }

    private function setStatusReject($item): void
    {
        $item->status_id = config('constants.statuses.REJECT');
    }
}
