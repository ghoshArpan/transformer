<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformerRawMeterials extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "transformer_raw_meterials";
    protected $primaryKey = "code";


    // rawMeterials

    public function rawMeterials()
    {
        return $this->belongsTo(RawMeterials::class, 'raw_meterials_code', 'code');
    }

    public static function fetch_data(){
        $trans_code = request()->transformer_code ? decrypt(request()->transformer_code) : 0;
            return TransformerRawMeterials::where('transformar_code', $trans_code)->orderBy('code','desc')->get();
        

    }

    public static function add_raw_meterials()
{
    $raw_meterial_id = RawMeterials::where('code', request()->raw_meterial_value)->first();
    $findUnit = Units::where('code', $raw_meterial_id->unit_id)->first()->unit;

    if (!$raw_meterial_id) {
        return response()->json(['error' => 'Raw material not found'], 400);
    }

    $Q = (int) request()->quantity; // Requested quantity to use

    // Fetch total received stock (`type = 1`)
    $totalReceived = Stocks::where('raw_meterial_id', request()->raw_meterial_value)
        ->where('type', "1")
        ->sum('quantity');

    // Fetch total used stock (`type = 0`)
    $totalUsed = Stocks::where('raw_meterial_id', request()->raw_meterial_value)
        ->where('type', "0")
        ->sum('quantity');

    // Calculate available stock
    $availableStock = $totalReceived - $totalUsed;

    // Validate if enough stock is available
    if ($Q > $availableStock) {
        return response()->json(['error' => 'Not enough stock available. Available stock: ' . $availableStock], 400);
    }

    // New stock value after using requested quantity
    $newStock = $availableStock - $Q;
    $totalAmount = $raw_meterial_id->amount_per_unit * $Q;

    // Update total stock in RawMeterials table
    RawMeterials::where('code', request()->raw_meterial_value)->update([
        'total_stock' => $newStock
    ]);

    // Insert new stock record
    Stocks::insert([
        'quantity' => $Q,
        'amount_per_unit' => $raw_meterial_id->amount_per_unit,
        'type' => '0', // Used stock
        'raw_meterial_id' => request()->raw_meterial_value,
        'sub_category_id' => $raw_meterial_id->sub_category_id,
        'category_id' => $raw_meterial_id->category_id,
        'total_amount' => $totalAmount,
        'raw_meterial_unit' => $findUnit,
        'stock_date' => now()
    ]);

    // Insert into TransformerRawMeterials table
    $raw = new TransformerRawMeterials();
    $raw->transformar_code = request()->transformar_ids;
    $raw->raw_meterials_code = request()->raw_meterial_value;
    $raw->quantity = $Q;
    $raw->available_quantity = $newStock;
    $raw->cost = request()->total_price;
    $raw->per_cost = request()->price;
    $raw->unit = $findUnit;
    $raw->save();

    $messege="Transformer Meterial Add Successfully";

    return redirect()->back()->with('success', $messege);
}

}
