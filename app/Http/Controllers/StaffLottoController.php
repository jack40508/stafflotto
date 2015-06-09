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
		
		return view('stafflotto.show',compact('staffs','prizes','prizes_type','nowprizes'));
	}

	public function update($name)
	{
		return '123';
	}

}
