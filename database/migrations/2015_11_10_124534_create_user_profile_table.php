<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void 
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
			$table->string('legal_name', 50);
			$table->string('street_address');
			$table->string('city', 50);
			$table->string('state', 50);
			$table->string('zipcode', 50);
			$table->string('country', 50);
			$table->string('phone', 50);
			$table->string('fax', 50);
			$table->string('email', 100);
			$table->string('website');
			$table->string('tax_id_number', 50);
			$table->string('logo');
			$table->string('contact_name', 50);
			$table->string('contact_designation');
			$table->string('contact_email', 100);
			//$table->string('linen_rental');
			//$table->string('healthcare');
			//$table->string('hospitality');
			//$table->string('vacational_rentals');
			//$table->string('customer_own_goods');
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
