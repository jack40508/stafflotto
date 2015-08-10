<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UserSeeder');
		$this->call('StaffSeeder');
		$this->call('PrizeSeeder');
		$this->call('ActivitySeeder');
		$this->call('AwardSeeder');
		$this->call('PictureSeeder');
	}


}
