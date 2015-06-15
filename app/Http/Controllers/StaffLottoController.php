<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;
use App\Prize;
use Illuminate\Support\Facades\Session;

class StaffLottoController extends Controller {

	//
	public function index()
	{
		$staffs = Staff::get();
		$prizes = Prize::get();
		$prizes_type = Prize::distinct()->select('type')->get();		

		return view('stafflotto.index',compact('staffs','prizes','prizes_type'));
	}

	public function show($name)
	{
		$staffs = Staff::get();
		$prizes = Prize::get();
		$prizes_type = Prize::distinct()->select('type')->get();
		$nowprizes = Prize::where('name',$name)->get();
		$winners = Staff::where('prize_code',$name)->get();

		return view('stafflotto.show',compact('staffs','prizes','prizes_type','nowprizes','winners'));
	}

	public function update($name,Staff $candidate)
	{
		$staffs = Staff::get();
		$prizes = Prize::get();
		$prizes_type = Prize::distinct()->select('type')->get();
		$nowprizes = Prize::where('name',$name)->get();
		$winnersnum = Staff::where('prize_code',$name)->count();

		
		if($winnersnum<=0)
		{
			if($nowprizes[0]->level == 0)
			{
				$candidates = $candidate->where('prize_code','-1')->get();
				$candidatesnum = $candidate->where('prize_code','-1')->count();

				if($candidatesnum-$nowprizes[0]->amount >= 0)
				{
					for($j = 0; $j<10000; $j++)
					{
						$randnum1 = rand (0,($nowprizes[0]->amount-1));
						$randnum2 = rand (0,($nowprizes[0]->amount-1));

						$temp =  $candidates[$randnum1];
						$candidates[$randnum1] = $candidates[$randnum2];
						$candidates[$randnum2] = $temp;
					}

					for($i = 0; $i<$nowprizes[0]->amount; $i++)
					{				
						$candidates[$i]->prize_code = $name;
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
				$candidate = Staff::where('prize_code','')->where('level','1') ->get();			
			}
		}

		return redirect('/stafflotto/' . $name);			
	}

}
