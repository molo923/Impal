<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('quantity_beli', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_tabungan', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_hibah', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_retur', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_residu', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_mutasi_transfer', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_mutasi_terima', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_jual', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_nonjual', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_reject', 20, 3)->unsigned()->default(0.000);
            $table->double('quantity_jual_reject', 20, 3)->unsigned()->default(0.000);
            $table->bigInteger('banksampah_kategorisampah_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('stoks', function (Blueprint $table) {
            $table->foreign('banksampah_kategorisampah_id')->references('id')->on('banksampah_kategorisampah')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stoks', function (Blueprint $table) {
            $table->dropForeign('stoks_banksampah_kategorisampah_id_foreign');
        });

        Schema::dropIfExists('stoks');
    }
}
