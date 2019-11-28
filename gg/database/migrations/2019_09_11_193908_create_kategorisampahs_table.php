<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategorisampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategorisampahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->decimal('price_rec', 20, 2)->nullable();
            $table->string('name')->nullable();
            $table->string('uom')->nullable();
            $table->string('description')->nullable();
            $table->string('img_url')->nullable();
            $table->bigInteger('jenissampah_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('kategorisampahs', function(Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('set null');
            $table->foreign('jenissampah_id')->references('id')->on('jenissampahs')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategorisampahs', function(Blueprint $table) {
            $table->dropForeign('kategorisampahs_status_id_foreign'); // Drop foreign key 'status_id' from 'kategorisampahs' table
            $table->dropForeign('kategorisampahs_jenissampah_id_foreign'); // Drop foreign key 'jenissampah_id' from 'kategorisampahs' table
        });

        Schema::dropIfExists('kategorisampahs');
    }
}
