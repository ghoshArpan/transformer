<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\groupController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\RawMeterialController;
use App\Http\Controllers\LabourController;
use App\Http\Controllers\TransformerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// /php artisan migrate:refresh --path="database\migrations\Your_Migration_File_Name_table.php"

////////////////////////////////userController///////////////////////////////////////////
//Route::get('user',[userController::class,'user'])->name('user_list');
//Route::get('user_detail_list',[userController::class,'user_detail_list'])->name('user');
Route::post('show_user_detail_list', [userController::class, 'show_user_detail_list']);
Route::post('edit_user_detail', [userController::class, 'edit_user_detail']);
Route::post('update_user_detail', [userController::class, 'update_user_detail']);
Route::post('get_block_data', [userController::class, 'get_block_data']);
Route::post('get_gps_data', [userController::class, 'get_gps_data']);
Route::post('save_user_data', [userController::class, 'save_user_data']);


////////////////////////////////groupController///////////////////////////////////////////
Route::get('group_list', [groupController::class, 'group_list'])->name('group_list');
Route::post('show_group_list', [groupController::class, 'show_group_list']);
Route::post('model_view_group_data', [groupController::class, 'model_view_group_data']);
Route::post('loan_view_group_data', [groupController::class, 'loan_view_group_data']);
Route::post('group_member_data', [groupController::class, 'group_member_data']);

Route::get('master', function () {

	return view('master.master');
});





