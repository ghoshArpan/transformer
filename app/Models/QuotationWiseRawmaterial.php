<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationWiseRawmaterial extends Model
{
    use HasFactory;
    protected $table = "quotation_wise_raw_material";
    protected $primaryKey = "code";

    public function quotation_raw_table()
    {
        return $this->belongsTo(Quotation::class, 'quotation_code', 'code');
    }

    public function make_table()
    {
        return $this->belongsTo(Make::class, 'make_code', 'code');
    }
    public function category_table()
    {
        return $this->belongsTo(RawMeterialCategory::class, 'category_code', 'code');
    }
    public function subcategory_table()
    {
        return $this->belongsTo(RawMeterialSubCategory::class, 'sub_category_code', 'code');
    }
    public function rawmaterial_table()
    {
        return $this->belongsTo(RawMeterials::class, 'raw_material_code', 'code');
    }
}
