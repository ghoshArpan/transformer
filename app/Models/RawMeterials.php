<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMeterials extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table="raw_meterial";
    protected $primaryKey="code";
	

	 public function category_data()
    {
        return $this->belongsTo(RawMeterialCategory::class, 'category_id', 'code');
    }
	
	
	public function subcategory_data()
    {
        return $this->belongsTo(RawMeterialSubCategory::class, 'sub_category_id', 'code');
    }
	
	public function unit_name()
    {
        return $this->belongsTo(Units::class, 'unit_id', 'code');
    }
	
	public static function fetch_raw_meterial_wise_amt(){
		$raw_meterial=request()->raw_meterial;
		
		$datas= RawMeterials::where('code',$raw_meterial)->first();

		$response=[
			'amount'=>$datas->rate,
			'unit'=>$datas->unit_name() ? $datas->unit_name()->first()->unit : "",
			'total_stock'=>$datas->total_stock
		];
		// dd($response);
		return $response;
		
	}
	public static function fetch_data(){
		$rawMet_code=request()->raw_code ?  decrypt(request()->raw_code): 0;
		
		return RawMeterials::where('code',$rawMet_code)->first();
	}
	
	public static function rawMeterial_List(){
		
		$rawmeterialList=RawMeterials::paginate(10);
		return $rawmeterialList;
	}
	
	public static function create_update_RawMeterial(){
		
		$raw_meterial_code=request()->raw_meterial_code ?  request()->raw_meterial_code: 0;
		if($raw_meterial_code>0):
		$messege="Raw Meterial Updated Successfully";
		$category= RawMeterials::find($raw_meterial_code);
		else:
		$messege="Raw Meterial added Successfully";
		$category=new RawMeterials();
		endif;

		$category->category_id = request()->category_id;
		$category->sub_category_id = request()->sub_category_id;
		$category->name = request()->name;
		$category->unit_id = request()->unit;
		$category->details = request()->details;
		$category->rate = request()->rate;
		$category->save();


		return redirect()->route('rawMeterial_List')->with('success', $messege);
	
	}
	
	public static function get_raw_meterial(){
	
		$category=request()->category_id;
		$sub_category=request()->sub_category_id;
		
		return RawMeterials::where('category_id',$category)->where('sub_category_id',$sub_category)->get();
	
	}
}
