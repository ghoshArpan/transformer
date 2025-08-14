<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_block extends Model
{
    use HasFactory;
/////////new/////////////
    protected $table = 'tbl_blocks';
    protected $primaryKey = 'code';
}
