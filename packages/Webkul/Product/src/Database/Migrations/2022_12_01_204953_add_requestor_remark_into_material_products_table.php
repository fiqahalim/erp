<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestorRemarkIntoMaterialProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_products', function (Blueprint $table) {
            $table->string('spec')->nullable()->after('remarks');
            $table->string('requestor_remark')->nullable()->after('description');
            $table->integer('stock_balance')->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_products', function (Blueprint $table) {
            $table->dropColumn(['spec', 'requestor_remark', 'stock_balance']);
        });
    }
}
