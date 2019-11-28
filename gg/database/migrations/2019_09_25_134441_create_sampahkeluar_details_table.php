<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampahkeluarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampahkeluar_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('weight', 20, 3);
            $table->double('weight_reject', 20, 3)->unsigned()->nullable();
            $table->decimal('sub_total', 20, 2)->unsigned()->nullable();
            $table->decimal('price', 20, 2)->unsigned()->nullable();
            $table->bigInteger('sampahkeluar_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->bigInteger('kategorisampah_id')->unsigned()->nullable();
            $table->bigInteger('last_status_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('sampahkeluar_details', function (Blueprint $table) {
            $table->foreign('sampahkeluar_id')->references('id')->on('sampahkeluars')->onDelete('set null')->onUpdate('set null');
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
        Schema::table('sampahkeluar_details', function (Blueprint $table) {
            $table->dropForeign('sampahkeluars_sampahkeluar_id_foreign');
            $table->dropForeign('sampahkeluars_status_id_foreign');
            $table->dropForeign('sampahkeluars_kategorisampah_id_foreign');
        });

        Schema::dropIfExists('sampahkeluar_details');
    }
}
