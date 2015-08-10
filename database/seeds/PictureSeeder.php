<?php

use Illuminate\Database\Seeder;
use App\Picture;

class PictureSeeder extends Seeder {

  public function run()
  {
    DB::table('pictures')->delete();

    Picture::create([
      
      'picture_name' => 'CGAssoq8NuGx.jpg',
      'picture_originalname' => '第一次抽獎抽獎測試用圖.jpg',
      'usingfor' => '1'
      ]);
  }

}