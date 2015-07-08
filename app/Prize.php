<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model {

	//

	protected $fillable = ['name','type','level','amount','status','activity_ID'];

}
