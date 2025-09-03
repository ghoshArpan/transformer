<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;
    protected $table = "dealar";
    protected $primaryKey = "code";

    public static function fetch_data()
    {
        $data = Dealer::select('code', 'name')->get();
        return $data;
    }
}
