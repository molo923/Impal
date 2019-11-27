<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNasabahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('gender', 16);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('nasabahs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nasabahs', function (Blueprint $table) {
            $table->dropForeign('nasabahs_user_id_foreign');
        });

        Schema::dropIfExists('nasabahs');
    }
}
