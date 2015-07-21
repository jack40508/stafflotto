<?php

use Illuminate\Database\Seeder;
use App\Award;

class AwardSeeder extends Seeder {

  public function run()
  {
    DB::table('awards')->delete();

    Award::create([
      
      'award_name' => '獎項一',
      'activity_id' => '1',

      ]);

    Award::create([
      
      'award_name' => '獎項二',
      'activity_id' => '1',

      ]);

    Award::create([
      
      'award_name' => '獎項二之一',
      'activity_id' => '2',

      ]);

    Award::create([
      
      'award_name' => '獎項二之二',
      'activity_id' => '2',

      ]);

    Award::create([
      
      'award_name' => '獎項二之三',
      'activity_id' => '2',

      ]);
  }

}