<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UnitCreateRequest;
use App\Models\Units;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{

	public function addUnit(UnitCreateRequest $request){
	
		return Units::create_update_unit();
		
	}
	
	public function unit(){
		
		$data=Units::fetch_data();
		return view('add_edit_unit',compact('data'));
		
		
	}
	
	public function unitList(){
		$datas=Units::unit_List();
		return view('unit_list',compact('datas'));
	}
	
}