<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EducationDetail extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'education';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;



    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [];

    public function applicantion()
    {
        return $this->belongsTo(Application::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
