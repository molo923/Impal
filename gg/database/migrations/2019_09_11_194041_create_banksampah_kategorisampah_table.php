<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksampahKategorisampahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banksampah_kategorisampah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 20, 2)->nullable();
            $table->decimal('price_rec', 20, 2)->nullable();
            $table->unsignedBigInteger('kategorisampah_id')->nullable();
            $table->unsignedBigInteger('banksampah_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });

        Schema::table('banksampah_kategorisampah', function (Blueprint $table) {
            $table->foreign('kategorisampah_id')->references('id')->on('kategorisampahs')->onDelete('set null')->onUpdate('set null');
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
        Schema::table('banksampah_kategorisampah', function (Blueprint $table) {
            $table->dropForeign('banksampah_kategorisampah_kategorisampah_id_foreign');
            $table->dropForeign('banksampah_kategorisampah_banksampah_id_foreign');
            $table->dropForeign('banksampah_kategorisampah_status_id_foreign');
        });

        Schema::dropIfExists('banksampah_kategorisampah');
    }
}
