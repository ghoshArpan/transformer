<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformerMiscleniousCost extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "transformer_misclenious_amount";
    protected $primaryKey = "code";


    public static function fetch_data(){

        $trans_code = request()->transformer_code ? decrypt(request()->transformer_code) : 0;
        
        return TransformerMiscleniousCost::where('transformar_code',$trans_code)->get();
    }

 
    public static function add_misclenious_cost(){

        $selectedIds=request()->selectedIds;
        $amt=request()->amount/count($selectedIds);

        foreach($selectedIds as $k=>$v):

            $value=new TransformerMiscleniousCost();
            $value->transformar_code=$v;
            $value->amount=$amt;
            $value->purpose=request()->remarks;
            $value->save();

        endforeach;
        
       $response=[
        'status'=>200,
        'message'=>'Misclenious Cost Added Successfully'
       ];

       return $response;

    }
    
	
	
}
