<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'schedule_id',
        'title',
        'description',
        'priority',
        'status',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
