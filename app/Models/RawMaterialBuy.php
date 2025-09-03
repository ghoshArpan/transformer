<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialBuy extends Model
{
    use HasFactory;
    protected $table = 'raw_material_buy';
    protected $primaryKey = 'code';

    public function quotation_table()
    {
        return $this->hasMany(Quotation::class, 'buy_code', 'code');
    }

    public static function rawmaterial_buy_list()
    {

        return RawMaterialBuy::orderby('code', 'desc')->paginate(10);
    }

    public static function fetch_data()
    {
        $buycode = request()->buy_code ?  decrypt(request()->buy_code) : 0;

        return RawMaterialBuy::where('code', $buycode)->first();
    }

    public static function create_update_buy()
    {

        $buycode = request()->buy_code ?  request()->buy_code : 0;
        if ($buycode > 0):
            $message = "Buy Updated Successfully";
            $buy = RawMaterialBuy::find($buycode);
        else:
            $message = "Buy added Successfully";
            $buy = new RawMaterialBuy();
        endif;

        $buy->buy_name = request()->buy_name;
        $buy->buy_date = date('Y-m-d');
        $buy->save();


        return redirect()->route('rawmaterialBuyList')->with('success', $message);
    }

    public static function quotation_wise_rawmaterial_data()
    {

        $buycode = request()->buy_code ?  decrypt(request()->buy_code) : 0;
        $data = RawMaterialBuy::with([
            'quotation_table.quotation_wise_rawmaterial_table.make_table:code,make_name',
            'quotation_table.quotation_wise_rawmaterial_table.category_table:code,category',
            'quotation_table.quotation_wise_rawmaterial_table.subcategory_table:code,sub_category',
            'quotation_table.quotation_wise_rawmaterial_table.rawmaterial_table:code,name'
        ])->where('code', $buycode)->first()->toArray();
        return $data;
    }
}
