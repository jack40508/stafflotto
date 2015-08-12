<?php

use Illuminate\Database\Seeder;
use App\Picture;

class PictureSeeder extends Seeder {

  public function run()
  {
    DB::table('pictures')->delete();

    Picture::create([
      
      'picture_name' => 'CGAssoq8NuGx.png',
      'picture_originalname' => '第一次抽獎抽獎測試圖.png',
      'usingfor' => '1'
      ]);

    Picture::create([
      
      'picture_name' => 'sIhfDvrsc8wRjS0J.png',
      'picture_originalname' => '背景測試用圖.png',
      'usingfor' => '0'
      ]);
  }

}