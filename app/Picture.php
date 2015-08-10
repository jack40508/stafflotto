<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {

	//
	protected $fillable = ['picture_name','picture_originalname','usingfor'];
}
