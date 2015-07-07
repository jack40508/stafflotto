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
				$activities = Activity::get();
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

	public function edit($tag,$code)
	{
		switch ($tag) {
			case 'activity':
				$activities = Activity::where('id',$code)->get();
				return view('backstage.edit',compact('tag','activities'));
				break;

			case 'award':
				$activities = Activity::get();

				for($i=1; $i<=Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i-1]->name;
				}

				$prizes = Prize::where('id',$code)->get();
				return view('backstage.edit',compact('tag','activities_ID','activities_name','prizes'));
				break;

			case 'staff':
				$staffs = Staff::where('id',$code)->get();
				return view('backstage.edit',compact('tag','staffs'));
				break;
			
			default:
				return view('backstage.edit',compact('tag'));
				break;
		}
	}

	public function update($tag,$code,Request $request)
	{
		/*switch ($tag) {
			case 'activity':
				$activities = Activity::where('id',$code)->get();
				return view('backstage.edit',compact('tag','activities'));
				break;

			case 'award':
				$prizes = Prize::where('id',$code)->first();

				$prizes->fill($request->input())->save();

				return redirect('/backstage/' . $tag);
				break;

			case 'staff':
				$staffs = Staff::where('id',$code)->get();
				return view('backstage.edit',compact('tag','staffs'));
				break;
			
			default:
				return view('backstage.edit',compact('tag'));
				break;
		}*/

		dd(\Request::input());
	}

}
