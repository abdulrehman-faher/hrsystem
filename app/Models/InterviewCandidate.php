<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class InterviewCandidate extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'interviewCandidate';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;

    // protected $with = ['application'];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
