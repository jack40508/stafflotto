<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('staff_name');
			$table->string('staff_number');
			$table->string('staff_activity_number');
			$table->string('staff_cellphone');
			$table->string('staff_e-mail');
			$table->string('staff_department');
			$table->string('staff_seniority');
			$table->boolean('staff_gender');
			$table->boolean('staff_level');
			$table->string('activity_id');
			$table->string('prize_id')->default('-1');
			$table->boolean('staff_status')->default('1');
			$table->string('staff_remark');
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
		Schema::drop('staff');
	}

}
