<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Leave extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'leave';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;

    protected $cast = [
        'from' => Carbon::class,
        'to' => Carbon::class,
    ];

    // protected $table = "acrs";

    // protected $with = ['images'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'type_of_leave_id');
    }

    public function authenticatedBy()
    {
        return $this->belongsTo(Employee::class, 'authorized_by');
    }

    public function getYearlyLeaveData()
    {
        $sql = "SELECT * FROM `leaves` WHERE employee_id = 26 AND `from` >= '2020-01-01' AND `to` <= '2020-12-31'";
    }
}
