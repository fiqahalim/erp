<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsIntoMaterialProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_products', function (Blueprint $table) {
            $table->string('sku')->nullable()->after('name');
            $table->string('description')->nullable()->after('name');
            $table->string('remarks')->nullable()->after('name');
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
            $table->dropColumn(['sku', 'description', 'remarks']);
        });
    }
}
