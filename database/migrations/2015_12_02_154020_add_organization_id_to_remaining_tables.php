<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrganizationIdToRemainingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('customers_billings', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('customers_departments', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('customers_incoming_carts_items', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('customers_items', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('taxes_components', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('customers_taxes', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('customers_outgoing_carts_items', function ($table) {
            $table->integer('organization_id')->default(0);
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
