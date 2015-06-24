<?php

use Illuminate\Database\Seeder;
use App\Activity;

class ActivitySeeder extends Seeder {

  public function run()
  {
    DB::table('activities')->delete();

    Activity::create([
      
      'name' => '第一次抽獎活動',

      ]);

  }

}