<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RawMeterialCategory;

class RawMeterialSubCategory extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table="raw_meterial_sub_category";
    protected $primaryKey="code";
	
	 public function category_data()
    {
        return $this->belongsTo(RawMeterialCategory::class, 'category_id', 'code');
    }
	public static function create_update_subcategory(){
		
		$subcategorycode=request()->subcategory_code ?  request()->subcategory_code: 0;
		if($subcategorycode>0):
		$message="Sub Category Updated Successfully";
			$subcategory= RawMeterialSubCategory::find($subcategorycode);
		else:
		$message="Sub Category added Successfully";
			$subcategory=new RawMeterialSubCategory();
		endif;
	
		$subcategory->category_id = request()->category_id;
		$subcategory->sub_category = request()->sub_category;
		$subcategory->save();
		

    return redirect()->route('subcategoryList')->with('success', $message);
	}
	
	public static function fetch_data(){
		$subcategorycode=request()->subcategory_code ?  decrypt(request()->subcategory_code): 0;
		
		return RawMeterialSubCategory::where('code',$subcategorycode)->first();
	}
	
	public static function get_subcategory_data(){
		$categoryId=request()->category_id;
		
		return RawMeterialSubCategory::where('category_id',$categoryId)->get();
	}
	
	public static function subcategory_List(){
		
		$subcategory= RawMeterialSubCategory::paginate(10);
		return $subcategory;
	}
	
}
