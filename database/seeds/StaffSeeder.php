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

    Staff::create([
      
      'staff_name' => '員工十一',
      'staff_number' => '00360011',
      'staff_activity_number' => '360011',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十二',
      'staff_number' => '00360012',
      'staff_activity_number' => '360012',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十三',
      'staff_number' => '00360013',
      'staff_activity_number' => '360013',
      'activity_id' => '2',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工十四',
      'staff_number' => '00360014',
      'staff_activity_number' => '360014',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十五',
      'staff_number' => '00360015',
      'staff_activity_number' => '360015',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十六',
      'staff_number' => '00360016',
      'staff_activity_number' => '360016',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十七',
      'staff_number' => '00360017',
      'staff_activity_number' => '360017',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十八',
      'staff_number' => '00360018',
      'staff_activity_number' => '360018',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十九',
      'staff_number' => '00360019',
      'staff_activity_number' => '360019',
      'activity_id' => '2',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工二十',
      'staff_number' => '00360020',
      'staff_activity_number' => '360020',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二一',
      'staff_number' => '00360021',
      'staff_activity_number' => '360021',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二二',
      'staff_number' => '00360022',
      'staff_activity_number' => '360022',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二三',
      'staff_number' => '00360023',
      'staff_activity_number' => '360023',
      'activity_id' => '2',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工二四',
      'staff_number' => '00360024',
      'staff_activity_number' => '360024',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二五',
      'staff_number' => '00360025',
      'staff_activity_number' => '360025',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二六',
      'staff_number' => '00360026',
      'staff_activity_number' => '360026',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二七',
      'staff_number' => '00360027',
      'staff_activity_number' => '360027',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二八',
      'staff_number' => '00360028',
      'staff_activity_number' => '360028',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二九',
      'staff_number' => '00360029',
      'staff_activity_number' => '360029',
      'activity_id' => '2',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工三十',
      'staff_number' => '00360030',
      'staff_activity_number' => '360030',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);
  }

}