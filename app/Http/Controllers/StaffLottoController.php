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
		$awards = Award::where('activity_id',$activities->id)->where('award_status',true)->get();
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
		$awards = Award::where('activity_id',$activities->id)->where('award_status',true)->get();
		$prizes = Award::join('prizes',function($join) use ($activities)
		{
			$join->on('awards.id','=','prizes.award_id')
				->where('activity_id','=',$activities->id);
		})->get();
		
		//show所需data
		$nowprize = Prize::where('id',$tag)->where('prize_status',true)->first();
		$winners = Staff::where('activity_id',$activities->id)->where('prize_id',$tag)->orderby('id')->get();

		$winnersnum = '';
		for($i=0; $i<$winners->count(); $i++)
		{
			$winnersnum = $winnersnum . $winners[$i]->staff_activity_number . " ";
		}

		if($nowprize->prize_page == 1)
		{
			$nowprize->prize_page = 2;
			$nowprize->save();
		}

		else if($nowprize->prize_page == 2)
		{
			$nowprize->prize_page = 3;
			$nowprize->save();
		}

		
		return view('stafflotto.show',compact('activities','awards','prizes','nowprize','winners','winnersnum'));
	}

	public function update($tag)
	{
		$activities = Activity::where('activity_status',true)->first();
		$winnerssum = Staff::where('activity_id',$activities->id)->where('prize_id',$tag)->where('staff_status',true)->count();
		$prizes = Prize::where('id',$tag)->first();
		$quota = $prizes->prize_amount - $winnerssum;
		
		if($quota>0)
		{
			if($prizes->prize_level == '0')
			{
				$candidates = Staff::where('activity_id',$activities->id)->where('prize_id','-1')->where('staff_status',true)->get();
			}

			else
			{
				$candidates = Staff::where('activity_id',$activities->id)->where('prize_id','-1')->where('staff_level','1')->where('staff_status',true)->get();
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

				$prizes->prize_page = 1;
				$prizes->save();
			}

			else
			{
				return '剩餘抽獎人數不足';
			}
		}
	
		return redirect('/stafflotto/' . $tag);			
	}
}
