<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Staff;
use App\Prize;
use App\Award;
use App\Activity;
use App\User;
use App\Picture;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use Response;
use Session;

class BackstageController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

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
									->join('staff', function($join)
									{
										$join->on('prizes.id','=','staff.prize_id')
											->where('staff.prize_id','!=','-1');
									})->orderby('prize_id')->get();

				return view('backstage.show',compact('tag','winners'));
				break;

			case 'user':

				$users = User::orderby('id')->first();

				return view('backstage.show',compact('tag','users'));
				break;

			case 'excel':

				$activities = Activity::orderby('id')->get();

				for($i=0; $i<$activities->count(); $i++)
				$activities_name[$i] = $activities[$i]->activity_name;

				return view('backstage.show',compact('tag','users','activities_name'));
				break;

			case 'image':		
				
				$pictures = Activity::rightjoin('pictures','activities.id','=','pictures.usingfor')->orderby('pictures.id')->get();

				return view('backstage.show',compact('tag','pictures'));
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

				$prizes = Award::join('prizes',function($join) use ($staffs)
					{
						$join->on('awards.id','=','prizes.award_id')
							->where('activity_id','=',$staffs->activity_id);
					})->orderby('prizes.id')->get();

				for($i=0; $i<Activity::count(); $i++)
				{
					$activities_name[$i] = $activities[$i]->activity_name;
					if($staffs->activity_id == $activities[$i]->id)
					$nowactivity = $i;
				}

				$prizes_name[0] = '未獲獎';
				$nowprize = 0;

				for($i=1; $i<=$prizes->count(); $i++)
				{
					$prizes_name[$i] = $prizes[$i-1]->prize_name;
					if($prizes[$i-1]->id == $staffs->prize_id)
					{
						$nowprize = $i;
					}
				}

				return view('backstage.edit',compact('tag','activities_name','nowactivity','prizes_name','nowprize','staffs'));
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

			case 'user':

				$users = User::orderby('id')->first();
				return view('backstage.edit',compact('tag','users'));

				break;

			case 'image':

				$pictures = Picture::where('pictures.id','=',$code)->first();

				$activities = Activity::orderby('id')->get();
				
				$activities_name[0] = '未使用';
				$activities_name[1] = '背景';

				if($pictures->usingfor == -1)
				$nowactivity = 0;
				else if($pictures->usingfor == 0)
				$nowactivity = 1;
				
				for($i=2; $i<Activity::count()+2; $i++)
				{
					$activities_name[$i] = $activities[$i-2]->activity_name;
					if($pictures->usingfor == $activities[$i-2]->id)
					$nowactivity = $i;
				}

				return view('backstage.edit',compact('tag','pictures','activities_name','nowactivity'));

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
		Session::flash('flash_message', '更新失敗！請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

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

				Session::flash('flash_message', '更新活動－'.$activities->activity_name.'成功！');
				Session::flash('flash_type', 'alert-success');
				
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

				Session::flash('flash_message', '更新獎項－'.$awards->award_name.'成功！');
				Session::flash('flash_type', 'alert-success');

				return redirect('/backstage/' . $tag);
				break;

			case 'staff':

				$activities = Activity::orderby('id')->get();

				$staffs = Staff::where('id',$code)->first();

				$staffs->fill($request->input());
				$staffs->activity_id = $activities[$request->activity_id]->id;//找到對應的Activity

				if($request->get('prize_id') == '0')
				{
					$staffs->staff_status = '0';
					$staffs->prize_id = '-1';
					$staffs->save();
				}

				else
				{
					$prizes = Award::join('prizes',function($join) use ($staffs)
					{
						$join->on('awards.id','=','prizes.award_id')
							->where('activity_id','=',$staffs->activity_id);
					})->orderby('prizes.id')->get();

					$staffs->prize_id = $prizes[$request->prize_id-1]->id;
					$staffs->save();
				}


				Session::flash('flash_message', '更新員工－'.$staffs->staff_name.'成功！');
				Session::flash('flash_type', 'alert-success');

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

				Session::flash('flash_message', '更新得獎人－'.$winners->staff_name.'成功！');
				Session::flash('flash_type', 'alert-success');
				
				return redirect('/backstage/' . $tag);
				break;
			
			case 'user':
				
				$users = User::where('id',$code)->first();

				$users->fill($request->input());
				$users->password = Hash::make($request->get('password_original'));
				$users->save();

				Session::flash('flash_message', '更新使用者－'.$users->name.'成功！');
				Session::flash('flash_type', 'alert-success');

				return redirect('/backstage/' . $tag);	
				break;

			case 'image':

				$pictures = Picture::where('pictures.id','=',$code)->first();

				$activities = Activity::orderby('id')->get();
				
				if($request->usingfor == '0')	//設定為未使用
				$pictures->usingfor = '-1';

				else if($request->usingfor == '1')	//設定為背景
				{
					$background = Picture::where('usingfor','0')->first();
					if(!empty($background) && $background->id != $pictures->id)
					{
						$background->usingfor = '-1';
						$background->save();
					}
					$pictures->usingfor = '0';
				}

				else
				{
					$prepicture = Picture::where('usingfor',$activities[$request->usingfor-2]->id)->first();
					if(!empty($prepicture) && $prepicture->id != $pictures->id)
					{
						$prepicture->usingfor = '-1';
						$prepicture->save();
					}
					$pictures->usingfor = $activities[$request->usingfor-2]->id;
				}

				$pictures->picture_originalname = $request->picture_originalname;
				
				$pictures->save();

				Session::flash('flash_message', '更新圖片－'.$pictures->picture_originalname.'成功！');
				Session::flash('flash_type', 'alert-success');

				return redirect('/backstage/' . $tag);
				break;
			default:
				return redirect('/backstage/' . $tag);
				break;
		}
	}

	public function updatedeep($pretag,$precode,$tag,$code,Request $request)
	{
		Session::flash('flash_message', '更新失敗！請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

		switch ($tag) {
			case 'prize':

				$preawrds = Award::where('id',$precode)->first();//找到該獎品屬於哪次活動的事前準備

				$awards = Award::where('activity_id',$preawrds->activity_id)->orderby('id')->get();

				$prizes = Prize::where('id',$code)->first();

				$prizes->fill($request->input());
				$prizes->award_id = $awards[$request->award_id]->id;//找到對應的Activity
				$prizes->save();

				Session::flash('flash_message', '更新獎品－'.$prizes->prize_name.'成功！');
				Session::flash('flash_type', 'alert-success');

				return redirect('/backstage/' . $pretag . "/" . $precode . "/" . $tag);
				break;
			
			default:
				return redirect('/backstage/' . $tag);
				break;
		}
	}

	public function delete($tag,$code,Request $request)
	{
		Session::flash('flash_message', '刪除失敗！請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

		switch ($tag) {
			case 'activity':
				$users = User::orderby('id')->first();
				if($request->password == $users->password_original)
				{
					$activities = Activity::where('id',$code)->first();
					Activity::where('id',$code)->delete();
					Staff::where('activity_id',$code)->delete();
					Prize::join('awards',function($join) use ($code)
						{
							$join->on('prizes.award_id','=','awards.id')
								->where('awards.activity_id','=',$code);
						})->delete();
					Award::where('activity_id',$code)->delete();
					
					Session::flash('flash_message', '刪除活動－'.$activities->activity_name.'成功！');
					Session::flash('flash_type', 'alert-success');
				}

				else
				{
					Session::flash('flash_message', '密碼不正確，無法刪除');
					Session::flash('flash_type', 'alert-danger');
				}

				break;

			case 'award':
				$awards = Award::where('id',$code)->first();
				Award::where('id',$code)->delete();
				
				//獎項被刪除，則其獎品內容也一併刪除
				$prizes = Prize::where('award_id',$code)->delete();

				Session::flash('flash_message', '刪除獎項－'.$awards->award_name.'成功！');
				Session::flash('flash_type', 'alert-success');

				break;

			case 'staff':
				$staffs = Staff::where('id',$code)->first();
				Staff::where('id',$code)->delete();

				Session::flash('flash_message', '刪除員工－'.$staffs->staff_name.'成功！');
				Session::flash('flash_type', 'alert-success');

				break;
			
			default:
				
				break;
		}

		return redirect('/backstage/' . $tag);
	}

	public function deletedeep($pretag,$precode,$tag,$code)
	{
		Session::flash('flash_message', '刪除失敗！請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

		switch ($tag) {
			case 'prize':
				$prizes = Prize::where('id',$code)->first();
				Prize::where('id',$code)->delete();

				Session::flash('flash_message', '刪除獎品－'.$prizes->prize_name.'成功！');
				Session::flash('flash_type', 'alert-success');
				break;
			default:

				break;
		}

		return redirect('/backstage/' . $pretag . "/" . $precode . "/" . $tag);
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
		Session::flash('flash_message', '新建失敗！請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

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

				$activities = Activity::orderby('id','DESC')->first();

				Session::flash('flash_message', '新建活動－'.$activities->activity_name.'成功！');
				Session::flash('flash_type', 'alert-success');

				break;

			case 'award':

				$activities = Activity::orderby('id')->get();

				Award::create(array(
					'award_name' => $request->get('award_name'),
					'activity_id' => $activities[$request->activity_id]->id,//找到對應的Activity
					'award_status' => $request->get('award_status')
					));

				$awards = Award::orderby('id','DESC')->first();

				Session::flash('flash_message', '新建獎項－'.$awards->award_name.'成功！');
				Session::flash('flash_type', 'alert-success');

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

				$staffs = Staff::orderby('id','DESC')->first();

				Session::flash('flash_message', '新建員工－'.$staffs->staff_name.'成功！');
				Session::flash('flash_type', 'alert-success');

				break;
			
			default:

				break;
		}

		return redirect('/backstage/' . $tag);
	}

	public function createdeep($pretag,$precode,$tag,Request $request)
	{
		Session::flash('flash_message', '更新失敗！請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

		switch ($tag) {
			case 'prize':
			
				Prize::create(array(
					'prize_name' => $request->get('prize_name'),
					'award_id' => $precode,
					'prize_level' => $request->get('prize_level'),
					'prize_amount' => $request->get('prize_amount'),
					'prize_status' => $request->get('prize_status')
					));

				$prizes = Prize::orderby('id','DESC')->first();

				Session::flash('flash_message', '新建獎品－'.$prizes->prize_name.'成功！');
				Session::flash('flash_type', 'alert-success');

				break;
			
			default:

				break;
		}

		return redirect('/backstage/' . $pretag . '/' . $precode . '/' . $tag);

	}

	public function excel_import(Request $request)
	{
		Session::flash('flash_message', '匯入失敗，請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

		if(Input::file('excel_filepath')!=null && (Input::file('excel_filepath')->getClientOriginalExtension() == 'xls' || Input::file('excel_filepath')->getClientOriginalExtension() == 'xlsx'))
		{
			Excel::load(Input::file('excel_filepath')->getRealPath(), function($reader) {
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
			    	$staff_gender = 1;

			    	else
			    	$staff_gender = 0;

			    	Staff::create(array(
						'activity_id' => $activities->id,
						'staff_activity_number' => $results[$i][0],
						'staff_number' => $results[$i][1],
						'staff_name' => $results[$i][2],
						'staff_cellphone' => $results[$i][3],
						'staff_email' => $results[$i][4],
						'staff_department' => $results[$i][5],
						'staff_seniority' => $results[$i][6],
	      				'staff_gender' => $staff_gender,
						'staff_level' => $results[$i][8],				
						));

			    	$i++;
			    }
			});

			Session::flash('flash_message', 'Excel匯入成功！');
			Session::flash('flash_type', 'alert-success');
		}

		else if(Input::file('excel_filepath')!=null && (Input::file('excel_filepath')->getClientOriginalExtension() != 'xls' || Input::file('excel_filepath')->getClientOriginalExtension() != 'xlsx'))
		{
			Session::flash('flash_message', '檔案格式不正確');
			Session::flash('flash_type', 'alert-danger');
		}

		else
		{
			Session::flash('flash_message', '未選擇檔案，請先選擇後重新嘗試');
			Session::flash('flash_type', 'alert-danger');
		}

		return redirect('/backstage/excel');
		
	}

	public function excel_export(Request $request)
	{
		$activities = Activity::get();

		$nowactivity = $activities[$request->activity_id];

		$staffs = Staff::where('activity_id',$nowactivity->id)->get();

		$winners = Activity::join('awards','activities.id','=','awards.activity_id')
							->join('prizes','awards.id','=','prizes.award_id')
							->join('staff',function($join)
							{
								$join->on('prizes.id','=','staff.prize_id')
									->where('staff.prize_id','!=','-1');
							})->orderby('prize_id')->get();

		Excel::create($nowactivity->activity_name, function($excel) use ($staffs,$winners) {
    		$excel->sheet('員工資訊', function($sheet) use ($staffs) {
        		$data = [];
    			array_push($data, ['抽獎號碼','抽獎工號','姓名','手機','EMail','部門','年資','性別','特別資格','備註']);

    			foreach ($staffs as $index => $staff) {

    				if($staff->staff_gender == 1)
		    		$staff_gender = '男';

		    		else
		    		$staff_gender = '女';

    				array_push($data, [$staff->staff_activity_number,$staff->staff_number,$staff->staff_name,$staff->staff_cellphone,$staff->staff_email,$staff->staff_department,$staff->staff_seniority,$staff_gender,$staff->staff_level,$staff->staff_remark]);
    			}

    			$sheet->fromArray($data,null,null,false,false);		
    		});

    		$excel->sheet('得獎人資訊', function($sheet) use ($winners) {
        		$data = [];
    			array_push($data, ['獎項','獎品','抽獎號碼','抽獎工號','姓名','手機','獲獎輪次']);

    			foreach ($winners as $index => $winner) {
    				array_push($data, [$winner->award_name,$winner->prize_name,$winner->staff_activity_number,$winner->staff_number,$winner->staff_name,$winner->staff_cellphone,$winner->staff_round]);
    			}

        		$sheet->fromArray($data,null,null,false,false);
        	});
		})->export('xls');

		return redirect('/backstage/excel');
	}

	public function excel_download()
	{
		$file= public_path(). "/uploads/excel/testActivity.xlsx";

    	$headers = array(

          'Content-Type: application/xlsx',

        );

   		return Response::download($file, 'Excel範例.xlsx', $headers);
	}

	public function image_upload(Request $request)
	{
		Session::flash('flash_message', '上傳失敗，請重新嘗試');
		Session::flash('flash_type', 'alert-danger');

		if(Input::file('image_filepath') == null)
		{
			Session::flash('flash_message', '未選擇檔案，請先選擇後重新嘗試');
			Session::flash('flash_type', 'alert-danger');
		}

		else if(Input::file('image_filepath')->getClientOriginalExtension() == 'jpg' || Input::file('image_filepath')->getClientOriginalExtension() == 'bmp' || Input::file('image_filepath')->getClientOriginalExtension() == 'png' || Input::file('image_filepath')->getClientOriginalExtension() == 'JPG' || Input::file('image_filepath')->getClientOriginalExtension() == 'BMP' || Input::file('image_filepath')->getClientOriginalExtension() == 'PNG')
		{
			$file = Input::file('image_filepath');
			$destinationPath = 'uploads/image';
			// If the uploads fail due to file system, you can try doing public_path().'/uploads' 
			//$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$filename = str_random() . '.' . $extension;
			$upload_success = Input::file('image_filepath')->move($destinationPath, $filename, $extension);


			Picture::create(array(
				'picture_name' => $filename,
				'picture_originalname' => $file->getClientOriginalName()
			));

			$pictures = Picture::orderby('id','DESC')->first();

			Session::flash('flash_message', '上傳圖片'.$pictures->picture_originalname.'成功！');
			Session::flash('flash_type', 'alert-success');
		}

		else
		{
			Session::flash('flash_message', '僅能上傳圖檔(jpg、bmp、png)');
			Session::flash('flash_type', 'alert-danger');
		}

		return redirect('/backstage/image');    

		
	}
}
