<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {

	//

	protected $fillable = ['staff_name','staff_number','staff_activity_number','staff_cellphone','staff_email','staff_department','staff_seniority','staff_gender','staff_level','prize_id','staff_status','activity_id','staff_remark'];
}
