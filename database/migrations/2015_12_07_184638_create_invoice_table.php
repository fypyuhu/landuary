<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_number');
            $table->integer('customer_id');
            $table->string('department_ids');
            $table->string('manifest_ids');
            $table->decimal('total_price');
            $table->decimal('total_tax');
            $table->decimal('price');
            $table->integer('organization_id');
            $table->timestamps();
        });
        Schema::table('shipping_manifest', function ($table) {
            $table->boolean('invoiced')->default(0);
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
