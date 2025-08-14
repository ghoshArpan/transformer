<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransformerCreateRequest;
use App\Http\Requests\UpdateStatusRequest;

use App\Models\Transformer;
use App\Models\SubTransformer;
use App\Models\JobStatus;
use App\Models\Stocks;
use App\Models\FinancialYear;
use App\Models\TransformerRawMeterials;
use App\Models\LabourCostHistory;
use App\Models\TransformerLogisticCost;
use App\Models\TransformerMiscleniousCost;

use Illuminate\Support\Facades\DB;

class TransformerController extends Controller
{

	public function update_tag_other_data()
	{
		return Transformer::update_tag_other_data();
	}
	public  function save_transformer_data()
	{
		return SubTransformer::save_sub_transformer();
	}
	public function create_unique_no()
	{
		$datas = SubTransformer::createUniqueNo();
		$response = [
			'serialNo' => $datas
		];
		return $response;
	}

	public function add_logistic_cost()
	{

		$data = TransformerLogisticCost::add_logistic_cost();

		return $data;
	}
	public function add_miscenious_cost()
	{

		$data = TransformerMiscleniousCost::add_misclenious_cost();

		return $data;
	}
	public function add_edit_transformer(TransformerCreateRequest $request)
	{

		return Transformer::create_update_transformer();
	}

	public function update_status_save(UpdateStatusRequest $request)
	{


		return Transformer::update_status_save();
	}

	public function show_status()
	{

		$datas = JobStatus::show_status();
		$html = view('job_status_option', compact('datas'));
		// dd($html);

		return $html;
	}

	public function transformer()
	{

		$data = Transformer::fetch_data();
		$financial = FinancialYear::fetch_financial_year();
		$uniqueNo = Transformer::create_unique_no();
		return view('add_edit_transformer', compact('data', 'financial', 'uniqueNo'));
	}

	public function transformer_List()
	{
		$status = JobStatus::get();
		$datas = Transformer::transformer_List();

		return view('transformer_List', compact('datas', 'status'));
	}

	public function transformer_cost_List()
	{
		$datas = Transformer::transformer_cost_List();

		return view('transformer_cost_List', compact('datas'));
	}
	public function logistic_cost_List()
	{
		$datas = Transformer::transformer_cost_List();

		return view('transformer_logistic_List', compact('datas'));
	}
	public function miscenious_cost_List()
	{
		$datas = Transformer::transformer_cost_List();

		return view('transformer_misnenious_List', compact('datas'));
	}



	public function transformer_view()
	{
		$trans_code = request()->transformer_code ? decrypt(request()->transformer_code) : 0;
		$data = TransformerRawMeterials::fetch_data();
		$tagDetails = Transformer::fetch_transformer_data();
		$logisticCost = TransformerLogisticCost::fetch_data();
		$labourCostHistory = LabourCostHistory::fetch_data();
		$miscCost = TransformerMiscleniousCost::fetch_data();
		$raw_meterials = Stocks::fetch_raw_meterials();
		$transformerSub = SubTransformer::fetch_tag_wise_trasnformer($trans_code);
		// dd($transformerSub);
		return view('transformer_view_details', compact('transformerSub', 'data', 'raw_meterials', 'miscCost', 'tagDetails', 'trans_code', 'labourCostHistory', 'logisticCost'));
	}
	public function add_transformer_raw_meterial()
	{
		return TransformerRawMeterials::add_raw_meterials();
	}

	public function add_labour_cost()
	{
		$data = Transformer::add_labour_cost();
		return $data;
	}

	public function status_history_view()
	{

		$datas = Transformer::view_status_history();
		return view('transformer_status_view', compact('datas'));
	}
}
