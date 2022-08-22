<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('ceo_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('business_type')->nullable();
            $table->string('business_item')->nullable();
            $table->json('contact_numbers')->nullable();
            $table->json('phone_numbers')->nullable();
            $table->json('fax_numbers')->nullable();
            $table->json('emails');
            $table->string('keyword')->nullable();
            $table->string('supplier_type')->nullable();

            $table->json('address_1')->nullable();
            $table->longText('remarks')->nullable();
            $table->boolean('status')->default(0);

            $table->integer('organization_id')->unsigned()->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
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
        Schema::dropIfExists('persons');
    }
}
