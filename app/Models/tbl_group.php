<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_group extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table="tbl_groups";
    protected $primaryKey="code";
}
