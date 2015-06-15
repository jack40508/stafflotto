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

    Staff::create([
      
      'name' => '員工四',
      'code' => '00360004',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工五',
      'code' => '00360005',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工六',
      'code' => '00360006',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工七',
      'code' => '00360007',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工八',
      'code' => '00360008',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工九',
      'code' => '00360009',
      'level' => '1',

      ]);

    Staff::create([
      
      'name' => '員工十',
      'code' => '00360010',
      'level' => '0',

      ]);
  }

}