<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidusampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residusampahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_residu')->nullable();
            $table->bigInteger('banksampah_kategorisampah_id')->unsigned()->nullable();
            $table->decimal('weight', 20, 3)->nullable();
            $table->timestamps();
        });

        Schema::table('residusampahs', function (Blueprint $table) {
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
        Schema::table('residusampahs', function (Blueprint $table) {
            $table->dropForeign('residusampahs_banksampah_kategorisampah_id_foreign');
        });

        Schema::dropIfExists('residusampahs');
    }
}
