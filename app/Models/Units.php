<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table="unit";
    protected $primaryKey="code";
	
	
	public static function fetch_unit(){
		
		return Units::select('code','unit')->get();
		
	}
	
	public static function create_update_unit(){
		
		$unitcode=request()->unit_code ?  request()->unit_code: 0;
		if($unitcode>0):
		$message="Unit Updated Successfully";
			$unit= Units::find($unitcode);
		else:
		$message="Unit added Successfully";
			$unit=new Units();
		endif;
	
		$unit->unit = request()->unit;
		$unit->save();
		

    return redirect()->route('unitList')->with('success', $message);	
	}
	
	public static function fetch_data(){
		$unitcode=request()->unit_code ?  decrypt(request()->unit_code): 0;
		
		return Units::where('code',$unitcode)->first();
	}
	
	public static function unit_List(){
		
		$unit=Units::paginate(10);
		return $unit;
	}
	
}
