<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_number');
			$table->string('shipping_name', 50);
			$table->string('shipping_address');
			$table->string('shipping_city', 50);
			$table->string('shipping_state', 50);
			$table->string('shipping_zipcode', 20);
			$table->string('shipping_phone', 20);
			$table->string('shipping_fax', 20);
			$table->string('billing_name', 50);
			$table->string('billing_address');
			$table->string('billing_city', 50);
			$table->string('billing_state', 50);
			$table->string('billing_zipcode', 20);
			$table->string('billing_phone', 20);
			$table->string('billing_fax', 20);
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
