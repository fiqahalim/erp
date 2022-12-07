<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchasing_organization')->nullable();
            $table->string('23_material_no')->nullable();
            $table->integer('quantity_receive')->nullable();
            $table->integer('quantity_unreceive')->nullable();
            $table->longText('spec')->nullable();
            $table->longText('coa_msds')->nullable();
            $table->longText('remarks')->nullable();

            $table->datetime('receive_date')->nullable();
            $table->datetime('expiry_date')->nullable();
            $table->datetime('actual_receive_date')->nullable();
            $table->datetime('manufacture_date')->nullable();
            $table->string('status')->nullable();

            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');


            $table->integer('purchase_order_id')->unsigned()->nullable();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');

            $table->integer('purchase_order_item_id')->unsigned()->nullable();
            $table->foreign('purchase_order_item_id')->references('id')->on('purchase_order_items')->onDelete('cascade');

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
        Schema::dropIfExists('incoming_stocks');
    }
}
