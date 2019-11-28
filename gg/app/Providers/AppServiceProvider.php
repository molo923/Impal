<?php

namespace App\Providers;

use App\Http\View\Composers\BanksComposer;
use App\Http\View\Composers\ChartComposer;
use App\Http\View\Composers\JemputComposer;
use App\Http\View\Composers\JenissampahsComposer;
use App\Http\View\Composers\KategorisampahsComposer;
use App\Http\View\Composers\NasabahsComposer;
use App\Http\View\Composers\StatusesComposer;
use App\Observers\SampahkeluarDetailObserver;
use App\Observers\SetoranDetailObserver;
use App\SampahkeluarDetail;
use App\SetoranDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        \Validator::extendImplicit('current_password', function($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, auth()->user()->password);
        });

        Blade::directive('rp', function ($money) {
            return "<?php echo number_format($money, 0, ',', '.'); ?>";
        });

        Blade::directive('kg', function ($weight) {
            return "<?php echo $weight . ' Kg'; ?>";
        });

        View::composer(['banksampah.setoran.*'], NasabahsComposer::class);
        View::composer([
            'banksampah.setoran.*',
            'banksampah.sampah-keluar.*',
            'banksampah.kategori-sampah.detail-mutasi',
        ], KategorisampahsComposer::class);
        View::composer(['banksampah.*', 'banksampah.*'], StatusesComposer::class);
        View::composer(['banksampah.*', 'banksampah.*'], JenissampahsComposer::class);
        View::composer(['banksampah.index', 'banksampah.finansial.*'], ChartComposer::class);
        View::composer(['banksampah.index'], JemputComposer::class);
        View::composer(['banksampah.*'], BanksComposer::class);

        SampahkeluarDetail::observe(SampahkeluarDetailObserver::class);
        SetoranDetail::observe(SetoranDetailObserver::class);
    }
}
