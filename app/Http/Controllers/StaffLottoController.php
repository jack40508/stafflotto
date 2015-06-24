<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;
use App\Prize;
use App\Activity;
use Illuminate\Support\Facades\Session;

class StaffLottoController extends Controller {

	//
	public function index()
	{
		$activities = Activity::where('status',true)->get();
		$staffs = Staff::where('activity_ID',$activities[0]->id)->get();
		$prizes = Prize::where('activity_ID',$activities[0]->id)->get();
		$prizes_type = Prize::where('activity_ID',$activities[0]->id)->distinct()->select('type')->get();		

		return view('stafflotto.index',compact('staffs','prizes','prizes_type'));
	}

	public function show($prize_ID)
	{
		$activities = Activity::where('status',true)->get();
		$staffs = Staff::where('activity_ID',$activities[0]->id)->get();
		$prizes = Prize::where('activity_ID',$activities[0]->id)->get();
		$prizes_type = Prize::where('activity_ID',$activities[0]->id)->distinct()->select('type')->get();
		$nowprizes = Prize::where('activity_ID',$activities[0]->id)->where('prize_ID',$prize_ID)->get();
		$winners = Staff::where('activity_ID',$activities[0]->id)->where('prize_ID',$prize_ID)->get();

		return view('stafflotto.show',compact('staffs','prizes','prizes_type','nowprizes','winners'));
	}

	public function update($prize_ID,Staff $candidate)
	{
		$activities = Activity::where('status',true)->get();
		$staffs = Staff::where('activity_ID',$activities[0]->id)->get();
		$prizes = Prize::where('activity_ID',$activities[0]->id)->get();
		$prizes_type = Prize::where('activity_ID',$activities[0]->id)->distinct()->select('type')->get();
		$nowprizes = Prize::where('activity_ID',$activities[0]->id)->where('prize_ID',$prize_ID)->get();
		$winnersnum = Staff::where('activity_ID',$activities[0]->id)->where('prize_ID',$prize_ID)->count();

		
		if($winnersnum<=0)
		{
			if($nowprizes[0]->level == 0)
			{
				$candidates = $candidate->where('activity_ID',$activities[0]->id)->where('prize_ID','-1')->get();
				$candidatesnum = $candidate->where('activity_ID',$activities[0]->id)->where('prize_ID','-1')->count();

				if($candidatesnum-$nowprizes[0]->amount >= 0)
				{
					for($j = 0; $j<10000; $j++)
					{
						$randnum1 = rand (0,($candidatesnum-1));
						$randnum2 = rand (0,($candidatesnum-1));

						$temp =  $candidates[$randnum1];
						$candidates[$randnum1] = $candidates[$randnum2];
						$candidates[$randnum2] = $temp;
					}

					for($i = 0; $i<$nowprizes[0]->amount; $i++)
					{				
						$candidates[$i]->prize_ID = $prize_ID;
						$candidates[$i]->save();				
					}
				}

				else
				{
					return '剩餘抽獎人數不足';
				}
			}

			else
			{
				$candidates = $candidate->where('activity_ID',$activities[0]->id)->where('prize_ID','-1')->where('level','1')->get();
				$candidatesnum = $candidate->where('activity_ID',$activities[0]->id)->where('prize_ID','-1')->where('level','1')->count();

				if($candidatesnum-$nowprizes[0]->amount >= 0)
				{
					for($j = 0; $j<10000; $j++)
					{
						$randnum1 = rand (0,($candidatesnum-1));
						$randnum2 = rand (0,($candidatesnum-1));

						$temp =  $candidates[$randnum1];
						$candidates[$randnum1] = $candidates[$randnum2];
						$candidates[$randnum2] = $temp;
					}

					for($i = 0; $i<$nowprizes[0]->amount; $i++)
					{				
						$candidates[$i]->prize_ID = $prize_ID;
						$candidates[$i]->save();				
					}
				}

				else
				{
					return '剩餘抽獎人數不足';
				}			
			}
		}

		
		return redirect('/stafflotto/' . $prize_ID);			
	}
}
