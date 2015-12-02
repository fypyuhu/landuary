<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrganizationIdToTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('items', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('taxes', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('shipping_manifest', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('receiving_manifest', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('outgoing_carts', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('incoming_carts', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('customers', function ($table) {
            $table->integer('organization_id')->default(0);
        });
        Schema::table('carts', function ($table) {
            $table->integer('organization_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
