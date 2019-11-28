<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetoranPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setoran_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedDecimal('amount', 20,2)->nullable();
            $table->unsignedDecimal('pay_amount', 20,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->dateTime('date_placed')->nullable();
            $table->dateTime('date_confirmed')->nullable();
            $table->dateTime('date_done')->nullable();
            $table->string('ovo_number')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->unsignedBigInteger('setoran_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });

        Schema::table('setoran_payment', function (Blueprint $table) {
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('set null')->onUpdate('set null');
            $table->foreign('setoran_id')->references('id')->on('setorans')->onDelete('set null')->onUpdate('set null');
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
        Schema::table('setoran_payment', function (Blueprint $table) {
            $table->dropForeign('setoran_payment_bank_account_id_foreign');
            $table->dropForeign('setoran_payment_setoran_id_foreign');
            $table->dropForeign('setoran_payment_status_id_foreign');
        });

        Schema::dropIfExists('setoran_payment');
    }
}
