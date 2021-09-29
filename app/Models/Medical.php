<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Medical extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'medical';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function authenticatedBy()
    {
        return $this->belongsTo(Employee::class, 'authorized_by');
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
