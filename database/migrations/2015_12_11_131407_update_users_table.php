<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
			$table->dropColumn('profile_skipped_at');
			$table->tinyInteger('step1');
			$table->tinyInteger('step2');
			$table->tinyInteger('step3');
			$table->tinyInteger('step4');
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
