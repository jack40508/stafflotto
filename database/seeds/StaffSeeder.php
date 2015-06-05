<?php

use Illuminate\Database\Seeder;
use App\Staff;

class StaffSeeder extends Seeder {

  public function run()
  {
    DB::table('staff')->delete();

    /*for ($i=0; $i < 10; $i++) {
      Page::create([
        'title'   => 'Title '.$i,
        'slug'    => 'first-page',
        'body'    => 'Body '.$i,
        'user_id' => 1,
      ])
    }*/

    Staff::create([
      
      'name' => '員工一',
      'code' => '00360001',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工二',
      'code' => '00360002',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工三',
      'code' => '00360003',
      'level' => '0',

      ]);
  }

}