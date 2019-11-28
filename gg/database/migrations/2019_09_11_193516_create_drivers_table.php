<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('banksampah_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
            $table->foreign('banksampah_id')->references('id')->on('banksampahs')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropForeign('drivers_user_id_foreign');
            $table->dropForeign('drivers_banksampah_id_foreign');
        });

        Schema::dropIfExists('drivers');
    }
}
