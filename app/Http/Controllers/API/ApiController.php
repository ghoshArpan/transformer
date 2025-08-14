<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\tbl_group_member;
use App\Models\tbl_group;
use App\Models\tbl_gp;
use App\Models\tbl_block;
use App\Models\tbl_version_check;
use App\Models\tbl_loan_details;
use App\Models\tbl_livelihood;



class ApiController extends Controller
{
	   public function get_block(Request $request)
    {
        $statusCode = 200;
        try {
            $blocks = tbl_block::select('block_name', 'code')->get();
            $response = array(
                'options' => $blocks, 'status' => 1
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function get_gp(Request $request)
    {
        $statusCode = 200;
        try {
            $gps = tbl_gp::where('block_code', $request->block_code)->select('gp_name', 'code')->get();
            $response = array(
                'options' => $gps, 'status' => 1
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function user_entry(Request $request)
    {
        // dd($request->all());
        $statusCode = 200;
        $code = $request->code;
        if ($code) {
            $valid = Validator::make($request->all(),  [

                'name' => "required|regex:/^[A-Za-z\s]+$/i",
                'mobile_no' => "required|digits:10",
                'email' => "required|email",
                'block_code' => "required|integer|between:0,9999999999",
                'gp_code' => "required|integer|between:0,9999999999",
                'username' => "required|min:6|max:10|regex:/^[@A-Za-z0-9\s]+$/i",
                // 'password' => "required|min:6|max:10|regex:/^[@A-Za-z0-9\s]+$/i",
                // 'confirm_password' => "required|same:password",

            ], [
                'name.required' => 'Name is required',
                'mobile_no.required' => 'Mobile Number is required',
                'mobile_no.digits' => 'Mobile Number Must be 10 digit',
                'mobile_no.unique' => 'Mobile Number already taken',
                'username.required' => 'User name is required',
                'username.min' => 'UserName must not be less than 6 character',
                'username.max' => 'UserName must not be greater than 10 character',
                'password.required' => 'Password is required',
                'password.min' => 'Password must not be less than 6 character',
                'password.max' => 'Password must not be greater than 10 character',
                'con_password.required' => 'Confirm Password is required',
                'con_password.same' => 'The password and its confirm are not the same',

            ]);
        } else {
            $valid = Validator::make($request->all(),  [

                'name' => "required|regex:/^[@A-Za-z\s]+$/i",
                'mobile_no' => "required|digits:10",
                'email' => "required|email",
                'block_code' => "required|integer|between:0,9999999999",
                'gp_code' => "required|integer|between:0,9999999999",
                'username' => "required|min:6|max:10|unique:users,username|regex:/^[@A-Za-z0-9\s]+$/i",
                'password' => "required|min:6|max:10|regex:/^[@A-Za-z0-9\s]+$/i",
                'confirm_password' => "required|same:password",

            ], [
                'name.required' => 'Name is required',
                'mobile_no.required' => 'Mobile Number is required',
                'mobile_no.digits' => 'Mobile Number Must be 10 digit',
                'mobile_no.unique' => 'Mobile Number already taken',
                'username.required' => 'User name is required',
                'username.min' => 'UserName must not be less than 6 character',
                'username.max' => 'UserName must not be greater than 10 character',
                'password.required' => 'Password is required',
                'password.min' => 'Password must not be less than 6 character',
                'password.max' => 'Password must not be greater than 10 character',
                'con_password.required' => 'Confirm Password is required',
                'con_password.same' => 'The password and its confirm are not the same',

            ]);
        }

        $response = array(
            'error' => $valid->errors()->all(), 'status' => 5
        );
        if ($valid->fails()) {
            $statusCode = 400;
            return response()->json($response, $statusCode);
        }
        try {

            $name = $request->name;
            $mobile_no = $request->mobile_no;
            $username = $request->username;
            $email = $request->email;
            // $block_code = 1;
            // $gp_code = 1;
            $block_code = $request->block_code;
            $gp_code = $request->gp_code;
            $password = bcrypt($request->password);
            if ($code) {

                $check_data = User::where('code', '!=', $code)->where('username', $username)->count();
                if ($check_data > 0) {
                    $response = array(
                        'status' => 3,

                    );
                } else {
                    $user_save_update = User::find($code);
                }
            } else {
                $user_save_update = new User();
            }
            $user_save_update->name = $name;
            $user_save_update->username = $username;
            $user_save_update->password = $password;
            $user_save_update->mobile_no = $mobile_no;
            $user_save_update->email = $email;
            $user_save_update->block_code = $block_code;
            $user_save_update->gp_code = $gp_code;
            // $block_code = 1;
            // $gp_code = 1;
            // $user_save_update->block_code = $block_code;
            // $user_save_update->gp_code = $gp_code;
            if ($user_save_update->save()) {
                if ($code) {
                    $response = array(
                        'status' => 2,

                    );
                } else {
                    $response = array(
                        'status' => 1,

                    );
                }
            }
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function user_edit(Request $request)
    {
        $statusCode = 200;
        try {
            $code = $request->code;

            $get_user_data = User::where('code', $code)->select('*')->first();
            $response = array(
                'options' => $get_user_data
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function user_delete(Request $request)
    {
        $statusCode = 200;
        try {
            $user_delete = User::where('code', $request->code)->delete();
            $response = array(
                'status' => 1
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage()
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function userList(Request $request)
    {
        $statusCode = 200;
        $response = array();
        $data = array();
        try {
            $filtered = User::join('tbl_blocks', 'tbl_blocks.code', 'users.block_code')
                ->join('tbl_gps', 'tbl_gps.code', 'users.gp_code')->select('tbl_blocks.block_name', 'tbl_gps.gp_name', 'users.name', 'users.username', 'users.code as usercode', 'users.mobile_no', 'users.email');
            // ->get();

            $page_displayed = $filtered->get();
            $record = $filtered;
            $filtered_count = $page_displayed->count();
            $count = 1;

            foreach ($page_displayed as $user) {
                $nestedData['code'] = $count;
                $nestedData['usercode'] = $user->usercode;
                $nestedData['name'] = $user->name;
                $nestedData['username'] = $user->username;
                $nestedData['mobileno'] = $user->mobile_no;
                $nestedData['email'] = $user->email;
                $nestedData['blockname'] = $user->block_name;
                $nestedData['gpname'] = $user->gp_name;
                $data[] = $nestedData;
                $count++;
            }

            $response = array(
                'userlist' => $data
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage()
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function login(Request $request)
    {
		
        $statusCode = 200;
        $valid = Validator::make($request->all(), [
            'username' => "required|regex: /^[@a-zA-Z0-9]+$/i",
            'password' => "required|regex: /^[@a-zA-Z0-9]+$/i",
        ], [
            'username.required' => 'Username is Required',
            'username.regex' => 'Username Must Be Alphabet And Numeric value And Allow @',
            'password.required' => 'Password is Required',
            'password.regex' => 'Password Must Be Alphabet And Numeric value And Allow @',
        ]);
		
        $response = array(
            'error' => $valid->errors()->all(), 'status' => 5
        );
        if ($valid->fails()) {
            $statusCode = 400;
            return response()->json($response, $statusCode);
        }
        $username = request('username');
        $password = request('password');
		
       // $getPassword = new User();
		// $customUsername = 'username';
        $checkusername = User::where('username', $username)->get();
		
        //$getUserData = $getPassword->findForPassport($username);
        //dd($getUserData);
        if (isset($checkusername)) {
            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                $user = Auth::user();


                $success['token'] = $user->createToken('appToken')->accessToken;
                //After successfull authentication, notice how I return json parameters
                return response()->json([
                    'success' => true,
                    'token' => $success,
                    'user' => $user

                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Username or Password',
                ], 401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Username or Password',
            ], 401);
        }
    }
  
     public function group_wise_group_member_details(Request $request)
    {
        $statusCode = 200;
        try {
            $user = Auth::user();
            $gp = $user->gp_code;
            // dd($gp);
            $get_group_data = tbl_group::join('tbl_gps', 'tbl_gps.code', 'tbl_groups.gp_code')->join('tbl_blocks', 'tbl_blocks.code', 'tbl_groups.block_code')
                ->where('tbl_groups.gp_code', $gp)->select('tbl_groups.*', 'tbl_groups.shg_code', 'tbl_blocks.block_name', 'tbl_gps.gp_name');
			 if ($request->group_name != '') {
           $get_group_data = $get_group_data->where('tbl_groups.name', 'like', '%' . $request->group_name . '%');
              }
			if ($request->group_code != '') {
           $get_group_data = $get_group_data->where('tbl_groups.shg_code', 'like', '%' . $request->group_code . '%');
              }
			$get_group_data =$get_group_data ->get();
			$total_data=[];
            foreach ($get_group_data as $group) {
                $member = [];
                $grt_group_wise_member = tbl_group_member::where('group_code', $group->code)->select("*")->get();
                foreach ($grt_group_wise_member as $members) {
                    $memberdata["membername"] = $members->member_name;
                    $memberdata['memberage'] = $members->member_age;
                    $memberdata["caste"] = $members->caste;
                    $memberdata["phno"] = $members->ph_no;
                    $memberdata["groupmembercode"] = $members->code;
                    $memberdata["insurance"] = $members->insurance;
					 $memberdata["voter_card"] = $members->voter_card; 
					$memberdata["date_of_birth"] = $members->date_of_birth == NULL ? '' : date("d/m/Y", strtotime(str_replace('-', '/', $members->date_of_birth)));
                    $member[] = $memberdata;
                }
                $data['code'] = $group->code;
                $data['groupcode'] = $group->shg_code;
                $data['groupname'] = $group->name;
                $data['branchname'] = $group->branch_name;
                $data['blockname'] = $group->block_name;
                $data['gpname'] = $group->gp_name;
                $data['formationdate'] = $group->date;
                $data['bankname'] = $group->bank_name;
                $data['accountno'] = $group->account_no;
                $data['ifsccode'] = $group->ifsc_code;
                $data['natureoflivelyhoodactivities'] = $group->nature_of_livelyhood_activities;
				$data['sector'] = $group->sector;
                $data['yearoflasttrainning'] = $group->year_of_last_trainning;
                $data['alreadyappliedloan'] = $group->already_applied_loan;
                $data['repaymentdone'] = $group->repayment_done;
                $data['dateofsubmissionofapplication'] = $group->date_of_submission_of_application;
                if ($group->application_sansantion_date != null) {
                    $data['applicationsansantiondate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->application_sansantion_date)));
                } else {
                    $data['applicationsansantiondate'] = $group->application_sansantion_date;
                }
                if ($group->santion_date != null) {
                    $data['santiondate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->santion_date)));
                } else {
                    $data['santiondate'] = $group->santion_date;
                }
                if ($group->last_trainning_date != null) {
                    $data['lasttrainningdate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->last_trainning_date)));
                } else {
                    $data['lasttrainningdate'] = $group->last_trainning_date;
                }
                $data["villagename"] = $group->village_name;
                $data["loanapplyornot"] = $group->loan_apply_or_not;
                $data["amount"] = $group->amount;
                $data["santionornot"] = $group->santion_or_not;
                $data["santionamount"] = $group->santion_amount;
                $data["type"] = $group->type;
                $data['memberdetails'] = $member;
                $total_data[] = $data;
            }
            $response = array('groupwisemember' => $total_data);
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
	
    public function update_group_member_details(Request $request)
    {
        $statusCode = 200;
        $valid = Validator::make($request->all(), [

            'ph_no' => "required|integer",
          //  'caste' => "required",
            'insurance' => "required",
            'group_member_code' => "required|integer|between:0,9999999999",


        ], []);
        $response = array(
            'error' => $valid->errors()->all(), 'status' => 5
        );
        if ($valid->fails()) {
            $statusCode = 400;
            return response()->json($response, $statusCode);
        }
        try {
            $code = $request->group_member_code;
           // $caste = $request->caste;
            $ph_no = $request->ph_no;
            $insurance = $request->insurance;
			if($request->date_of_birth == '' || $request->date_of_birth == null){
				 $date_of_birth = NULL;
			}else{
			    $date_of_birth = date("Y-m-d", strtotime(str_replace('/', '-', $request->date_of_birth)));
			}
			
			$voter_card = $request->voter_card;

            $update = tbl_group_member::find($code);
           // $update->caste = $caste;
            $update->ph_no = $ph_no;
            $update->insurance = $insurance;
			 $update->date_of_birth = $date_of_birth; 
			$update->voter_card = $voter_card;


            if ($update->save()) {
                $response = array('status' => 1);
            } else {
                $response = array('status' => 2);
            }
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
	  public function update_group_details(Request $request)
    {

        $statusCode = 200;
        // $valid = Validator::make($request->all(), [

        //     // 'loan_apply_or_not' => "required",
        //     // 'amount' => "nullable",
        //     // 'santion_or_not' => "required",
        //     // 'santion_amount' => "nullable",
        //     // 'santion_date' => "nullable|date_format:d/m/Y",
        //     // 'last_trainning_date' => "nullable|date_format:d/m/Y",
        //     // 'type' => "required",
        //     // 'group_code' => "required|integer|between:0,9999999999",


        // ], [

        //     'loan_apply_or_not.required' => 'Please Select Loan Applicable Or Not',
        //     'santion_or_not.required' =>  'Please Select Sanction Or Not',
        //     'last_trainning_date.required' => 'Please Enter Last Trainning Date',
        // ]);
        // $response = array(
        //     'error' => $valid->errors()->all(), 'status' => 5
        // );
        // if ($valid->fails()) {
        //     $statusCode = 400;
        //     return response()->json($response, $statusCode);
        // }
        try {
            $code = $request->group_code;

            $loan_apply_or_not = $request->loan_apply_or_not;
            $amount = $request->amount;
            $nature_of_livelyhood_activities = $request->nature_of_livelyhood_activities;
			$sector = $request->sector;
            $year_of_last_trainning = $request->year_of_last_trainning;
            $already_applied_loan = $request->already_applied_loan;
            $repayment_done = $request->repayment_done;
            // $date_of_submission_of_application = $request->date_of_submission_of_application;
            $application_sansantion_date = date("Y-m-d", strtotime(str_replace('/', '-', $request->application_sansantion_date)));
            $santion_or_not = $request->santion_or_not;
            $santion_amount = $request->santion_amount;
            $santion_date = date("Y-m-d", strtotime(str_replace('/', '-', $request->santion_date)));
            $last_trainning_date = date("Y-m-d", strtotime(str_replace('/', '-', $request->last_trainning_date)));
            $type = $request->type;

            $update = tbl_group::find($code);

            $update->loan_apply_or_not = $loan_apply_or_not;
            $update->amount = $amount;
            $update->nature_of_livelyhood_activities = $nature_of_livelyhood_activities;
			$update->sector = $sector;
            $update->year_of_last_trainning = $year_of_last_trainning;
            $update->already_applied_loan = $already_applied_loan;
            $update->repayment_done = $repayment_done;
            // $update->date_of_submission_of_application = $date_of_submission_of_application;
            $update->application_sansantion_date = $application_sansantion_date;
            $update->santion_or_not = $santion_or_not;
            $update->santion_amount = $santion_amount;
            $update->santion_date = $santion_date;
            $update->last_trainning_date = $last_trainning_date;

            $update->type = $type;
            if ($update->save()) {
                $response = array('status' => 1);
            } else {
                $response = array('status' => 2);
            }
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
	
	public function get_livelihood(Request $request){
		$statusCode = 200;
		try {
		  $activity_data = tbl_livelihood::where('sector',$request->sector)->select('activity as id','activity as name' )
			->get();
		  $response = array(
			'activity_data' => $activity_data, 'status' => 1
		  );
		} catch (\Exception $e) {
		  $response = array(
			'exception' => true,
			'exception_message' => $e->getMessage(),
		  );
		  $statusCode = 400;
		} finally {
		  return response()->json($response, $statusCode);
		}
	
	}
	
	public function single_group_details(Request $request){
		
		  $statusCode = 200;
        try {
            $user = Auth::user();
            $gp = $user->gp_code;
            // dd($gp);
            $get_group_data = tbl_group::join('tbl_gps', 'tbl_gps.code', 'tbl_groups.gp_code')->join('tbl_blocks', 'tbl_blocks.code', 'tbl_groups.block_code')
                ->where('tbl_groups.code', $request->group_code)->select('tbl_groups.*', 'tbl_groups.shg_code', 'tbl_blocks.block_name', 'tbl_gps.gp_name')->get();
			
            foreach ($get_group_data as $group) {
				
                $member = [];
                $grt_group_wise_member = tbl_group_member::where('group_code', $group->code)->select("*")->get();
                foreach ($grt_group_wise_member as $members) {
                    $memberdata["membername"] = $members->member_name;
                    $memberdata['memberage'] = $members->member_age;
                    $memberdata["caste"] = $members->caste;
                    $memberdata["phno"] = $members->ph_no;
                    $memberdata["groupmembercode"] = $members->code;
                    $memberdata["insurance"] = $members->insurance;
					 $memberdata["voter_card"] = $members->voter_card; 
					$memberdata["date_of_birth"] = $members->date_of_birth == NULL ? '' : date("d/m/Y", strtotime(str_replace('-', '/', $members->date_of_birth)));
                    $member[] = $memberdata;
                }
                $data['code'] = $group->code;
                $data['groupcode'] = $group->shg_code;
                $data['groupname'] = $group->name;
                $data['branchname'] = $group->branch_name;
                $data['blockname'] = $group->block_name;
                $data['gpname'] = $group->gp_name;
                $data['formationdate'] = $group->date;
                $data['bankname'] = $group->bank_name;
                $data['accountno'] = $group->account_no;
                $data['ifsccode'] = $group->ifsc_code;
                $data['natureoflivelyhoodactivities'] = $group->nature_of_livelyhood_activities;
				$data['sector'] = $group->sector;
                $data['yearoflasttrainning'] = $group->year_of_last_trainning;
                $data['alreadyappliedloan'] = $group->already_applied_loan;
                $data['repaymentdone'] = $group->repayment_done;
                $data['dateofsubmissionofapplication'] = $group->date_of_submission_of_application;
                if ($group->application_sansantion_date != null) {
                    $data['applicationsansantiondate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->application_sansantion_date)));
                } else {
                    $data['applicationsansantiondate'] = $group->application_sansantion_date;
                }
                if ($group->santion_date != null) {
                    $data['santiondate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->santion_date)));
                } else {
                    $data['santiondate'] = $group->santion_date;
                }
                if ($group->last_trainning_date != null) {
                    $data['lasttrainningdate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->last_trainning_date)));
                } else {
                    $data['lasttrainningdate'] = $group->last_trainning_date;
                }
                $data["villagename"] = $group->village_name;
                $data["loanapplyornot"] = $group->loan_apply_or_not;
                $data["amount"] = $group->amount;
                $data["santionornot"] = $group->santion_or_not;
                $data["santionamount"] = $group->santion_amount;
                $data["type"] = $group->type;
                $data['memberdetails'] = $member;
                $total_data[] = $data;
            }
            $response = array('group_details' => $total_data);
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
	
	}
	
	public function group_wise_loan_details(Request $request){
		
		$statusCode = 200;
        try {
            $user = Auth::user();
            $gp = $user->gp_code;
            // dd($gp);
            $get_group_data = tbl_group::join('tbl_gps', 'tbl_gps.code', 'tbl_groups.gp_code')->join('tbl_blocks', 'tbl_blocks.code', 'tbl_groups.block_code')
                ->where('tbl_groups.code', $request->group_code)->select('tbl_groups.*', 'tbl_groups.shg_code', 'tbl_blocks.block_name', 'tbl_gps.gp_name')->get();
			
            foreach ($get_group_data as $group) {
				
                $loan = [];
                $grt_group_wise_member = tbl_loan_details::where('group_code', $group->code)->select("*")->get();
                foreach ($grt_group_wise_member as $members) {
					$loandata['code'] = $members->code;
                    $loandata["loan_apply_or_not"] = $members->loan_apply_or_not;
                    $loandata['amount'] = $members->amount;
                    $loandata["date_of_submission_of_application"] = $members->date_of_submission_of_application;
                    $loandata["application_sansantion_date"] = $members->application_sansantion_date == NULL ? '' : date("d/m/Y", strtotime(str_replace('-', '/', $members->application_sansantion_date)));
                    $loandata["santion_or_not"] = $members->santion_or_not;
                    $loandata["santion_date"] = $members->santion_date == NULL ? '' : date("d/m/Y", strtotime(str_replace('-', '/', $members->santion_date)));
					$loandata["santion_amount"] = $members->santion_amount;
                    $loan[] = $loandata;
                }
                $data['code'] = $group->code;
                $data['groupcode'] = $group->shg_code;
                $data['groupname'] = $group->name;
                $data['branchname'] = $group->branch_name;
                $data['blockname'] = $group->block_name;
                $data['gpname'] = $group->gp_name;
                $data['formationdate'] = $group->date;
                $data['bankname'] = $group->bank_name;
                $data['accountno'] = $group->account_no;
                $data['ifsccode'] = $group->ifsc_code;
                $data['natureoflivelyhoodactivities'] = $group->nature_of_livelyhood_activities;
				$data['sector'] = $group->sector;
                $data['yearoflasttrainning'] = $group->year_of_last_trainning;
                $data['alreadyappliedloan'] = $group->already_applied_loan;
                $data['repaymentdone'] = $group->repayment_done;
                $data['dateofsubmissionofapplication'] = $group->date_of_submission_of_application;
                if ($group->application_sansantion_date != null) {
                    $data['applicationsansantiondate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->application_sansantion_date)));
                } else {
                    $data['applicationsansantiondate'] = $group->application_sansantion_date;
                }
                if ($group->santion_date != null) {
                    $data['santiondate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->santion_date)));
                } else {
                    $data['santiondate'] = $group->santion_date;
                }
                if ($group->last_trainning_date != null) {
                    $data['lasttrainningdate'] = date("d/m/Y", strtotime(str_replace('-', '/', $group->last_trainning_date)));
                } else {
                    $data['lasttrainningdate'] = $group->last_trainning_date;
                }
                $data["villagename"] = $group->village_name;
                $data["loanapplyornot"] = $group->loan_apply_or_not;
                $data["amount"] = $group->amount;
                $data["santionornot"] = $group->santion_or_not;
                $data["santionamount"] = $group->santion_amount;
                $data["type"] = $group->type;
                $data['loandetails'] = $loan;
                $total_data[] = $data;
            }
            $response = array('group_details' => $total_data);
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
	}
	
	public function loan_details_update(Request $request){
		
		$statusCode = 200;
      //  $valid = Validator::make($request->all(), [

          //  'ph_no' => "required|integer",
          //  'caste' => "required",
         //   'insurance' => "required",
         //   'group_member_code' => "required|integer|between:0,9999999999",


      //  ], []);
      //  $response = array(
      //      'error' => $valid->errors()->all(), 'status' => 5
     //  );
      //  if ($valid->fails()) {
       //     $statusCode = 400;
       //     return response()->json($response, $statusCode);
      //  }
        try {
            $code = $request->loan_code;
           // $caste = $request->caste;
            $santion_amount = $request->santion_amount;
			$group_code = $request->group_code;
			if($request->santion_date == '' || $request->santion_date == null){
				$santion_date = null;
			}else{
			    $santion_date = date("Y-m-d", strtotime(str_replace('/', '-', $request->santion_date)));
			}
            
			$santion_or_not = $request->santion_or_not;
			if($request->application_sansantion_date == '' || $request->application_sansantion_date == null){
				$application_sansantion_date = null;
			}else{
			    $application_sansantion_date = date("Y-m-d", strtotime(str_replace('/', '-', $request->application_sansantion_date)));
			}
			
			$amount = $request->amount;
			$loan_apply_or_not = $request->loan_apply_or_not;
			
             if ($code) {
                $update = tbl_loan_details::find($code);
             } else {
                $update = new tbl_loan_details();
             }
			
           // $update = tbl_loan_details::find($code);
           // $update->caste = $caste;
            $update->loan_apply_or_not = $loan_apply_or_not;
            $update->amount = $amount;
			$update->group_code = $group_code;
			$update->application_sansantion_date = $application_sansantion_date;
			$update->santion_or_not = $santion_or_not;
			$update->santion_date = $santion_date;
			$update->santion_amount = $santion_amount;


            if ($update->save()) {
				if ($code) {
                    $response = array('status' => 2);
                } else {
                    $response = array('status' => 1);
                }
               // $response = array('status' => 1);
            } else {
                $response = array('status' => 3);
            }
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
	}
	public function versionCheck(Request $request){
		
		$version = tbl_version_check::select('version')->first();
		return $version->version;
		
	}
	
	public function mandetoryupdate(Request $request){
		
		$version = tbl_version_check::select('mandetory_update')->first();
		return $version->mandetory_update;
		
	}
}
