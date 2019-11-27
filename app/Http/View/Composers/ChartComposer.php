<?php


namespace App\Http\View\Composers;

use App\Sampahkeluar;
use App\Setoran;
use Carbon\Carbon;
use Illuminate\View\View;

class ChartComposer
{
    public function compose(View $view)
    {
        $yearStart = $this->startDateValid() ? $this->parseStartDate()[2] : null;
        $monthStart = $this->startDateValid() ? $this->parseStartDate()[1] : null;
        $dayStart = $this->startDateValid() ? $this->parseStartDate()[0] : null;

        $yearEnd = $this->endDateValid() ? $this->parseEndDate()[2] : null;
        $monthEnd = $this->endDateValid() ? $this->parseEndDate()[1] : null;
        $dayEnd = $this->endDateValid() ? $this->parseEndDate()[0] : null;

        $dateStart = Carbon::createFromDate($yearStart, $monthStart, $dayStart)
            ->setTime(0, 0, 0);
        $dateEnd = Carbon::createFromDate($yearEnd, $monthEnd, $dayEnd)
            ->setTime('23', '59', '59', '999999');

        if (!request()->has('tab')
            && request()->url()
            !== route('banksampah.dashboard')) {
            $dateStart = $dateStart->startOfDay();
            $dateEnd = $dateEnd->endOfDay();
        }

        if (request()->query('tab')
            === 'minggu'
            && !request()->has('start')
            && !request()->has('end')
            && request()->url()
            !== route('banksampah.dashboard')) {
            $dateStart = $dateStart->startOfWeek();
            $dateEnd = $dateEnd->endOfWeek();
        }

        if (request()->query('tab')
            === 'bulan'
            && !request()->has('start')
            && !request()->has('end')
            && request()->url()
            !== route('banksampah.dashboard')) {
            $dateStart = $dateStart->startOfMonth();
            $dateEnd = $dateEnd->endOfMonth();
        }

        if (request()->query('tab') === 'tahun') {
            $dateStart = $dateStart->startOfYear();
            $dateEnd = $dateEnd->endOfYear();
        }

        if (request()->url() == route('banksampah.dashboard')) {
            $dateStart = $dateStart->startOfWeek();
            $dateEnd = $dateEnd->endOfWeek();
        }

        $dateStart->toDateTimeString();
        $dateEnd->toDateTimeString();

        $pengeluaran = new Setoran;
        $pengeluaran = $pengeluaran->getBetween($dateStart, $dateEnd);

        $pemasukan = new Sampahkeluar;
        $pemasukan = $pemasukan->getBetween($dateStart, $dateEnd);

        /*dd($dateStart, $dateEnd);

        dd($pemasukan);*/

        $finansial = collect();
        $finansial = $finansial->concat($pengeluaran);
        $finansial = $finansial->concat($pemasukan);

        $chart = $finansial->groupBy(function ($date) {
            if (request()->has('tab') && request()->query('tab') === 'minggu') {
                return Carbon::parse($date->store_done ?? $date->date_done)->format('l');
            }

            if (!request()->has('tab') && request()->url() == route('banksampah.dashboard')) {
                return Carbon::parse($date->store_done ?? $date->date_done)->format('l');
            }

            if (request()->has('tab') && request()->query('tab') === 'tahun') {
                return Carbon::parse($date->store_done ?? $date->date_done)->format('F');
            }
        });

        $chartberat = request()->url() == route('banksampah.dashboard') ? $chart->map(function ($item) {
            return $item->groupBy('type')->map(function ($item) {
                return $item->sum(function ($item) {
                    return ($item->setoranDetail
                            ? $item->setoranDetail->sum('weight')
                            : null)
                                ?? $item->sampahkeluarDetail->sum('weight');
                });
            });
        })->toArray() : null;

        $view->with([
            'pengeluarans' => $pengeluaran,
            'pemasukans' => $pemasukan,
            'finansials' => $finansial,
            'chart' => $chart->map(function ($item) {
                return $item->groupBy('type')->map(function ($item) {
                    return $item->sum('price_total');
                });
            })->toArray(),
            'chartberat' => $chartberat,
            'bulan' => now()->format('m'),
            'tahun' => now()->format('Y'),
        ]);
    }

    public function startDateValid()
    {
        return request()->start && strlen(request()->start) === 10;
    }

    public function parseStartDate()
    {
        return explode('-', request()->start);
    }

    public function endDateValid()
    {
        return request()->end && strlen(request()->end) === 10;
    }

    public function parseEndDate()
    {
        return explode('-', request()->end);
    }
}
