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
      
      'staff_name' => '員工一',
      'staff_number' => '00360001',
      'staff_activity_number' => '360001',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二',
      'staff_number' => '00360002',
      'staff_activity_number' => '360002',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工三',
      'staff_number' => '00360003',
      'staff_activity_number' => '360003',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工四',
      'staff_number' => '00360004',
      'staff_activity_number' => '360004',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工五',
      'staff_number' => '00360005',
      'staff_activity_number' => '360005',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工六',
      'staff_number' => '00360006',
      'staff_activity_number' => '360006',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工七',
      'staff_number' => '00360007',
      'staff_activity_number' => '360007',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工八',
      'staff_number' => '00360008',
      'staff_activity_number' => '360008',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工九',
      'staff_number' => '00360009',
      'staff_activity_number' => '360009',
      'activity_id' => '1',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工十',
      'staff_number' => '00360010',
      'staff_activity_number' => '360010',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);
  }

}