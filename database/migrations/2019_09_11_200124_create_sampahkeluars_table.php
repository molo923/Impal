<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampahkeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampahkeluars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('destination')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price_total', 20, 2)->unsigned()->nullable();
            $table->dateTime('date_in')->nullable();
            $table->dateTime('date_done')->nullable();
            $table->decimal('extra_cost', 10, 2)->nullable();
            $table->bigInteger('banksampah_id')->unsigned()->nullable();
            $table->bigInteger('pegawai_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('sampahkeluars', function (Blueprint $table) {
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
        Schema::table('sampahkeluars', function (Blueprint $table) {
            $table->dropForeign('setoran_banksampah_banksampah_id_foreign');
            $table->dropForeign('setoran_banksampah_pegawai_id_foreign');
            $table->dropForeign('setoran_banksampah_status_id_foreign');
        });

        Schema::dropIfExists('sampahkeluars');
    }
}
