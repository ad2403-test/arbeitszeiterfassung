<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breaks extends Model
{
    use HasFactory;

    protected $fillable = ['work_log_id', 'start_time', 'end_time', 'note'];

    public function workLog()
    {
        return $this->belongsTo(WorkLog::class);
    }
}
