<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $table = "raw_material_quotation";
    protected $primaryKey = "code";

    public function buy_table()
    {
        return $this->belongsTo(RawMaterialBuy::class, 'buy_code', 'code');
    }
    public function quotation_wise_rawmaterial_table()
    {
        return $this->hasMany(QuotationWiseRawmaterial::class, 'quotation_code', 'code');
    }
}
