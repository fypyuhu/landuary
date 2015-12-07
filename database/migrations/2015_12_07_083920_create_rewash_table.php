<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewash', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('organization_id');
            $table->integer('customer_id');
            $table->integer('department_id');
			$table->integer('item_id');
			$table->integer('total_items');
			$table->decimal('total_weight', 15, 4);
			$table->integer('rewash_date');
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
