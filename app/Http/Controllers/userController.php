<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tbl_block;
use App\Models\tbl_gp;

class userController extends Controller
{
    public function get_block_data(Request $request)
    {
        $block = tbl_block::pluck('block_name', 'code');
        // dd($block);
        if ($block) {
            $response = [
                'block_data' => $block,
            ];
            return $response;
        }
    }

    public function get_gps_data(Request $request)
    {
        $grampanchayat = $request->grampanchayat;

        $gps = tbl_gp::where('block_code', $grampanchayat)->pluck('gp_name', 'code');

        // dd($gps);
        if ($gps) {
            $response = [
                'gps' => $gps,
            ];
            return $response;
        }
    }

    public function user()
    {
        return view('add_user');
    }

    public function save_user_data(Request $request)
    {

        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occured in form submit.'];
            return response()->json($response, $statusCode);
        }

        //dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:3|max:50|regex:/^[A-Za-z ]+$/i',
                'username' => 'required|unique:users,username|min:6|max:50|regex:/^[@A-Za-z0-9.\-s]+$/i',
                'mobile_no' => 'required|min:10|max:10|regex:/^[0-9]+$/i',
                'password' => 'required|min:8|max:20|regex:/^[@A-Za-z0-9.\-s]+$/i',
                'cpassword' => 'required_with:password|same:password|min:8',
               
            ],
            [
                'name.required' => 'Name field is required',
                'name.min' => 'Name field is required minium 2 character',
                'name.max' => 'Name field is required maxium 50 character',
                'name.regex' => 'Only alphabet  and Space allowed here',

                'username.required' => 'Username is required',
                'username.min' => 'Username is required minium 6 character',
                'username.max' => 'Username is required maxium 50 character',
                'username.unique' => 'Username already exist',
                'username.regex' => 'Username can only consist of alphabetical, number @  and dot allow here',

                'mobile_no.required' => 'Mobile no. is required',
                'mobile_no.min' => 'Mobile field is required minium  10 digit',
                'mobile_no.min' => 'Mobile field is required  maxium 10 digit',
                'mobile_no.regex' => 'Mobile no. can only consist of numeric value allow here',

                'password.required' => 'Password is required',
                'password.min' => 'Password is required minium 8 character log',
                'password.max' => 'Password is required maxium 20 character log',
                'password.regex' => 'Password can only consist of alphabetical, number @  and dot allow here',

                'cpassword.required_with' => 'Confirm password is required',
                'cpassword.min' => 'Confirm password is required minium 8 character',
                'cpassword.same' => 'Password  and confirm password must be same',


            ],
        );
        //  dd($request->all());

        try {
            $user = new User();
           
            $user->name = $request->name;
            $user->username = $request->username;
            $user->mobile_no = $request->mobile_no;
            $user->password = $request->password;
            $user->cpassword = md5($request->cpassword);

            if ($user->save()) {
                $response = ['status' => 1];
            }
        } catch (\Exception $e) {
            $response = [
                'exception' => true,
                'exception_message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
        // return $response;

    }

    public function user_detail_list()
    {
        return view('user_list');
    }

    public function show_user_detail_list(Request $request)
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

            $user_detail = User::join('tbl_blocks', 'tbl_blocks.code', 'users.block_code')
                ->join('tbl_gps', 'tbl_gps.code', 'users.gp_code')
                ->select('users.code', 'users.name', 'users.username', 'users.mobile_no', 'tbl_blocks.block_name', 'tbl_gps.gp_name')
                ->orderby('users.code', 'desc')
                ->where(function ($q) use ($search) {
                    $q->orwhere('users.name', 'like', '%' . $search . '%');
                    $q->orwhere('users.mobile_no', 'like', '%' . $search . '%');
                });

            //dd($user_detail);

            $filtered_count = $user_detail->count();
            $record = $user_detail;
            $page_displayed = $record
                ->offset($offset)
                ->limit($length)
                ->get();
            $count = $offset + 1;

            foreach ($page_displayed as $user) {
                $userdata['id'] = $count;
                $userdata['name'] = $user->name;
                $userdata['username'] = $user->username;
                $userdata['mobile_no'] = $user->mobile_no;
                $userdata['block_name'] = $user->block_name;
                $userdata['gp_name'] = $user->gp_name;
                $userdata['action'] = "<button class='btn btn-success edit_btn'  id='" . $user->code . "'><i class='fa fa-edit'></i></button>";
                $count++;
                $data[] = $userdata;
            }
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
        //     dd($response);
        // return response()->json($response);
    }

    public function edit_user_detail(Request $request)
    {
        // dd($request->all());

        $this->validate(
            $request,
            ['code' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );

        $code = $request->code;
        $edit_data = User::where('code', $code)
            ->select('*')
            ->first();
        // dd($edit_data);

        $send_data = [
            'id' => $edit_data->code,
            'name' => $edit_data->name,
            // 'username' => $edit_data->username,
            'mobile_no' => $edit_data->mobile_no,
        ];
        // dd($send_data);
        return view('add_user')->with('send_data', $send_data);
    }

    public function update_user_detail(Request $request)
    {

        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occured in form submit.'];
            return response()->json($response, $statusCode);
        }
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:3|max:50|regex:/^[A-Za-z ]+$/i',
                'mobile_no' => 'required|min:10|max:10|regex:/^[0-9]+$/i',

            ],
            [
                'name.required' => 'Name field is required',
                'name.min' => 'Name field is required minium 2 character',
                'name.max' => 'Name field is required maxium 50 character',
                'name.regex' => 'Only alphabet  and Space allowed here',

                'mobile_no.required' => 'Mobile no. is required',
                'mobile_no.min' => 'Mobile field is required minium  10 digit',
                'mobile_no.min' => 'Mobile field is required  maxium 10 digit',
                'mobile_no.regex' => 'Mobile no. can only consist of numeric value',


            ],
        );

        try {
            $code = $request->edit_user_code;
            $name = $request->name;
            $mobile_no = $request->mobile_no;

            $update = User::where('code', $code)->update(['name' => $name, 'mobile_no' => $mobile_no]);

            if ($update) {
                $response = [
                    'status' => 2,
                ];
                // return $response;
            }
        } catch (\Exception $e) {
            $response = [
                'exception' => true,
                'exception_message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
}
