<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMeterialCategory extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table="raw_meterial_category";
    protected $primaryKey="code";
	
	
	public static function fetch_category(){
		return RawMeterialCategory::select('code','category')->get();
	}
	
	public static function create_update_category(){

		$categorycode=request()->category_code ?  request()->category_code: 0;
		if($categorycode>0):
		$messege="Category Updated Successfully";
		$category= RawMeterialCategory::find($categorycode);
		else:
		$messege="Category added Successfully";
		$category=new RawMeterialCategory();
		endif;

		$category->category = request()->category;
		$category->save();


		return redirect()->route('categoryList')->with('success', $messege);
	}
	
	public static function fetch_data(){
		$categorycode=request()->category_code ?  decrypt(request()->category_code): 0;
		
		return RawMeterialCategory::where('code',$categorycode)->first();
	}
	
	public static function category_List(){
		
		$category= RawMeterialCategory::paginate(10);
		return $category;
	}
}
