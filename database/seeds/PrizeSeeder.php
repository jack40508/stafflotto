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
      
      'name' => '獎品一',
      'code' => '0001',
      'level' => '0',
      'type' => '獎項一',
      'amount' => 1,

      ]);

    Prize::create([
      
      'name' => '獎品二',
      'code' => '0002',
      'level' => '0',
      'type' => '獎項一',
      'amount' => 2,

      ]);

    Prize::create([
      
      'name' => '獎品三',
      'code' => '0003',
      'level' => '0',
      'type' => '獎項二',
      'amount' => 3,

      ]);

    Prize::create([
      
      'name' => '獎品四',
      'code' => '0003',
      'level' => '1',
      'type' => '獎項二',
      'amount' => 1,

      ]);
  }

}