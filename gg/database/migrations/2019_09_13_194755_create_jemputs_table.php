<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJemputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->dateTime('date_pick_up')->nullable();
            $table->dateTime('date_done')->nullable();
            $table->double('weight_est', 20, 3)->nullable();
            $table->double('weight_ori', 20, 3)->nullable();
            $table->text('description')->nullable();
            $table->string('fleet')->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->bigInteger('jadwal_id')->unsigned()->nullable();
            $table->bigInteger('setoran_id')->unsigned()->nullable();
            $table->bigInteger('pegawai_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('jemputs', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('set null');
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('set null')->onUpdate('set null');
            $table->foreign('setoran_id')->references('id')->on('setorans')->onDelete('set null')->onUpdate('set null');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jemputs', function (Blueprint $table) {
            $table->dropForeign('jemputs_status_id_foreign');
            $table->dropForeign('jemputs_jadwal_id_foreign');
            $table->dropForeign('jemputs_setoran_id_foreign');
            $table->dropForeign('jemputs_pegawai_id_foreign');
        });

        Schema::dropIfExists('jemputs');
    }
}
