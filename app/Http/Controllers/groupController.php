<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_group;
use App\Models\tbl_loan_details;
use App\Models\tbl_group_member;
use Illuminate\Support\Facades\DB;

class groupController extends Controller
{
    public function group_list()
    {
        return view('group_list');
    }

    public function show_group_list(Request $request)
    {

        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occured in form submit.'];
            return response()->json($response, $statusCode);
        }

        $this->validate(
            $request,
            [
                'draw' => 'required|integer|between:0,9999999999',
                'start' => 'required|integer|between:0,999999999',
                'length' => 'required|integer|between:0,100',
                'search.*' => 'nullable|regex:/^[A-Za-z0-9\s]+$/i',
                'order' => 'array',
                'offset' => 'regex:/^[0-9]+$/i',
                'order.*.column' => 'required|integer|between:0,7',
                'order.*.dir' => 'required|in:asc,desc',
            ],
            [
                'draw.required' => 'Invalid Input',
                'draw.between' => 'Invalid Input',
                'draw.integer' => 'Invalid Input',

                'start.required' => 'Invalid Input',
                'start.between' => 'Invalid Input',
                'start.integer' => 'Invalid Input',

                'length.required' => 'Invalid Input',
                'length.between' => 'Invalid Input',
                'length.integer' => 'Invalid Input',

                'order.array' => 'Invalid Input',

                'order.*.column.required' => 'Invalid Input',
                'order.*.column.integer' => 'Invalid Input',
                'order.*.column.between' => 'Invalid Input',

                'order.*.dir.required' => 'Invalid Input',
                'order.*.dir.in' => 'Invalid Input',
                'search.*.regex' => 'Invalid Input',
                'offset.regex' => 'Offset value can only integer',
            ],
        );

        try {
            $draw = $request->draw;
            $length = $request->length;
            $offset = $request->start;
            $search = $request->search['value'];
            $data = [];

            $group_detail = tbl_group::join('tbl_blocks', 'tbl_blocks.code', 'tbl_groups.block_code')
                ->join('tbl_gps', 'tbl_gps.code', 'tbl_groups.gp_code')
                ->select('tbl_groups.code', 'tbl_groups.shg_code', 'tbl_groups.name', 'tbl_groups.date', 'tbl_groups.bank_name', 'tbl_groups.branch_name', 'tbl_groups.ifsc_code', 'tbl_blocks.block_name', 'tbl_gps.gp_name')
                ->orderby('tbl_groups.code', 'asc')
                ->where(function ($q) use ($search) {
                    $q->orwhere('tbl_groups.name', 'like', '%' . $search . '%');
                    $q->orwhere('tbl_groups.shg_code', 'like', '%' . $search . '%');
                });

            // dd($group_detail);

            $filtered_count = $group_detail->count();
            $record = $group_detail;
            $page_displayed = $record
                ->offset($offset)
                ->limit($length)
                ->get();
            $count = $offset + 1;

            foreach ($page_displayed as $group) {
                $group_members = tbl_group_member::where('group_code', $group->code)->select('*')->get();
                //dd($group_members);

                $groupdata['id'] = $count;
                $groupdata['name'] = $group->name;
                $groupdata['shg_code'] = $group->shg_code;
                $groupdata['date'] = $group->date;
                $groupdata['bank_name'] = $group->bank_name;
                $groupdata['branch_name'] = $group->branch_name;
                $groupdata['block_name'] = $group->block_name;
                $groupdata['gp_name'] = $group->gp_name;
                $groupdata['action'] = "<button class='btn btn-warning model_btn'  id='" . $group->code . "' data-toggle='modal' data-target='#exampleModal' ><i class='fa fa-eye'></i></button>";
                $count++;
                $groupdata['group_members'] = $group_members;
                $data[] = $groupdata;
            }
            //dd($group_members);
            $response = [
                'draw' => $draw,
                'recordsTotal' => $filtered_count,
                'recordsFiltered' => $filtered_count,
                'record_details' => $data,

            ];
        } catch (\Exception $e) {
            $response = [
                'exception' => true,
                'exception_message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }

        //dd($response);
        //return response()->json($response);
    }

    public function model_view_group_data(Request $request)
    {
        // dd($request->all());

        $this->validate(
            $request,
            ['model_id' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );


        $model_code = $request->model_id;

        $model_group = tbl_group::join('tbl_blocks', 'tbl_blocks.code', 'tbl_groups.block_code')
            ->join('tbl_gps', 'tbl_gps.code', 'tbl_groups.gp_code')
            ->where('tbl_groups.code', $model_code)
            ->select(
                'tbl_groups.shg_code',
                'tbl_groups.name',
                'tbl_groups.date',
                'tbl_groups.village_name',
                'tbl_groups.bank_name',
                'tbl_groups.branch_name',
                'tbl_groups.ifsc_code',
                'tbl_groups.nature_of_livelyhood_activities',
                'tbl_groups.sector',
                'tbl_groups.year_of_last_trainning',
                'tbl_groups.account_no',
                'tbl_groups.already_applied_loan',

                'tbl_groups.loan_apply_or_not',
                'tbl_groups.amount',
                'tbl_groups.repayment_done',
                'tbl_groups.date_of_submission_of_application',
                'tbl_groups.application_sansantion_date',
                DB::raw('DATE_FORMAT(application_sansantion_date, "%d%m%Y") as application_sansantion_date'),

                'tbl_groups.santion_or_not',
                'tbl_groups.santion_date',
                DB::raw('DATE_FORMAT(santion_date, "%d%m%Y") as santion_date'),
                'tbl_groups.santion_amount',
                'tbl_groups.last_trainning_date',
                'tbl_groups.type',
                'tbl_blocks.block_name',
                'tbl_gps.gp_name',
            )
            ->first();
        // dd($model_group);

        if ($model_group) {
            $response = [
                'status' => $model_group,
            ];
            return $response;
        }
    }

    public function loan_view_group_data(Request $request)
    {
        //dd($request->all());
        $group_code = $request->group_code;

        $loan_detail = tbl_loan_details::where('group_code', $group_code)
            ->select('code', 'group_code', 'loan_apply_or_not', 'amount', 'date_of_submission_of_application', 'application_sansantion_date', DB::raw('DATE_FORMAT(application_sansantion_date, "%d/%m/%Y") as application_sansantion_date'), 'santion_or_not', 'santion_date', DB::raw('DATE_FORMAT(santion_date, "%d/%m/%Y") as santion_date'), 'santion_amount')
            ->get();
        // dd($loan_detail);
        if ($loan_detail) {
            $response = [
                'send_loan' => $loan_detail,
            ];
            return $response;
        }
    }

    // public function group_member_data(Request $request){

    //   dd($request->all());
    //    $code=$request->group_code;

    //    }
}
