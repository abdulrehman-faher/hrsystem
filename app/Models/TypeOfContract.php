<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TypeOfContract extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];
    protected $table = "type_of_contract";
    protected static $logName = 'typeOfContract';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
}
