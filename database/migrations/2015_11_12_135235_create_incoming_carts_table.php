<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('department_id');
			$table->integer('cart_id');
			$table->date('receiving_date');
			$table->decimal('gross_weight', 5, 2);
			$table->decimal('net_weight', 5, 2);
			$table->string('status', 20);
			$table->tinyinteger('is_exchange_cart');
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
