<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivingManifestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_manifest', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id');
            $table->string('department_from');
            $table->string('department_to');
			$table->string('date_from');
            $table->string('date_to');
			$table->softDeletes();
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
