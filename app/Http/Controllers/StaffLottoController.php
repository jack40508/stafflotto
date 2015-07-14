<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;
use App\Prize;
use App\Activity;
use App\Award;
use Illuminate\Support\Facades\Session;

class StaffLottoController extends Controller {

	//
	public function index()
	{
		$activities = Activity::where('activity_status',true)->first();
		$awards = Award::where('activity_id',$activities->id)->get();
		$prizes = Award::join('prizes',function($join) use ($activities)
		{
			$join->on('awards.id','=','prizes.award_id')
				->where('activity_id','=',$activities->id);
		})->get();

		return view('stafflotto.index',compact('tag','activities','prizes','awards'));
	}

	public function show($tag)
	{
		//index所需data
		$activities = Activity::where('activity_status',true)->first();
		$awards = Award::where('activity_id',$activities->id)->get();
		$prizes = Award::join('prizes',function($join) use ($activities)
		{
			$join->on('awards.id','=','prizes.award_id')
				->where('activity_id','=',$activities->id);
		})->get();
		
		//show所需data
		$prize_now = Prize::where('id',$tag)->first();
		$winners = Staff::where('activity_id',$activities->id)->where('prize_id',$tag)->get();

		return view('stafflotto.show',compact('activities','awards','prizes','prize_now','winners'));
	}

	public function update($tag)
	{
		$activities = Activity::where('activity_status',true)->first();
		$winnersnum = Staff::where('activity_id',$activities->id)->where('prize_id',$tag)->count();
		$prizes = Prize::where('id',$tag)->first();
		$quota = $prizes->prize_amount - $winnersnum;
		
		if($quota>0)
		{
			if($prizes->prize_level == '0')
			{
				$candidates = Staff::where('activity_id',$activities->id)->where('prize_id','-1')->get();
			}

			else
			{
				$candidates = Staff::where('activity_id',$activities->id)->where('prize_id','-1')->where('staff_level','1')->get();
			}

			if($candidates->count()>0)
			{
				for($j=0; $j<10000; $j++)
				{
					$randnum1 = rand (0,($candidates->count()-1));
					$randnum2 = rand (0,($candidates->count()-1));

					$temp =  $candidates[$randnum1];
					$candidates[$randnum1] = $candidates[$randnum2];
					$candidates[$randnum2] = $temp;
				}

				for($i=0; $i<$quota; $i++)
				{				
					$candidates[$i]->prize_id = $prizes->id;
					$candidates[$i]->save();				
				}
			}

			else
			{
				return '剩餘抽獎人數不足';
			}
		}
	
		return redirect('/stafflotto/' . $tag);			
	}
}
