<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_placed')->nullable();
            $table->dateTime('date_process')->nullable();
            $table->dateTime('date_shipped')->nullable();
            $table->dateTime('date_done')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->string('shipping_method')->nullable();
            $table->unsignedBigInteger('nasabah_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('cust_address')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('nasabah_id')->references('id')->on('nasabahs')->onDelete('set null')->onUpdate('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null')->onUpdate('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('set null');
            $table->foreign('cust_address')->references('id')->on('alamats')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_nasabah_id_foreign');
            $table->dropForeign('orders_product_id_foreign');
            $table->dropForeign('orders_status_id_foreign');
            $table->dropForeign('orders_cust_address_id_foreign');
        });

        Schema::dropIfExists('orders');
    }
}
