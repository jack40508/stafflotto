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
      'staff_cellphone' => '0900360001',
      'staff_e-mail' => '00360001@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工二',
      'staff_number' => '00360002',
      'staff_activity_number' => '360002',
      'staff_cellphone' => '0900360002',
      'staff_e-mail' => '00360002@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '2',
      'staff_gender' => '0',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工三',
      'staff_number' => '00360003',
      'staff_activity_number' => '360003',
      'staff_cellphone' => '0900360003',
      'staff_e-mail' => '00360003@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工四',
      'staff_number' => '00360004',
      'staff_activity_number' => '360004',
      'staff_cellphone' => '0900360004',
      'staff_e-mail' => '00360004@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '0',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工五',
      'staff_number' => '00360005',
      'staff_activity_number' => '360005',
      'staff_cellphone' => '0900360005',
      'staff_e-mail' => '00360005@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工六',
      'staff_number' => '00360006',
      'staff_activity_number' => '360006',
      'staff_cellphone' => '0900360006',
      'staff_e-mail' => '00360006@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '0',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工七',
      'staff_number' => '00360007',
      'staff_activity_number' => '360007',
      'staff_cellphone' => '0900360007',
      'staff_e-mail' => '00360007@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工八',
      'staff_number' => '00360008',
      'staff_activity_number' => '360008',
      'staff_cellphone' => '0900360008',
      'staff_e-mail' => '00360008@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工九',
      'staff_number' => '00360009',
      'staff_activity_number' => '360009',
      'staff_cellphone' => '0900360009',
      'staff_e-mail' => '00360009@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '10',
      'staff_gender' => '0',
      'activity_id' => '1',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工十',
      'staff_number' => '00360010',
      'staff_activity_number' => '360010',
      'staff_cellphone' => '0900360010',
      'staff_e-mail' => '00360010@gmail.com',
      'staff_department' => '部門一',
      'staff_seniority' => '1',
      'staff_gender' => '0',
      'activity_id' => '1',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十一',
      'staff_number' => '00360011',
      'staff_activity_number' => '360011',
      'staff_cellphone' => '0900360011',
      'staff_e-mail' => '00360011@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十二',
      'staff_number' => '00360012',
      'staff_activity_number' => '360012',
      'staff_cellphone' => '0900360012',
      'staff_e-mail' => '00360012@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '4',
      'staff_gender' => '1',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十三',
      'staff_number' => '00360013',
      'staff_activity_number' => '360013',
      'staff_cellphone' => '0900360013',
      'staff_e-mail' => '00360013@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '2',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工十四',
      'staff_number' => '00360014',
      'staff_activity_number' => '360014',
      'staff_cellphone' => '0900360014',
      'staff_e-mail' => '00360014@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十五',
      'staff_number' => '00360015',
      'staff_activity_number' => '360015',
      'staff_cellphone' => '0900360015',
      'staff_e-mail' => '00360015@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '1',
      'staff_gender' => '1',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十六',
      'staff_number' => '00360016',
      'staff_activity_number' => '360016',
      'staff_cellphone' => '0900360016',
      'staff_e-mail' => '00360016@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '3',
      'staff_gender' => '0',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十七',
      'staff_number' => '00360017',
      'staff_activity_number' => '360017',
      'staff_cellphone' => '0900360017',
      'staff_e-mail' => '00360017@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '1',
      'staff_gender' => '0',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十八',
      'staff_number' => '00360018',
      'staff_activity_number' => '360018',
      'staff_cellphone' => '0900360018',
      'staff_e-mail' => '00360018@gmail.com',
      'staff_department' => '部門二',
      'staff_seniority' => '1',
      'staff_gender' => '0',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);

    Staff::create([
      
      'staff_name' => '員工十九',
      'staff_number' => '00360019',
      'staff_activity_number' => '360019',
      'staff_cellphone' => '0900360019',
      'staff_e-mail' => '00360019@gmail.com',
      'staff_department' => '部門三',
      'staff_seniority' => '1',
      'staff_gender' => '0',
      'activity_id' => '2',
      'staff_level' => '1',

      ]);

    Staff::create([
      
      'staff_name' => '員工二十',
      'staff_number' => '00360020',
      'staff_activity_number' => '360020',
      'staff_cellphone' => '0900360020',
      'staff_e-mail' => '00360020@gmail.com',
      'staff_department' => '部門三',
      'staff_seniority' => '2',
      'staff_gender' => '0',
      'activity_id' => '2',
      'staff_level' => '0',

      ]);
  }

}