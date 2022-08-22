<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('amount', 12, 2)->nullable();

            $table->integer('purchase_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_items');
    }
}
