<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [ApiController::class, 'login']);
Route::post('/user_entry', [ApiController::class, 'user_entry']);
Route::post('/user_edit', [ApiController::class, 'user_edit']);
Route::post('/user_delete', [ApiController::class, 'user_delete']);
Route::post('/user_list', [ApiController::class, 'user_list']);
Route::post('/get_block', [ApiController::class, 'get_block']);
Route::post('/get_gp', [ApiController::class, 'get_gp']);
Route::post('/userList', [ApiController::class, 'userList']);
Route::post('/versionCheck', [ApiController::class, 'versionCheck']);
Route::post('/mandetoryupdate', [ApiController::class, 'mandetoryupdate']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' =>'auth:api'], function () {
    Route::post('/group_wise_group_member_details', [ApiController::class, 'group_wise_group_member_details']);
    
    Route::post('/update_group_details', [ApiController::class, 'update_group_details']);
    Route::post('/update_group_member_details', [ApiController::class, 'update_group_member_details']);
    Route::post('/get_livelihood', [ApiController::class, 'get_livelihood']);
    Route::post('/single_group_details', [ApiController::class, 'single_group_details']);
    Route::post('/group_wise_loan_details', [ApiController::class, 'group_wise_loan_details']);
    Route::post('/loan_details_update', [ApiController::class, 'loan_details_update']);
});
