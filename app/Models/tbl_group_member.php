<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_group_member extends Model
{
    use HasFactory;
    /////////new/////////////
    protected $table="tbl_group_members";
    protected $primaryKey="code";
}
