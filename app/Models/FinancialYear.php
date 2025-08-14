<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "financial_year";
    protected $primaryKey = "code";

  

    public static function fetch_financial_year()
    {

        $financial_year = FinancialYear::orderBy('code','desc')->get();
        return $financial_year;
    }
	
	
}
