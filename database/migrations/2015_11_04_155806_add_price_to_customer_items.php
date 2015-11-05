<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceToCustomerItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers_items', function (Blueprint $table) {
            $table->dropColumn('price_by_weight');
            $table->dropColumn('price_by_item');
            $table->decimal('price', 15, 4);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers_items', function (Blueprint $table) {
            //
        });
    }
}
