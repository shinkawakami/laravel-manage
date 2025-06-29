<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'schedule_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status_code',
    ];

    const STATUS_UNSTARTED = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_ON_HOLD = 3;
    const STATUS_DONE = 4;

    const STATUS_LABELS = [
        1 => '未着手',
        2 => '作業中',
        3 => '待機',
        4 => '完了',
    ];

    // アクセサ（Accessor）機能　Eloquentの「動的プロパティ」get{StudlyName}Attribute で定義
    public function getStatusLabelAttribute()
    {
        return self::STATUS_LABELS[$this->status_code] ?? '';
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
