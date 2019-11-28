<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetoransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setorans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->double('weight_total', 20, 3)->unsigned()->nullable();
            $table->double('weight_reject_total', 20, 3)->unsigned()->nullable();
            $table->unsignedDecimal('price_total', 20, 2)->nullable();
            $table->unsignedBigInteger('point_total')->nullable();
            $table->dateTime('store_in')->nullable();
            $table->dateTime('store_done')->nullable();
            $table->unsignedDecimal('store_cost', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('nasabah_id')->nullable();
            $table->unsignedBigInteger('banksampah_id')->nullable();
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });

        Schema::table('setorans', function (Blueprint $table) {
            $table->foreign('nasabah_id')->references('id')->on('nasabahs')->onDelete('set null')->onUpdate('set null');
            $table->foreign('banksampah_id')->references('id')->on('banksampahs')->onDelete('set null')->onUpdate('set null');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('set null')->onUpdate('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setorans', function (Blueprint $table) {
            $table->dropForeign('setoran_banksampah_setoran_id_foreign');
            $table->dropForeign('setoran_banksampah_nasabah_id_foreign');
            $table->dropForeign('setoran_banksampah_banksampah_id_foreign');
            $table->dropForeign('setoran_banksampah_pegawai_id_foreign');
            $table->dropForeign('setorans_status_id_foreign');
        });

        Schema::dropIfExists('setorans');
    }
}
