<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourSubAttendance extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "labour_sub_attendance";
    protected $primaryKey = "code";
	
	 public function labourData()
    {
        return $this->belongsTo(Labours::class, 'labour_code', 'code');
    }
	
	public static function fetch_datewise_attendance(){
		
		$code=decrypt(request()->attendance_code);
		return LabourSubAttendance::select('*')->where('attendance_code',$code)->get();

	}
}
