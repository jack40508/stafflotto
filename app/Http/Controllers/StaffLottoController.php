<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;
use App\Prize;
use App\Activity;
use App\Award;
use App\Picture;
use Illuminate\Support\Facades\Session;

class StaffLottoController extends Controller {

	public function index()
	{
		$activities = Activity::where('activity_status',true)->first();
		if(!empty($activities))
		{
			$awards = Award::where('activity_id',$activities->id)->where('award_status',true)->get();
			
			$prizes = Award::join('prizes',function($join) use ($activities)
			{
				$join->on('awards.id','=','prizes.award_id')
					->where('activity_id','=',$activities->id);
			})->get();
			
			$pictures = Picture::where('usingfor',$activities->id)->first();
			$background = Picture::where('usingfor','0')->first();
		}

		return view('stafflotto.index',compact('tag','activities','prizes','awards','pictures','background'));
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

		$background = Picture::where('usingfor','0')->first();
		
		//show所需data
		$nowprize = Prize::where('id',$tag)->where('prize_status',true)->first();
		$winners = Staff::where('activity_id',$activities->id)->where('prize_id',$tag)->orderby('id')->get();

		if($nowprize->prize_amount - $winners->count() <= 0 && $nowprize->prize_page != 1)	//若沒有剩餘名額，直接顯示中獎人，且並不是第一次抽獎
		{
			$nowprize->prize_page = 3;
			$nowprize->save();
		}

		if($nowprize->prize_page == 1)//抽獎ING
		{
			//僅需顯示該獎項該輪的得獎者
			$winners = Staff::where('activity_id',$activities->id)->where('prize_id',$tag)->where('staff_round',$nowprize->prize_round)->orderby('id')->get();

			$nowprize->prize_page = 2;
			$nowprize->save();

			//抽獎ING時打亂結果，以達到抽獎效果
			for($j=0; $j<10000; $j++)
			{
				$randnum1 = rand (0,($winners->count()-1));
				$randnum2 = rand (0,($winners->count()-1));

				$temp =  $winners[$randnum1];
				$winners[$randnum1] = $winners[$randnum2];
				$winners[$randnum2] = $temp;
			}
		}

		else if($nowprize->prize_page == 2)//抽獎完畢，讓頁面變為檢視結果
		{
			$nowprize->prize_page = 3;
			$nowprize->save();
		}

		$winnersnum = '';
		for($i=0; $i<$winners->count(); $i++)
		{
			$winnersnum = $winnersnum . $winners[$i]->staff_activity_number . " ";
		}

		$pictures = Picture::where('usingfor',$activities->id)->first();

		return view('stafflotto.show',compact('activities','awards','prizes','nowprize','winners','winnersnum','pictures','background'));
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

				$prizes->prize_page = 1;
				$prizes->prize_round++;
				$prizes->save();

				for($i=0; $i<$quota; $i++)
				{				
					$candidates[$i]->prize_id = $prizes->id;
					$candidates[$i]->staff_round = $prizes->prize_round;
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
