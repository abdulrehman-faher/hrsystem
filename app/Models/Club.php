<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Club extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected static $logName = 'club';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;


    public function authStaff()
    {
        return $this->hasMany(StaffAuthorization::class);
    }
}
