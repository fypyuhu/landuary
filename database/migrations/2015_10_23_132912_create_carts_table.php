<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unique();
			$table->tinyInteger('use_as_exchange_cart');
			$table->decimal('tare_weight', 15, 4);
			$table->tinyInteger('status');
			$table->string('cart_current_location');
			$table->integer('customer_number');
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
