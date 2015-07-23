<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;
use App\Prize;
use App\Award;
use App\Activity;
use Maatwebsite\Excel\Facades\Excel;

class BackstageController extends Controller {


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
				//$awards = Award::join('activities','awards.activity_id','=','activities.id')->get();
				$awards = Activity::join('awards','activities.id','=','awards.activity_id')->get();
				return view('backstage.show',compact('tag','awards'));
				break;

			case 'staff':
				//$staffs = Staff::join('activities','staff.activity_id','=','activities.activity_id')->get();
				$staffs = Activity::join('staff','activities.id','=','staff.activity_id')->get();
				return view('backstage.show',compact('tag','staffs'));
				break;

			case 'winner':

				$winners = Activity::join('awards','activities.id','=','awards.activity_id')
									->join('prizes','awards.id','=','prizes.award_id')
									->join('staff',function($join)
									{
										$join->on('prizes.id','=','staff.prize_id')
											->where('staff.prize_id','!=','-1');
									})->orderby('prize_id')->get();

				return view('backstage.show',compact('tag','winners'));
				break;
			
			default:
				return view('backstage.show',compact('tag'));
				break;
		}
	}

	public function showdeep($pretag,$precode,$tag)
	{
		switch ($tag) {
			case 'prize':

				/*$prizes = Prize::join('awards',function($join) use ($code)
				{
					$join->on('prizes.award_id','=','awards.award_id')
						->where('prizes.award_id','=',$code);
				})->join('activities','awards.activity_id','=','activities.activity_id')->get();*/

				$prizes = Activity::rightjoin('awards','activities.id','=','awards.activity_id')->join('prizes',function($join) use ($precode)
					{
						$join->on('awards.id','=','prizes.award_id')
							->where('prizes.award_id','=',$precode);
					})->get();

				return view('backstage.show',compact('pretag','tag','precode','prizes'));
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
				$activities = Activity::where('id',$code)->first();
				return view('backstage.edit',compact('tag','activities'));
				break;

			case 'award':
				$awards = Award::where('id',$code)->first();
				$activities = Activity::orderby('id')->get();

				for($i=0; $i<Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i]->activity_name;
					if($awards->activity_id == $activities[$i]->id)
					$nowactivity = $i;
				}

				return view('backstage.edit',compact('tag','activities_name','nowactivity','awards'));
				break;

			case 'staff':
				
				$staffs = Staff::where('id',$code)->first();
				$activities = Activity::orderby('id')->get();

				for($i=0; $i<Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i]->activity_name;
					if($staffs->activity_id == $activities[$i]->id)
					$nowactivity = $i;
				}

				return view('backstage.edit',compact('tag','activities_name','nowactivity','staffs'));
				break;

				case 'winner':
				
				$winners = Staff::where('id',$code)->first();

				$prizes = Award::join('prizes',function($join) use ($winners)
					{
						$join->on('awards.id','=','prizes.award_id')
							->where('activity_id','=',$winners->activity_id);
					})->orderby('prizes.id')->get();

				$prizes_name[0] = '取消資格';

				for($i=1; $i<=$prizes->count(); $i++)
				{
					$prizes_name[$i] = $prizes[$i-1]->prize_name;
					if($prizes[$i-1]->id == $winners->prize_id)
					{
						$nowprize = $i;
					}
				}

				return view('backstage.edit',compact('tag','prizes_name','nowprize','winners'));

				break;
			
			default:
				return view('backstage.edit',compact('tag'));
				break;
		}
	}

	public function editdeep($pretag,$precode,$tag,$code)
	{
		switch ($tag) {
			case 'prize':

				/*$prizes = Prize::join('awards',function($join) use ($code)
				{
					$join->on('prizes.award_id','=','awards.id')
						->where('prizes.id','=',$code);					
				})->join('activities','awards.activity_id','=','activities.id')->first();*/

				$prizes = Activity::join('awards','activities.id','=','awards.activity_id')->join('prizes',function($join) use ($precode,$code)
				{
					$join->on('awards.id','=','prizes.award_id')
						->where('prizes.id','=',$code);
				})->first();

				//設定Award清單，並儲存預設值
				$nowawards = Award::where('id',$precode)->first();
				$awards = Award::where('activity_id',$nowawards->activity_id)->get();

				for($i=0; $i<Award::where('activity_id',$nowawards->activity_id)->count(); $i++)
				{
					$awards_name[$i] = $awards[$i]->award_name;
					if($awards[$i]->id == $prizes->award_id)
					$nowaward = $i;
				}

				return view('backstage.edit',compact('pretag','tag','awards_name','nowaward','prizes'));
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
				
				//如果開啟一個活動，則關閉原本開啟的活動，並將該活動底下所有獎項、獎品關閉
				//並開啟底下其他已存在之獎項及獎品
				if($request->get('activity_status') == '1' && Activity::where('activity_status','1')->count() == 1)
				{
					$activities = Activity::where('activity_status','1')->first();

					$activities->activity_status = '0';
					$activities->save();

					$awards = Award::where('activity_id',$activities->id)->get();

					for($i=0; $i<$awards->count(); $i++)
					{
						$awards[$i]->award_status = '0';
						$awards[$i]->save();

						$prizes = Prize::where('award_id',$awards[$i]->id)->get();

						for($j=0; $j<$prizes->count(); $j++)
						{
							$prizes[$j]->prize_status = '0';
							$prizes[$j]->save();
						}
					}

					$activities = Activity::where('id',$code)->first();

					$awards = Award::where('activity_id',$activities->id)->get();

					for($i=0; $i<$awards->count(); $i++)
					{
						$awards[$i]->award_status = '1';
						$awards[$i]->save();

						$prizes = Prize::where('award_id',$awards[$i]->id)->get();

						for($j=0; $j<$prizes->count(); $j++)
						{
							$prizes[$j]->prize_status = '1';
							$prizes[$j]->save();
						}
					}
				}

				else if($request->get('activity_status') == '0')
				{
					$activities = Activity::where('id',$code)->first();

					$awards = Award::where('activity_id',$activities->id)->get();

					for($i=0; $i<$awards->count(); $i++)
					{
						$awards[$i]->award_status = '0';
						$awards[$i]->save();

						$prizes = Prize::where('award_id',$awards[$i]->id)->get();

						for($j=0; $j<$prizes->count(); $j++)
						{
							$prizes[$j]->prize_status = '0';
							$prizes[$j]->save();
						}
					}
				}

				else if($request->get('activity_status') == '1' && Activity::where('activity_status','1')->count() == 0)
				{
					$activities = Activity::where('id',$code)->first();

					$awards = Award::where('activity_id',$activities->id)->get();

					for($i=0; $i<$awards->count(); $i++)
					{
						$awards[$i]->award_status = '1';
						$awards[$i]->save();

						$prizes = Prize::where('award_id',$awards[$i]->id)->get();

						for($j=0; $j<$prizes->count(); $j++)
						{
							$prizes[$j]->prize_status = '1';
							$prizes[$j]->save();
						}
					}
				}

				$activities = Activity::where('id',$code)->first();

				$activities->fill($request->input())->save();
				
				return redirect('/backstage/' . $tag);
				break;

			case 'award':

				$activities = Activity::orderby('id')->get();

				$awards = Award::where('id',$code)->first();

				$awards->fill($request->input());
				$awards->activity_id = $activities[$request->activity_id]->id;//找到對應的Activity
				$awards->save();

				$prizes = Prize::where('award_id',$code)->get();

				for($i=0; $i<$prizes->count(); $i++)
				{
					$prizes[$i]->prize_status = $request->award_status;
					$prizes[$i]->save();
				}

				return redirect('/backstage/' . $tag);
				break;

			case 'staff':

				$activities = Activity::orderby('id')->get();

				$staffs = Staff::where('id',$code)->first();

				$staffs->fill($request->input());
				$staffs->staff_remark = $request->get('staff_remark');//問題：不明原因無法以fill新增
				$staffs->activity_id = $activities[$request->activity_id]->id;//找到對應的Activity
				$staffs->save();

				return redirect('/backstage/' . $tag);
				break;

			case 'winner':

				$winners = Staff::where('id',$code)->first();

				if($request->get('prize_id') == '0')
				{
					$winners->staff_status = '0';
					$winners->prize_id = '-1';
					$winners->staff_remark = $request->get('staff_remark');
					$winners->save();
				}

				else
				{
					$prizes = Award::join('prizes',function($join) use ($winners)
					{
						$join->on('awards.id','=','prizes.award_id')
							->where('activity_id','=',$winners->activity_id);
					})->orderby('prizes.id')->get();

					$winners->staff_remark = $request->get('staff_remark');
					$winners->prize_id = $prizes[$request->prize_id-1]->id;
					$winners->save();
				}
				
				return redirect('/backstage/' . $tag);
				break;
			
			default:
				return redirect('/backstage/' . $tag);
				break;
		}
	}

	public function updatedeep($pretag,$precode,$tag,$code,Request $request)
	{
		switch ($tag) {
			case 'prize':

				$preawrds = Award::where('id',$precode)->first();//找到該獎品屬於哪次活動的事前準備

				$awards = Award::where('activity_id',$preawrds->activity_id)->orderby('id')->get();

				$prizes = Prize::where('id',$code)->first();

				$prizes->fill($request->input());
				$prizes->award_id = $awards[$request->award_id]->id;//找到對應的Activity
				$prizes->save();

				return redirect('/backstage/' . $pretag . "/" . $precode . "/" . $tag);
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
				Staff::where('activity_id',$code)->delete();
				Prize::join('awards',function($join) use ($code)
					{
						$join->on('prizes.award_id','=','awards.id')
							->where('awards.activity_id','=',$code);
					})->delete();
				Award::where('activity_id',$code)->delete();
				
				return redirect('/backstage/' . $tag);

				break;

			case 'award':
				Award::where('id',$code)->delete();
				
				//獎項被刪除，則其獎品內容也一併刪除
				$prizes = Prize::where('award_id',$code)->delete();

				return redirect('/backstage/' . $tag);
				break;

			case 'staff':
				Staff::where('id',$code)->delete();
				return redirect('/backstage/' . $tag);
				break;
			
			default:
				return redirect('/backstage/' . $tag);
				break;
		}
	}

	public function deletedeep($pretag,$precode,$tag,$code)
	{
		switch ($tag) {
			case 'prize':
				$prizes = Prize::where('id',$code)->delete();
				return redirect('/backstage/' . $pretag . "/" . $precode . "/" . $tag);
				break;
			default:

				break;
		}
	}

	public function insert($tag)
	{
		switch ($tag) {
			case 'activity':
				return view('backstage.insert',compact('tag'));

				break;

			case 'award':
				$activities = Activity::orderby('id')->get();
				for($i=0; $i<Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i]->activity_name;
				}

				return view('backstage.insert',compact('tag','activities_name'));
				
				break;

			case 'staff':
				$activities = Activity::orderby('id')->get();
				for($i=0; $i<Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i]->activity_name;
				}

				return view('backstage.insert',compact('tag','activities_name'));
				
				break;
			
			default:

				break;
		}
	}

	public function insertdeep($pretag,$precode,$tag)
	{
		switch ($tag) {
			case 'prize':
				return view('backstage.insert',compact('pretag','precode','tag'));

				break;
			
			default:

				break;
		}
	}

	public function create($tag,Request $request)
	{
		switch ($tag) {
			case 'activity':
				if($request->get('activity_status') == '1' && Activity::where('activity_status','1')->count() == '1')
				{
					$activities = Activity::where('activity_status','1')->first();

					$activities->activity_status = '0';
					$activities->save();

					$awards = Award::where('activity_id',$activities->id)->get();

					for($i=0; $i<$awards->count(); $i++)
					{
						$awards[$i]->award_status = '0';
						$awards[$i]->save();

						$prizes = Prize::where('award_id',$awards[$i]->id)->get();

						for($j=0; $j<$prizes->count(); $j++)
						{
							$prizes[$j]->prize_status = '0';
							$prizes[$j]->save();
						}
					}
				}

				Activity::create(array(
					'activity_name' => $request->get('activity_name'),
					'activity_status' => $request->get('activity_status')
					));
				
				return redirect('/backstage/' . $tag);

				break;

			case 'award':

				$activities = Activity::orderby('id')->get();

				Award::create(array(
					'award_name' => $request->get('award_name'),
					'activity_id' => $activities[$request->activity_id]->id,//找到對應的Activity
					'award_status' => $request->get('award_status')
					));

				return redirect('/backstage/' . $tag);

				break;

			case 'staff':

				$activities = Activity::orderby('id')->get();

				Staff::create(array(
					'staff_name' => $request->get('staff_name'),
					'staff_number' => $request->get('staff_number'),
					'staff_activity_number' => $request->get('staff_activity_number'),
					'staff_level' => $request->get('staff_level'),
					'activity_id' => $activities[$request->activity_id]->id,//找到對應的Activity
					'staff_status' => $request->get('staff_status')
					));

				return redirect('/backstage/' . $tag);

				break;
			
			default:

				break;
		}
	}

	public function createdeep($pretag,$precode,$tag,Request $request)
	{
		switch ($tag) {
			case 'prize':
			
				Prize::create(array(
					'prize_name' => $request->get('prize_name'),
					'award_id' => $precode,
					'prize_level' => $request->get('prize_level'),
					'prize_amount' => $request->get('prize_amount'),
					'prize_status' => $request->get('prize_status')
					));

				return redirect('/backstage/' . $pretag . '/' . $precode . '/' . $tag);

				break;
			
			default:

				break;
		}
	}

	public function excel_import()
	{
		Excel::load('uploads/excel/testActivity.xlsx', function($reader) {
/*		    
		    //獲取excel的第幾張表
		    $reader = $reader->getSheet(0);
		    //獲取表中的數據
		    $results = $reader->toArray();
*/
		    //匯入Activity
		    $readers = $reader->getSheet(0);
		    $results = $readers->toArray();

		    Activity::create(array(
					'activity_name' => $results[1][0],
					));

		    $activities = Activity::orderby('id','desc')->first();

		    //匯入Award
		    $readers = $reader->getSheet(1);
		    $results = $readers->toArray();

		    $i = 1;

		    while(!empty($results[$i][0]))
		    {
		    	Award::create(array(
		    	'award_name' => $results[$i][0],
		    	'activity_id' => $activities->id,
		    	));

		    	$i++;
		    }

		    $awards = Award::where('activity_id',$activities->id)->orderby('id')->get();
		    
		    //匯入Prize
		    $readers = $reader->getSheet(2);
		    $results = $readers->toArray();

		    $i = 1;

		    while(!empty($results[$i][0]))
		    {
		    	for($j=0; $j<$awards->count(); $j++)
		    	{
		    		if(!strcmp($results[$i][0],$awards[$j]->award_name))
					$award_id = $awards[$j]->id;
		    	}
		    	
		    	Prize::create(array(
					'prize_name' => $results[$i][1],
					'award_id' => $award_id,
					'prize_level' => $results[$i][2],
					'prize_amount' => $results[$i][3],					
					));

				$i++;
		    }

		    //匯入Staff
		    $readers = $reader->getSheet(3);
		    $results = $readers->toArray();

		    $i = 1;

		    while(!empty($results[$i][0]))
		    {
		    	if(!strcmp($results[$i][7], '男'))
		    	$staff_gender = '男';

		    	else
		    	$staff_gender = '女';

		    	Staff::create(array(
					'activity_id' => $activities->id,
					'staff_activity_number' => $results[$i][0],
					'staff_number' => $results[$i][1],
					'staff_name' => $results[$i][2],
					'staff_cellphone' => $results[$i][3],
					'staff_e-mail' => $results[$i][4],
					'staff_department' => $results[$i][5],
					'staff_seniority' => $results[$i][6],
      				'staff_gender' => $staff_gender,
					'staff_level' => $results[$i][8],				
					));

		    	$i++;
		    }
		});
	}
}
