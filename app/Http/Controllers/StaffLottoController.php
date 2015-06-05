<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Staff;

class StaffLottoController extends Controller {

	//
	public function index()
	{
		
		dd(Staff::get());

		/*
		$staff_name = ['YoYu','Jhou'];
		//$test_name = '123';

		return view('stafflotto.index',compact('staff_name'));

		//return view('stafflotto',['test_name' => $test_name]);*/
	}

	public function show($id)
	{
		$staff_names = ['YoYu','Jhou'];
		$staff_name = $staff_names[$id];
		return view('stafflotto.show',compact('staff_name'));
	}
}
