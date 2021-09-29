<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'employee';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function contract()
    {
        return $this->belongsTo(TypeOfContract::class);
    }

    public function education()
    {
        return $this->hasMany(EducationDetail::class);
    }

    public function workHistory()
    {
        return $this->hasMany(WorkHistory::class);
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function conducts()
    {
        return $this->hasMany(EmployeeConduct::class);
    }

    public function acrs()
    {
        return $this->hasMany(ACR::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function kinders()
    {
        return $this->hasMany(Kindered::class);
    }
}
