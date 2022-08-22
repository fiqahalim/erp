<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_no')->unique();
            $table->string('ref_no')->nullable();
            $table->datetime('delivery_date')->nullable();
            $table->datetime('expired_date')->nullable();
            $table->string('progress_status')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->datetime('approved_date')->nullable();

            $table->integer('location_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('transaction_type_id')->unsigned()->nullable();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');

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
        Schema::dropIfExists('purchases');
    }
}
