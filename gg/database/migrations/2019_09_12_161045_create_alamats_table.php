<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlamatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('districts')->nullable();
            $table->string('urban')->nullable();
            $table->double('longitude', 11, 6)->nullable();
            $table->double('latitude', 11, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamats');
    }
}
