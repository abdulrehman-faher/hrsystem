<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    // protected $casts = ['login_at' => Carbon\Carbon::Class];
    protected $casts = ['properties' => 'array'];
}
