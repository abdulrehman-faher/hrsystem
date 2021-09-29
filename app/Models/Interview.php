<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Interview extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'interview';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;

    // protected $with = ['candidates'];

    public function candidates()
    {
        return $this->hasMany(InterviewCandidate::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }
}
