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
		$prizes_type = Prize::distinct()->select('type')->get();

		if(!empty(Session::get('type')))
		{
			$prizes_nowtype = Session::get('type');
			Session::forget('type');
			$prizes_of_type = Prize::get()->where('type',$prizes_nowtype);
		}
		//$prizes_of_type = null;
		

		return view('stafflotto.index',compact('staffs','prizes_type','prizes_of_type'));
	}

	public function show($type)
	{
		$prizes = Prize::get()->where('type',$type);
		//dd($prizes);
		return view('stafflotto.show',compact('prizes'));
	}

	public function refresh($type)
	{
		
		Session::put('type',$type);


		return redirect('/stafflotto');
	}
}
