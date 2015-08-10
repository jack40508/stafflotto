<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();

    User::create([
      
      'name' => 'Admin',
      'account' => 'admin',
      'password' => Hash::make('1234'),
      'password_original' => '1234'
      ]);

    User::create([
      
      'name' => 'asiavotestafflotto',
      'account' => 'asiavotestafflotto',
      'password' => Hash::make('1234567890'),
      'password_original' => '1234567890'
      ]);
  }

}