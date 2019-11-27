<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutasisampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasisampahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_mutasi')->nullable();
            $table->bigInteger('kategorisampah_transfer_id')->unsigned()->nullable();
            $table->bigInteger('kategorisampah_terima_id')->unsigned()->nullable();
            $table->decimal('weight', 20, 3)->nullable();
            $table->timestamps();
        });

        Schema::table('mutasisampahs', function (Blueprint $table) {
            $table->foreign('kategorisampah_transfer_id')->references('id')->on('banksampah_kategorisampah')->onDelete('set null')->onUpdate('set null');
            $table->foreign('kategorisampah_terima_id')->references('id')->on('banksampah_kategorisampah')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutasisampahs', function (Blueprint $table) {
            $table->dropForeign('mutasisampahs_kategorisampah_transfer_id_foreign');
            $table->dropForeign('mutasisampahs_kategorisampah_terima_id_foreign');
        });

        Schema::dropIfExists('mutasisampahs');
    }
}
