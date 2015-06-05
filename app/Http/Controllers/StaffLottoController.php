<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;
use App\Prize;

class StaffLottoController extends Controller {

	//
	public function index()
	{
		$staffs = Staff::get();
		$prizes = Prize::get();

		return view('stafflotto.index',compact('staffs'),compact('prizes'));
	}

	public function show($code)
	{
		$staffs = Staff::get()->where('code',$code)->first();

		return view('stafflotto.show',compact('staffs'));
	}
}
