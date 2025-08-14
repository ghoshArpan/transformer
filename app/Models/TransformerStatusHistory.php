<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformerStatusHistory extends Model
{
    use HasFactory;

    ////////////new////////
    protected $table = "transformar_status_history";
    protected $primaryKey = "code";

    public function transformer()
    {
        return $this->belongsTo(Transformer::class, 'transformar_code', 'code');
    }
    public static function transformar_history_save($code, $status)
    {
        $fetchStatusName = JobStatus::where('code', $status)->first();
        $datas = new TransformerStatusHistory();
        $datas->transformar_code = $code;
        $datas->status = $fetchStatusName->status;
        $datas->color_code = $fetchStatusName->color_code;
        $datas->date = date('Y-m-d');
        $datas->save();
        return true;
    }
}
