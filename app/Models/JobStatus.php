<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table="job_status";
    protected $primaryKey="code";

    public static function show_status(){
        $ids = request()->selectedIds;
    
        $status = Transformer::whereIn('code', $ids)->pluck('job_status')->toArray();
        // dd($status);
        $datas=[];
        if (!empty($status)) {
            $maxStatus = max($status);
           $datas=JobStatus::where('code', '>', $maxStatus)->get();
        }
        // dd($datas);//

        return $datas;
    }
    

		
}
