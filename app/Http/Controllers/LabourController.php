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
		$currentYearMonth = date('Y-m');
		$currentMonth = Carbon::now();
		$monthName = $currentMonth->format('F Y');
		
		$employees = Labours::all()->map(function($employee) use ($currentYearMonth, $daysInMonth) {
			
			$attendanceData = array_fill(1, $daysInMonth, 0);
			$totalDays = 0;
			$totalPayable = 0;
			
			$attendanceRecords = LabourSubAttendance::where('labour_code', $employee->code)
				->where('date', 'like', $currentYearMonth . '%')
				->get();
				
			foreach ($attendanceRecords as $record) {
				$day = (int) date('d', strtotime($record->date));
				if ($day >= 1 && $day <= $daysInMonth) {
					$attendanceData[$day] = $record->present_absent;
					$totalDays += $record->present_field;
					$totalPayable += $record->total_amount;
				}
			}
			
			return [
				'employee' => $employee,
				'attendance_data' => $attendanceData,
				'total_days' => $totalDays,
				'total_payable' => $totalPayable
			];
		});
		
		return view('attendance_page', compact('employees', 'daysInMonth', 'monthName'));
	}
	public function attendance_page_save(Request $request)
	{
		$data = $request->all();
		$currentYearMonth = date('Y-m'); 

		foreach ($data['employee_id'] as $key => $employeeId) {

			$employee = Labours::find($employeeId);
			$dailyWage = $employee->per_day_wages;

			for ($day = 1; $day <= $data['days_in_month']; $day++) {
				$fieldName = "attendance_{$employeeId}_{$day}";
				$dayValue = $data[$fieldName] ?? 0;

				if ($dayValue > 0) {
					$date = $currentYearMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
					$totalAmount = $dayValue * $dailyWage;
					LabourSubAttendance::insert([
					'date' => $date,            
					'labour_code' => $employeeId,
					'wages' => $dailyWage,
					'present_absent' => $dayValue 
					]);
				}
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