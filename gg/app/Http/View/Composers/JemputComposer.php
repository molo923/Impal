<?php


namespace App\Http\View\Composers;

use App\Jemput;
use Illuminate\View\View;

class JemputComposer
{
    public function compose(View $view)
    {
        $jemputs = Jemput::whereHas('jadwal', function ($query) {
                $query->where('banksampah_id', request()->get('banksampah_id') ?? banksampah()->id);
            })
            ->with(['setoranJemput' => function ($query) {
                $query->with(['setoran' => function ($query) {
                    $query->with(['nasabah' => function ($query) {
                        $query->with(['user']);
                    }]);
                }, 'pegawai']);
            }, 'status'])
            ->where('status_id', config('constants.statuses.BELUMKONFIRMASI'))
            ->whereDate('created_at', now())
            ->get();

        $view->with('jemputs', $jemputs);
    }
}
