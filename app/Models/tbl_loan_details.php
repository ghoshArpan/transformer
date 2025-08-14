<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_loan_details extends Model
{
    use HasFactory;
    protected $table="tbl_loan_details";
    protected $primaryKey="code";
}
