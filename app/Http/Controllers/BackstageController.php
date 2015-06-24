<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;
use App\Prize;
use App\Activity;

class BackstageController extends Controller {

	//
	public function index()
	{
		return view('backstage.index');
	}

	public function show($tag)
	{
		switch ($tag) {
			case 'activity':
				$activities = Activity::get();
				return view('backstage.show',compact('tag','activities'));
				break;

			case 'award':
				$activities = Activity::where('status',true)->get();
				$prizes = Prize::where('activity_ID',$activities[0]->id)->orderby('type')->get();
				return view('backstage.show',compact('tag','activities','prizes'));
				break;

			case 'staff':
				$activities = Activity::where('status',true)->get();
				$staffs = Staff::where('activity_ID',$activities[0]->id)->get();
				return view('backstage.show',compact('tag','activities','staffs'));
				break;
			
			default:
				return view('backstage.show',compact('tag'));
				break;
		}

		
	}

}
