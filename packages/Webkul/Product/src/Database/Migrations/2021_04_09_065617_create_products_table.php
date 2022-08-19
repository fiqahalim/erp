<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->longText('spec')->nullable();
            $table->longText('additional_spec')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('unit')->nullable();
            $table->string('item_category')->nullable();
            $table->string('catalogue_number')->nullable();

            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('sale_price', 12, 2)->nullable();

            $table->datetime('lead_time')->nullable();
            $table->datetime('shelf_life')->nullable();
            $table->boolean('status')->default(0);

            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
