<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTransformer extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "sub_transformer";
    protected $primaryKey = "code";


    public static function save_sub_transformer()
    {
        // $transformerCode = request()->transformer_code ? request()->transformer_code : 0;
        $message = "Transformer added Successfully";
        $trans = new SubTransformer();
        $trans->transformer_code = request()->transformer_code;
        $trans->kva = request()->kva;
        $trans->make = request()->make;
        $trans->repair = request()->repair;
        $trans->oil = request()->oil;
        $trans->wsl = request()->serial_no;
        $trans->dtr_no = request()->dtr_no;
        $trans->mfg = request()->mfg;
        $trans->dot = request()->dot;
        $trans->ssl_no = request()->ssl;
        $trans->received_date = request()->received;
        $trans->delivered_date = request()->delivered;
        $trans->serial_no = request()->serial_no_no;
        $trans->save();

        return redirect()->route('transformer_List')->with('success', $message);
    }

    public static function fetch_tag_wise_trasnformer($code)
    {
        return SubTransformer::orderBy('code', 'desc')->where('transformer_code', $code)->get();
    }

    public static function createUniqueNo()
    {

        $tagId = Transformer::where('code', request()->code)->first()->unique_code;
        $value = SubTransformer::where('transformer_code', request()->code)->max('code') ?? 0;
        $uniqueId = $value + 1;
        // Add leading zero if the value is less than 10
        if ($uniqueId < 10) {
            $uniqueId = '0' . $uniqueId;
        }
        return $tagId . '-' . $uniqueId;
    }
}
