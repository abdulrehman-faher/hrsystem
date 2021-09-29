<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class JobType extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'jobType';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;


    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function authStaff()
    {
        return $this->hasMany(StaffAuthorization::class);
    }
    public function applicants()
    {
        return $this->hasMany(Application::class);
    }
}
