<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WorkHistory extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'workHistory';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
