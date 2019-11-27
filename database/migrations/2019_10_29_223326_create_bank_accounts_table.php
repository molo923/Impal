<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('nasabah_id')->nullable();
            $table->unsignedBigInteger('banksampah_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->timestamps();
        });

        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->foreign('nasabah_id')
                ->references('id')
                ->on('nasabahs')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->foreign('banksampah_id')
                ->references('id')
                ->on('banksampahs')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->dropForeign('bank_accounts_nasabah_id_foreign');
            $table->dropForeign('bank_accounts_banksampah_id_foreign');
            $table->dropForeign('bank_accounts_bank_id_foreign');
        });

        Schema::dropIfExists('bank_accounts');
    }
}
