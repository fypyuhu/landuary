<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_items', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id');
			$table->integer('item_id');
			$table->tinyInteger('taxable');
			$table->tinyInteger('billing_by');
			$table->decimal('price_by_weight', 15, 4);
			$table->decimal('price_by_item', 15, 4);
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
