<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transformer extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "transformer";
    protected $primaryKey = "code";

    public function statusHistories()
    {
        return $this->hasMany(TransformerStatusHistory::class, 'transformar_code', 'code');
    }

    public function financiarYear()
    {
        return $this->belongsTo(FinancialYear::class, 'financial_year', 'code');
    }



    public static function get_total_costing($id)
    {
        $labourCost = LabourCostHistory::where('transformar_code', $id)->sum('cost');
        $rawCost = TransformerRawMeterials::where('transformar_code', $id)->sum('cost');
        $misCost = TransformerMiscleniousCost::where('transformar_code', $id)->sum('amount');
        $logisCost = TransformerLogisticCost::where('transformar_code', $id)->sum('amount');
        $total = (float)$labourCost + (float)$rawCost + (float)$logisCost + (float)$misCost;
        return $total;
    }

    public static function get_margin($cost, $poVal)
    {
        $margin = (float)$poVal - (float)$cost;
        return $margin > 0 ? $margin : 0;
    }
    public static function update_tag_other_data()
    {

        $transformerCode = request()->transformerCode ? request()->transformerCode : 0;

        $trans = Transformer::find($transformerCode);
        $trans->po_no = request()->po_number;
        $trans->memo_no = request()->memo_no;
        $trans->memo_date = date('Y-m-d',strtotime(request()->memo_date));
        $trans->po_value = request()->po_value;
        $trans->invoice =  request()->invoice;
        $trans->submit_no =  request()->submit_no;
        $trans->bill_submit_date = request()->bill_submit_date;
        $trans->paid_date =  request()->paid_date;
        $trans->bill_tt =  request()->bill_tt;
        $trans->rec_value =  request()->rec_value;
        $trans->ddc =  request()->ddc;
        $trans->sd_amt =  request()->sd_amt;
        $trans->sd_claimed =  request()->sd_claimed;
        $trans->sd_paid =  request()->sd_paid;
        //$trans->ssn = request()->ssn;
        // $trans->delivered = request()->delivered;
        // $trans->received = date('Y-m-d', strtotime(request()->received));
        $trans->save();
        $message = "Updated Successfully";

        return redirect()->route('transformer_List')->with('success', $message);
    }



    public function jobStatus()
    {
        return $this->belongsTo(JobStatus::class, 'job_status', 'code');
    }

    public static function update_status_save()
    {
        $ids = request()->transformar_ids;
        $allIds = explode(',', $ids);
        $status = request()->status;
        $request = request();
        foreach ($allIds as $k => $v) {
            $datas = Transformer::find($v);
            $datas->job_status = $status;

            if ($status == 2) {
                $datas->dis_date = $request->dis_date;
                $datas->dis_reason = $request->dis_reason;
            }

            // if ($status == 6) {
            //     $datas->invoice = $request->invoice;
            // }

            // if ($status == 7) {
            //     $datas->submit_no = $request->submit_no;
            //     $datas->bill_submit_date = $request->bill_submit_date;
            // }

            // if ($status == 8) {
            //     $datas->paid_date = $request->paid_date;
            //     $datas->bill_tt = $request->bill_tt;
            //     $datas->rec_value = $request->rec_value;
            //     $datas->ddc = $request->ddc;
            //     $datas->sd_amt = $request->sd_amt;
            //     $datas->sd_claimed = $request->sd_claimed;
            //     $datas->sd_paid = $request->sd_paid;
            // }
            $datas->save();
        }
        $message = "Status Updated Successfully";

        foreach ($allIds as $k => $v):
            TransformerStatusHistory::transformar_history_save($v, request()->status);
        endforeach;

        return redirect()->route('transformer_List')->with('success', $message);
    }
    public static function create_update_transformer()
    {

        $transformerCode = request()->transformer_code ? request()->transformer_code : 0;
        if ($transformerCode > 0):
            $message = "Tag Updated Successfully";
            $trans = Transformer::find($transformerCode);
        else:
            $message = "Tag added Successfully";
            $trans = new Transformer();
        endif;

        $trans->unique_code = request()->unique_code;
        $trans->office_name = request()->office_name;
        $trans->financial_year = Transformer::getFinancialYear();
        // $trans->kva = request()->kva;
        $trans->work_name = request()->work_name;
        $trans->save();
        if ($transformerCode > 0):
        else:
            TransformerStatusHistory::transformar_history_save($trans->code, 1);
        endif;

        return redirect()->route('transformer_List')->with('success', $message);
    }

    public static function fetch_data()
    {
        $trans_code = request()->transformer_code ? decrypt(request()->transformer_code) : 0;

        return Transformer::where('code', $trans_code)->first();
    }
    public static function view_status_history()
    {
        $trans_code = request()->transformer_code ? decrypt(request()->transformer_code) : 0;

        return TransformerStatusHistory::with('transformer')->where('transformar_code', $trans_code)->paginate(10);
    }



    public static function transformer_List()
    {

        $transformer = Transformer::orderBy('code', 'desc');

        if (request()->statusSearch) {
            $transformer = $transformer->where('job_status', request()->statusSearch);
        }
        $transformer = $transformer->paginate(10);
        return $transformer;
    }
    public static function transformer_cost_List()
    {

        $transformer = Transformer::where('job_status', 1)->orderBy('code', 'desc')->paginate(10);
        return $transformer;
    }

    public static function add_labour_cost()
    {
        $dataids = request()->selectedIds;
        $todayDate = date('Y-m-d');
        $todayLabours = LabourSubAttendance::where('date', $todayDate)->pluck('labour_code')->toArray();
        // dd($todayLabours);
        if (empty($todayLabours)) {
            $response = [
                'status' => 400,
                'messege' => "Please Mark Labour Attendance First",
            ];
            return $response;
        }
        $labourWages = Labours::whereIn('Code', $todayLabours)->sum('per_day_wages');

        $totalT = count($dataids);
        if ($totalT == 0) {
            $response = [
                'status' => 400,
                'messege' => "Please Select atleast one transformer",
            ];
        }

        LabourCostHistory::where('date', $todayDate)->delete();
        $perLabourCost = (float)($labourWages / $totalT);

        foreach ($dataids as $v) {
            $cost = new LabourCostHistory();
            $cost->date = $todayDate;
            $cost->transformar_code = $v;
            $cost->cost = $perLabourCost;
            $cost->save();
        }

        $response = [
            'status' => 200,
            'messege' => "Add Cost Successfully",
        ];
        return $response;
    }

    public static function create_unique_no()
    {

        $pre = "TRANSFORMER";
        $value = Transformer::max('code') ?? 0;


        $transformerCode = request()->transformer_code ? decrypt(request()->transformer_code) : 0;
        if ($transformerCode > 0):
            $tra = Transformer::where('code', $transformerCode)->first();
            $uniqueId = $tra->unique_code;
        else:
            $uniqueId = $value + 1;
        endif;
        return $uniqueId;
    }

    public static function fetch_transformer_data()
    {
        $trans_code = request()->transformer_code ? decrypt(request()->transformer_code) : 0;
        return Transformer::where('code', $trans_code)->get();
    }
    public static function getFinancialYear()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        if ($currentMonth >= 4) {
            $startYear = $currentYear;
            $endYear = $currentYear + 1;
        } else {
            $startYear = $currentYear - 1;
            $endYear = $currentYear;
        }

        $financialYear = $startYear . '-' . $endYear;

        $data = FinancialYear::where('financial_year', $financialYear)
            ->first();

        return  $data->code;
    }
}
