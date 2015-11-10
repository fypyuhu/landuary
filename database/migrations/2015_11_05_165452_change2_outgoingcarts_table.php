<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Change2OutgoingcartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outgoing_carts', function ($table) {
			$table->decimal('gross_weight', 5, 2)->after('shipping_date');
			$table->decimal('net_weight', 5, 2)->after('gross_weight');
			$table->dropColumn('is_exchange_cart');
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
