<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourAttendance extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table="labour_attendance";
    protected $primaryKey="code";
	
	
	
	public static function fetch_all_attendance(){
		//$date=date('Y-m-d');
		return LabourAttendance::orderBy('code','desc')->select('*')->get();

	}
	
	
	public static function fetch_today_attendance(){
		$date=date('Y-m-d');
		return LabourSubAttendance::where('date', $date)->pluck('labour_code')->toArray();

	}
	
	public static function attendance_submit(){
		$req=request();
		$attendance=$req->attendance;
		$employee=$req->employee_id;
		
		$delet=LabourAttendance::where('date',date('Y-m-d'))->delete();
		$delets=LabourSubAttendance::where('date',date('Y-m-d'))->delete();
		

		if (!empty($attendance)) {
			
			$data=new LabourAttendance();
			$data->total_present=count($req->attendance);
			$data->date=date('Y-m-d');
			$data->Save();



			foreach ($attendance as $key => $value) {
				if (!empty($value)) { // Check if checkbox is checked
					$datas = new LabourSubAttendance();
					$datas->attendance_code = $data->code;
					$datas->labour_code = $employee[$key][0]; // Get corresponding employee ID
					$datas->present_absent = "1";
					$datas->date = date('Y-m-d');
					$datas->save();
				}
			}
		}
		

		return redirect()->route('attendance_sheet')->with('success', "Attendance Updated successfully");
		
		

		
	
	}
}
