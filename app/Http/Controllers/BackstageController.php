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
				$prizes = Prize::orderby('type')->get();
				return view('backstage.show',compact('tag','activities','prizes'));
				break;

			case 'staff':
				$activities = Activity::get();
				$staffs = Staff::get();
				return view('backstage.show',compact('tag','activities','staffs'));
				break;

			case 'winner':
				$activities = Activity::get();
				$prizes = Prize::orderby('type')->get();
				$winners = Staff::where('prize_ID','!=','-1')->orderby('prize_ID')->get();
				return view('backstage.show',compact('tag','activities','prizes','winners'));
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
				$activities = Activity::orderby('id')->get();

				for($i=1; $i<=Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i-1]->name;
				}

				$prizes = Prize::where('id',$code)->get();
				return view('backstage.edit',compact('tag','activities_name','prizes'));
				break;

			case 'staff':
				
				$activities = Activity::orderby('id')->get();

				for($i=1; $i<=Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i-1]->name;
				}

				$staffs = Staff::where('id',$code)->get();

				return view('backstage.edit',compact('tag','activities_name','staffs'));
				break;

				case 'winner':

				$winners = Staff::where('id',$code)->get();

				$prizes = Prize::where('activity_ID',$winners[0]->activity_ID)->orderby('id')->get();

				for($i=1; $i<=Prize::where('activity_ID',$winners[0]->activity_ID)->count(); $i++)
				{
					$prizes_name[$i] = $prizes[$i-1]->name;
				}

				return view('backstage.edit',compact('tag','prizes_name','winners'));

				break;
			
			default:
				return view('backstage.edit',compact('tag'));
				break;
		}
	}

	public function update($tag,$code,Request $request)
	{
		switch ($tag) {
			case 'activity':
				
				//如果開啟一個活動，關閉原本開啟的活動，且若無其他活動則跳過
				if($request->get('status') == '1' && Activity::where('status','1')->count() == '1')
				{
					$activities = Activity::where('status','1')->first();

					$activities->status = '0';
					$activities->save();
				}
				$activities = Activity::where('id',$code)->first();

				$activities->fill($request->input())->save();
				
				return redirect('/backstage/' . $tag);
				break;

			case 'award':

				$prizes = Prize::where('id',$code)->first();

				$prizes->fill($request->input())->save();

				return redirect('/backstage/' . $tag);
				break;

			case 'staff':

				$staffs = Staff::where('id',$code)->first();

				$staffs->fill($request->input())->save();

				return redirect('/backstage/' . $tag);
				break;

			case 'winner':

				$winner = Staff::where('id',$code)->first();

				$winner->fill($request->input())->save();

				if($request->get('prize_ID') == '-1')
				{
					$winner->status = '0';
					$winner->save();
				}
				
				return redirect('/backstage/' . $tag);
				break;
			
			default:
				return redirect('/backstage/' . $tag);
				break;
		}
	}

	public function delete($tag,$code)
	{
		switch ($tag) {
			case 'activity':
				Activity::where('id',$code)->delete();
				Staff::where('activity_ID',$code)->delete();
				Prize::where('activity_ID',$code)->delete();
				
				return redirect('/backstage/' . $tag);

				break;

			case 'award':
				Prize::where('id',$code)->delete();
				
				//獎品被刪除，則獲得該獎品的人就被取消獲獎資格
				$winners = Staff::where('prize_ID',$code)->get();

				foreach ($winners as $index => $winner) {
					$winner->prize_ID = '-1';
					$winner->save();
				}

				return redirect('/backstage/' . $tag);
				break;

			case 'staff':
				Staff::where('id',$code)->delete();
				return redirect('/backstage/' . $tag);
				break;
			
			default:

				break;
		}
	}

	public function insert($tag)
	{
		return view('backstage.insert',compact('tag'));
	}

	public function create($tag,Request $request)
	{
		if($request->get('status') == '1' && Activity::where('status','1')->count() == '1')
		{
			$activities = Activity::where('status','1')->first();

			$activities->status = '0';
			$activities->save();
		}

		Activity::create(array('name' => $request->get('name'), 'status' => $request->get('status')));
		return redirect('/backstage/' . $tag);
	}
}
