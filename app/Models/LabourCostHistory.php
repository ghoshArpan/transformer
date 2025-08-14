<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourCostHistory extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "labour_cost_history";
    protected $primaryKey = "code";

    public static function fetch_data(){
        $trans_code = request()->transformer_code ? decrypt(request()->transformer_code) : 0;
        return LabourCostHistory::where('transformar_code',$trans_code)->get();

    }
	
	
}
