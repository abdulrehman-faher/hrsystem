<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Kindered extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'kindered';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function authenticatedBy()
    {
        return $this->belongsTo(Employee::class, 'authorized_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
