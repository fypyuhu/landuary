<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_taxes', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id');
			$table->tinyInteger('taxable');
			$table->integer('tax_id');
			$table->string('exempt_certificate');
			$table->bigInteger('reseller_number');
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
        //
    }
}
