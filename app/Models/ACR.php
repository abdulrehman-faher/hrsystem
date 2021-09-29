<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ACR extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'acrs';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;

    protected $guarded = [];
    protected $table = "acrs";

    // protected $with = ['images'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function authenticatedBy()
    {
        return $this->belongsTo(Employee::class, 'authorized_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function performanceAppraisalIO()
    {
        return $this->belongsTo(PerformanceAppraisal::class, 'io_performance_appraisal_id');
    }

    public function performanceAppraisalSRO()
    {
        return $this->belongsTo(PerformanceAppraisal::class, 'sro_performance_appraisal_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
