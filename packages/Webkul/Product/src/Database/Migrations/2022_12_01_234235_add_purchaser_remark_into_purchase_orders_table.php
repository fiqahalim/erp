<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaserRemarkIntoPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_items', function (Blueprint $table) {
            $table->string('spec')->nullable()->after('remarks');
            $table->string('purchaser_remark')->nullable()->after('description');
            $table->integer('stock_balance')->nullable()->after('quantity');
            $table->date('delivery_date')->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order_items', function (Blueprint $table) {
            $table->dropColumn(['spec', 'requestor_remark', 'stock_balance']);
        });
    }
}
