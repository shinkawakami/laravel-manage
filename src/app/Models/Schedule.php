<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // 代入可能（変更可能）
    protected $fillable = [
        'user_id', 'title', 'description', 'start_time', 'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        // 明示的：return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}