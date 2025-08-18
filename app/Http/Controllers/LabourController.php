<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LabourCreateRequest;
use App\Models\Labours;
use App\Models\LabourAttendance;
use App\Models\LabourSubAttendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;  // Add this at the top with other use statements

class LabourController extends Controller
{
	
	public function attendance_page()
	{
		$daysInMonth = date('t');
		$currentYear = date('Y');
		$currentMonth = date('m');
		$monthName = date('F Y');

		$employeeData = Labours::all()->map(function ($employee) use ($daysInMonth) {

		// Default fill
		$attendanceData = array_fill(1, $daysInMonth, 0);
		$totalDays = 0;
		$totalPayable = 0;

		// fetch one row of attendance for this employee & month
		$attendanceRecord = LabourSubAttendance::where('labour_code', $employee->code)->first();

		if ($attendanceRecord) {
			for ($day = 1; $day <= $daysInMonth; $day++) {
				$col = 'date' . str_pad($day, 2, '0', STR_PAD_LEFT);

				$attendanceData[$day] = $attendanceRecord->$col ?? 0;
				$totalDays += $attendanceData[$day];
			}

			// payable = days × wage
			$totalPayable = $totalDays * $employee->per_day_wages;
		}

		return [
		'employee'       => $employee,
		'attendance_data'=> $attendanceData,
		'total_days'     => $totalDays,
		'total_payable'  => $totalPayable
		];
		});

		return view('attendance_page', compact('employeeData', 'daysInMonth', 'monthName', 'currentMonth', 'currentYear'));
	}


	public function attendance_page_save(Request $request)
	{
		$data = $request->all();
		$currentYear = date('Y'); 
		$currentMonth = date('m'); 

		foreach ($data['employee_id'] as $key => $employeeId) {
			$employee = Labours::find($employeeId);
			$dailyWage = $employee->per_day_wages;

			$updateData = [];
			$totalDays = 0;
			$totalPayable = 0;

			for ($day = 1; $day <= $data['days_in_month']; $day++) {
				$fieldName = "attendance_{$employeeId}_{$day}";
				$dayValue = $data[$fieldName] ?? 0;

				$col = 'date' . str_pad($day, 2, '0', STR_PAD_LEFT);
				$updateData[$col] = $dayValue;

				$totalDays += $dayValue;
			}

			// calculate payable
			$totalPayable = $totalDays * $dailyWage;
			$updateData['total_payable_amt'] = $totalPayable;
			$updateData['labour_code'] = (int)$employeeId;
			$updateData['year'] = $currentYear;
			$updateData['month'] = $currentMonth;

			$attendance = LabourSubAttendance::where('labour_code', $employeeId)
			->where('year', $currentYear)
			->where('month', $currentMonth)
			->first();



			if ($attendance) {

				$attendance->update($updateData);
			} else {
				LabourSubAttendance::create($updateData);
			}

		}

		return redirect()->back()->with('success', 'Attendance saved successfully!');
	}

	public function addLabour(LabourCreateRequest $request){
	
		return Labours::create_update_labour();
		
	}
	
	public function labour(){
		
		$data=Labours::fetch_data();
		return view('add_edit_labour',compact('data'));
		
		
	}
	
	public function attendance_sheet(){
		
		$datas=Labours::labour_list();
		$attendance=LabourAttendance::fetch_today_attendance();
		
		return view('attendance_sheet',compact('datas','attendance'));
		
		
	}
	
	public static function view_attendance(){
		
		$datas=LabourSubAttendance::fetch_datewise_attendance();
		
		return view('view_full_attendance',compact('datas'));
	}
	public function attendance_list(){
		
		
		$datas=LabourAttendance::fetch_all_attendance();
		
		return view('attendance_list',compact('datas'));
		
		
	}
	public function attendance_submit(){
		
		return LabourAttendance::attendance_submit();
	}
	
	
	
	public function LabourList(){
		$datas=Labours::labour_list();
		
		return view('labour_list',compact('datas'));
	}
	public function labour_status_update(Request $request)
	{
		return Labours::labour_status_update();
	}
}