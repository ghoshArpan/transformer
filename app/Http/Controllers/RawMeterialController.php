<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\SubCategoryCreateRequest;
use App\Http\Requests\RawMeterialRequest;

use App\Models\RawMeterialCategory;
use App\Models\Stocks;
use App\Models\Units;
use App\Models\RawMeterials;
use App\Models\RawMeterialSubCategory;
use Illuminate\Support\Facades\DB;

class RawMeterialController extends Controller
{


	public function view_stock(){
		$datas=Stocks::view_stock_history();
		return view('view_stock_history',compact('datas'));
	}

	public function addcategory(CategoryCreateRequest $request){
	
		return RawMeterialCategory::create_update_category();
		
	}
	
	public function category(){
		
		$data=RawMeterialCategory::fetch_data();
		return view('add_edit_category',compact('data'));
		
		
	}
	
	public function categoryList(){
		$datas=RawMeterialCategory::category_List();
		return view('category_list',compact('datas'));
	}
	
	public function addsubcategory(SubCategoryCreateRequest $request){
	
		return RawMeterialSubCategory::create_update_subcategory();
		
	}
	
	public function subcategory(){
		
		$data=RawMeterialSubCategory::fetch_data();
		$category=RawMeterialCategory::fetch_category();
		return view('add_edit_sub_category',compact('data','category'));
		
		
	}
	
	public function subcategoryList(){
		$datas=RawMeterialSubCategory::subcategory_List();
		return view('sub_categoryList',compact('datas'));
	}
	
	
	public static function raw_meterial(){
		$category=RawMeterialCategory::fetch_category();
		$units=Units::fetch_unit();
		$data=RawMeterials::fetch_data();
		return view('add_edit_raw_meterial',compact('data','category','units'));
		
	}
	
	public static function rawMeterial_List(){
		$datas=RawMeterials::rawMeterial_List();
		return view('raw_meterial_list',compact('datas'));
		
	}
	
	public function add_edit_raw_meterial(RawMeterialRequest $request){
	
		return RawMeterials::create_update_RawMeterial();
	}	

	public function get_subcategory(Request $request)
	{
		$subId=request()->sub_category_id;
		$data = RawMeterialSubCategory::get_subcategory_data();
		$html=view('sub_category_options',compact('data','subId'));
		return $html;
	}
	
	public function get_raw_meterial(Request $request)
	{
		$raw_id=request()->raw_meterial;
		$data = RawMeterials::get_raw_meterial();
		$html=view('raw_meterial_options',compact('data','raw_id'));
		return $html;
	}
		public function fetch_raw_meterial_wise_amt(Request $request)
	{
		
		$data = RawMeterials::fetch_raw_meterial_wise_amt();
		
		return $data;
	}

	public function fetch_raw_meterial_wise_amt_stock_wise(Request $request)
	{
		
		$data = Stocks::fetch_raw_meterial_wise_amt_stock_wise_two();
		
		return $data;
	}
	
	
	public function stock(){
		
		$data=Stocks::fetch_data();
		$category=RawMeterialCategory::fetch_category();
		
		return view('stock',compact('data','category'));
	}
	
	public static function stockList(){

		$datas=Stocks::stock_list();
		return view('stock_list',compact('datas'));
	}
	
	public function add_edit_stock(){
		
		return Stocks::create_update_stock();
		
	}
	
	
}