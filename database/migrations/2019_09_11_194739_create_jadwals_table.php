<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nasabah_id')->nullable();
            $table->unsignedBigInteger('banksampah_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });

        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreign('nasabah_id')->references('id')->on('nasabahs')->onDelete('set null')->onUpdate('set null');
            $table->foreign('banksampah_id')->references('id')->on('banksampahs')->onDelete('set null')->onUpdate('set null');
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
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropForeign('jadwals_nasabah_id_foreign');
            $table->dropForeign('jadwals_banksampah_id_foreign');
            $table->dropForeign('jadwals_status_id_foreign');
        });

        Schema::dropIfExists('jadwals');
    }
}
