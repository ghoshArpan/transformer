<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "stock_master";
    protected $primaryKey = "code";
	
	 public function raw_meterial()
    {
        return $this->belongsTo(RawMeterials::class, 'raw_meterial_id', 'code');
    }
	  public static function fetch_data()
    {
        $rawCode = request()->stock_code ? decrypt(request()->stock_code) : 0;

        return Stocks::where('code', $rawCode)->first();
    }

    public static function fetch_raw_meterials(){
        $meterials=Stocks::where('quantity','>',0)->pluck('raw_meterial_id')->toArray();
        return RawMeterials::whereIn('code',$meterials)->select('code','name')->get();
    }

    

    public static function fetch_raw_meterial_wise_amt_stock_wise(){


		$raw_meterial=request()->raw_meterial;
		
		$datas= Stocks::where('raw_meterial_id',$raw_meterial)->first();

		$response=[
			'amount'=>$datas->amount_per_unit,
			'unit'=>$datas->raw_meterial_unit,
			'total_stock'=>$datas->quantity
		];
	
		return $response;
		
	}
    public static function fetch_raw_meterial_wise_amt_stock_wise_two(){
		$raw_meterial=request()->raw_meterial;

    $datas = Stocks::where('raw_meterial_id', $raw_meterial)->get();
    $tStock = RawMeterials::where('code', $raw_meterial)->first();

$response = [
    'amount' => $datas->max('amount_per_unit'), // Get the highest amount per unit
    'unit' => optional($datas->first())->raw_meterial_unit, // Get the unit from the first entry
    'total_stock' => $tStock->total_stock // Sum up total quantity
];
return response()->json($response);

    }


	 public static function create_update_stock()
    {

        $stock_code = request()->stock_code ? request()->stock_code : 0;
        if ($stock_code > 0):
            $message = "Stock Updated Successfully";
            $labour = Stocks::find($stock_code);
        else:
            $message = "Stock added Successfully";
            $labour = new Stocks();
        endif;

        $labour->category_id = request()->category_id;
        $labour->sub_category_id = request()->sub_category_id;
        $labour->raw_meterial_id = request()->raw_meterial;
        $labour->quantity = request()->quantity;
        $labour->stock_quantity = request()->stock_quantity ? request()->stock_quantity :request()->quantity ;
        $labour->amount_per_unit = request()->amount;
        $labour->raw_meterial_unit = request()->raw_meterial_unit;
        $labour->total_amount = request()->total_amount;
        $labour->stock_date = date('Y-m-d');
        $labour->save();
		 
		 $totQ=Stocks::where('raw_meterial_id', request()->raw_meterial)->where('type', '1')->sum('quantity');
         $toStQ=Stocks::where('raw_meterial_id', request()->raw_meterial)->where('type', '0')->sum('quantity');
         $TQ=(int)$totQ-(int)$toStQ;
		 $update=RawMeterials::find(request()->raw_meterial);
		 $update->total_stock=$TQ;
		 $update->save();


        return redirect()->route('stockList')->with('success', $message);
    }
	
	
	public static function stock_list(){
        
			return Stocks::where('type','1')->paginate(10);
	}


    public static function view_stock_history(){
        $rawCode = request()->stock_id ? decrypt(request()->stock_id) : 0;

       return  Stocks::where('raw_meterial_id',$rawCode)->orderBy('code','desc')->paginate(10);

    }
	
}