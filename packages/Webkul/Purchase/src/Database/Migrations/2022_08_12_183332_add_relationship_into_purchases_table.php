<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipIntoPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable()->after('product_id');
            $table->unsignedBigInteger('currency_id')->nullable()->after('product_id');
            $table->unsignedBigInteger('transaction_type_id')->nullable()->after('product_id');

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn(['location_id', 'currency_id', 'transaction_type_id']);
        });
    }
}
