<?php

// app/Models/Vacation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_date','days', 'end_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDaysAttribute()
    {
        return \Carbon\Carbon::parse($this->end_date)
            ->diffInDays(\Carbon\Carbon::parse($this->start_date)) + 1;
    }
}