Route::get('/', function () {
	return view('welcome');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	///////////////////////////////////////////////////////////////////////////////////////////
	Route::get('user', [userController::class, 'user'])->name('user_list');
	Route::get('unit/{unit_code?}', [UnitController::class, 'unit'])->name('unit');
	Route::post('create-unit', [UnitController::class, 'addUnit'])->name('addUnit');
	Route::get('unit-list', [UnitController::class, 'unitList'])->name('unitList');

	Route::get('category/{category_code?}', [RawMeterialController::class, 'category'])->name('category');
	Route::post('create-category', [RawMeterialController::class, 'addcategory'])->name('addcategory');
	Route::get('category-list', [RawMeterialController::class, 'categoryList'])->name('categoryList');


	Route::get('subcategory/{subcategory_code?}', [RawMeterialController::class, 'subcategory'])->name('subcategory');
	Route::post('create-subcategory', [RawMeterialController::class, 'addsubcategory'])->name('addsubcategory');
	Route::get('subcategory-list', [RawMeterialController::class, 'subcategoryList'])->name('subcategoryList');
	Route::get('labour/{labour_code?}', [LabourController::class, 'labour'])->name('labour');
	Route::post('create-labour', [LabourController::class, 'addLabour'])->name('addLabour');
	Route::get('Labour-list', [LabourController::class, 'LabourList'])->name('LabourList');
	Route::get('attendance-sheet', [LabourController::class, 'attendance_sheet'])->name('attendance_sheet');
	Route::get('attendance-page', [LabourController::class, 'attendance_page'])->name('attendance_page');
	Route::any('attendance_page_save', [LabourController::class, 'attendance_page_save'])->name('attendance_page_save');
	Route::get('attendance-list', [LabourController::class, 'attendance_list'])->name('attendance_list');
	Route::post('attendance_submit', [LabourController::class, 'attendance_submit'])->name('attendance_submit');
	Route::get('view_attendance/{attendance_code}', [LabourController::class, 'view_attendance'])->name('view_attendance');
	Route::post('labour_status_update', [LabourController::class, 'labour_status_update'])->name('labour_status_update');


	Route::post('add_edit_raw_meterial', [RawMeterialController::class, 'add_edit_raw_meterial'])->name('add_edit_raw_meterial');
	Route::get('raw-meterial/{raw_code?}', [RawMeterialController::class, 'raw_meterial'])->name('raw_meterial');

	Route::get('rawMeterial-list', [RawMeterialController::class, 'rawMeterial_List'])->name('rawMeterial_List');
	Route::post('get_subcategory', [RawMeterialController::class, 'get_subcategory'])->name('get_subcategory');
	Route::post('get_raw_meterial', [RawMeterialController::class, 'get_raw_meterial'])->name('get_raw_meterial');
	Route::post('add_edit_stock', [RawMeterialController::class, 'add_edit_stock'])->name('add_edit_stock');
	Route::get('stock-list', [RawMeterialController::class, 'stockList'])->name('stockList');
	Route::get('view_stock/{stock_id}', [RawMeterialController::class, 'view_stock'])->name('view_stock');

	Route::get('stock/{stock_code?}', [RawMeterialController::class, 'stock'])->name('stock');
	Route::post('fetch_raw_meterial_wise_amt', [RawMeterialController::class, 'fetch_raw_meterial_wise_amt'])->name('fetch_raw_meterial_wise_amt');
	Route::post('fetch_raw_meterial_wise_amt_stock_wise', [RawMeterialController::class, 'fetch_raw_meterial_wise_amt_stock_wise'])->name('fetch_raw_meterial_wise_amt_stock_wise');
	Route::post('add_transformer_raw_meterial', [TransformerController::class, 'add_transformer_raw_meterial'])->name('add_transformer_raw_meterial');
	Route::get('status_history_view/{transformer_code}', [TransformerController::class, 'status_history_view'])->name('status_history_view');


	Route::post('add_edit_transformer', [TransformerController::class, 'add_edit_transformer'])->name('add_edit_transformer');

	Route::post('update_status_save', [TransformerController::class, 'update_status_save'])->name('update_status_save');
	Route::post('add_labour_cost', [TransformerController::class, 'add_labour_cost'])->name('add_labour_cost');

	Route::post('show_status', [TransformerController::class, 'show_status'])->name('show_status');
	Route::get('transformer/{transformer_code?}', [TransformerController::class, 'transformer'])->name('transformer');
	Route::get('transformer_view/{transformer_code}', [TransformerController::class, 'transformer_view'])->name('transformer_view');

	Route::get('transformer-list', [TransformerController::class, 'transformer_List'])->name('transformer_List');

	Route::post('update_tag_other_data', [TransformerController::class, 'update_tag_other_data'])->name('update_tag_other_data');

	Route::get('digital-cost-list', [TransformerController::class, 'transformer_cost_List'])->name('transformer_cost_List');
	Route::get('logistic-cost-list', [TransformerController::class, 'logistic_cost_List'])->name('logistic_cost_List');
	Route::get('miscenious-cost-list', [TransformerController::class, 'miscenious_cost_List'])->name('miscenious_cost_List');
	Route::post('add_logistic_cost', [TransformerController::class, 'add_logistic_cost'])->name('add_logistic_cost');

	Route::post('add_miscenious_cost', [TransformerController::class, 'add_miscenious_cost'])->name('add_miscenious_cost');

	Route::post('create_unique_no', [TransformerController::class, 'create_unique_no'])->name('create_unique_no');
	Route::post('save_transformer_data', [TransformerController::class, 'save_transformer_data'])->name('save_transformer_data');


	Route::get('user_detail_list', [userController::class, 'user_detail_list'])->name('user');


	//---------------------------- Raw Material Buy ----------------------------//
	Route::get('rawmaterialBuyList', [RawMeterialController::class, 'rawmaterialBuyList'])->name('rawmaterialBuyList');
	Route::post('add_edit_buy', [RawMeterialController::class, 'add_edit_buy'])->name('add_edit_buy');
	Route::get('buy/{buy_code?}', [RawMeterialController::class, 'buy'])->name('buy');
	Route::post('create-buy', [RawMeterialController::class, 'addbuy'])->name('addbuy');
	Route::get('quotation/{buy_code?}', [RawMeterialController::class, 'quotation'])->name('quotation');
});

require __DIR__ . '/auth.php';
