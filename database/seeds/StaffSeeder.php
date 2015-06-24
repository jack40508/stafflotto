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
      'staff_ID' => '00360001',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工二',
      'staff_ID' => '00360002',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工三',
      'staff_ID' => '00360003',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工四',
      'staff_ID' => '00360004',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工五',
      'staff_ID' => '00360005',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工六',
      'staff_ID' => '00360006',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工七',
      'staff_ID' => '00360007',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工八',
      'staff_ID' => '00360008',
      'activity_ID' => '1',
      'level' => '0',

      ]);

    Staff::create([
      
      'name' => '員工九',
      'staff_ID' => '00360009',
      'activity_ID' => '1',
      'level' => '1',

      ]);

    Staff::create([
      
      'name' => '員工十',
      'staff_ID' => '00360010',
      'activity_ID' => '1',
      'level' => '0',

      ]);
  }

}