<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labours extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "labour";
    protected $primaryKey = "code";

    public static function create_update_labour()
    {

        $labourcode = request()->labour_code ? request()->labour_code : 0;
        if ($labourcode > 0):
            $message = "labour Updated Successfully";
            $labour = Labours::find($labourcode);
        else:
            $message = "labour added Successfully";
            $labour = new Labours();
        endif;

        $labour->name = request()->name;
        $labour->phone_no = request()->phone_no;
        $labour->per_day_wages = request()->per_day_wages;
        $labour->save();


        return redirect()->route('LabourList')->with('success', $message);
    }

    public static function fetch_data()
    {
        $labourcode = request()->labour_code ? decrypt(request()->labour_code) : 0;

        return Labours::where('code', $labourcode)->first();
    }

    public static function labour_List()
    {

        $labour = Labours::paginate(10);
        return $labour;
    }
	
	public static function labour_status_update(){
		$request=request();
		$labourId = decrypt($request->id);

		// Find the labour record
		$labour = Labours::where('code', $labourId)->first();

		// Check if labour exists
		if (!$labour) {
			return response()->json(['success' => false, 'message' => 'Labour not found!']);
		}

		// Update status
		$labour->status = $request->status;
		$labour->save();

		return response()->json(['success' => true, 'message' => 'Status updated successfully!']);

	}
}
