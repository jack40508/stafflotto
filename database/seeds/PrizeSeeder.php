<?php

use Illuminate\Database\Seeder;
use App\Prize;

class PrizeSeeder extends Seeder {

  public function run()
  {
    DB::table('prizes')->delete();

    /*for ($i=0; $i < 10; $i++) {
      Page::create([
        'title'   => 'Title '.$i,
        'slug'    => 'first-page',
        'body'    => 'Body '.$i,
        'user_id' => 1,
      ])
    }*/

    Prize::create([
      
      'prize_name' => '獎品一',
      'prize_level' => '0',
      'award_id' => '1',
      'prize_amount' => 5,
      'prize_status' => '1',

      ]);

    Prize::create([
      
      'prize_name' => '獎品二',
      'prize_level' => '0',
      'award_id' => '1',
      'prize_amount' => 2,
      'prize_status' => '1',

      ]);

    Prize::create([
      
      'prize_name' => '獎品三',
      'prize_level' => '0',
      'award_id' => '2',
      'prize_amount' => 3,
      'prize_status' => '1',

      ]);

    Prize::create([
      
      'prize_name' => '獎品四',
      'prize_level' => '1',
      'award_id' => '2',
      'prize_amount' => 1,
      'prize_status' => '1',

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之一',
      'prize_level' => '0',
      'award_id' => '3',
      'prize_amount' => 1,

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之二',
      'prize_level' => '0',
      'award_id' => '3',
      'prize_amount' => 2,

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之三',
      'prize_level' => '0',
      'award_id' => '3',
      'prize_amount' => 3,

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之四',
      'prize_level' => '1',
      'award_id' => '4',
      'prize_amount' => 1,

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之五',
      'prize_level' => '0',
      'award_id' => '4',
      'prize_amount' => 1,

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之六',
      'prize_level' => '0',
      'award_id' => '4',
      'prize_amount' => 2,

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之七',
      'prize_level' => '0',
      'award_id' => '4',
      'prize_amount' => 3,

      ]);

    Prize::create([
      
      'prize_name' => '獎品二之八',
      'prize_level' => '1',
      'award_id' => '5',
      'prize_amount' => 3,

      ]);
  }

}