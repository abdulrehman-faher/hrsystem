<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EmployeeConduct extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'conduct';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;


    // protected $with = ['authenticatedBy',];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function authenticatedBy()
    {
        return $this->belongsTo(Employee::class, 'authorized_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
