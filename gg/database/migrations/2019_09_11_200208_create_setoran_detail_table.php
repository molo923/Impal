<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetoranDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setoran_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('weight', 20, 3);
            $table->double('weight_reject', 20, 3)->unsigned()->nullable();
            $table->decimal('sub_total', 20, 2)->unsigned()->nullable();
            $table->decimal('store_price', 20, 2)->unsigned()->nullable();
            $table->decimal('custom_price', 20, 2)->unsigned()->nullable();
            $table->unsignedBigInteger('setoran_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('kategorisampah_id')->nullable();
            $table->unsignedBigInteger('last_status_id')->nullable();
            $table->timestamps();
        });

        Schema::table('setoran_detail', function (Blueprint $table) {
            $table->foreign('setoran_id')->references('id')->on('setorans')->onDelete('set null')->onUpdate('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('set null');
            $table->foreign('kategorisampah_id')->references('id')->on('kategorisampahs')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setoran_detail', function (Blueprint $table) {
            $table->dropForeign('setorans_setoran_id_foreign');
            $table->dropForeign('setorans_status_id_foreign');
            $table->dropForeign('setorans_kategorisampah_id_foreign');
        });

        Schema::dropIfExists('setoran_detail');
    }
}
