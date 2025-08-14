<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_livelihood extends Model
{
    use HasFactory;
    protected $table = 'tbl_livelihood';
    protected $primaryKey = 'code';
}
