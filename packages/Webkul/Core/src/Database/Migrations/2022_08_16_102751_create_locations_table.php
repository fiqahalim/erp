<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location_code')->nullable();
            $table->string('location_name')->nullable();
            $table->string('type')->nullable();
            $table->string('process_name')->nullable();
            $table->string('outsource_name')->nullable();
            $table->longText('other_establish_name')->nullable();
            $table->decimal('tax_rate_sales', 12, 4)->nullable();
            $table->decimal('tax_rate_purchase', 12, 4)->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('locations');
    }
}
