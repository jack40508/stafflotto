<?php

use Illuminate\Database\Seeder;
use App\Activity;

class ActivitySeeder extends Seeder {

  public function run()
  {
    DB::table('activities')->delete();

    Activity::create([
      
      'activity_name' => '第一次抽獎活動',
      'activity_status' => '1'

      ]);

    Activity::create([
      
      'activity_name' => '第二次抽獎活動',
      'activity_status' => '0'

      ]);

  }

}