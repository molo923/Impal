<?php

namespace App\Providers;

use App\Jadwal;
use App\Jemput;
use App\Nasabah;
use App\Pegawai;
use App\Kategorisampah;
use App\Policies\DompetPolicy;
use App\Policies\JadwalPolicy;
use App\Policies\JemputPolicy;
use App\Policies\NasabahPolicy;
use App\Policies\PegawaiPolicy;
use App\Policies\KategorisampahPolicy;
use App\Policies\SampahkeluarPolicy;
use App\Policies\SetoranPolicy;
use App\Sampahkeluar;
use App\Setoran;
use App\SetoranPayment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Kategorisampah::class => KategorisampahPolicy::class,
        SetoranPayment::class => DompetPolicy::class,
        Pegawai::class => PegawaiPolicy::class,
        Nasabah::class => NasabahPolicy::class,
        Sampahkeluar::class => SampahkeluarPolicy::class,
        Setoran::class => SetoranPolicy::class,
        Jemput::class => JemputPolicy::class,
        Jadwal::class => JadwalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
