<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobAnalytics extends Model
{
    protected $fillable = ['job_id', 'type', 'ip_address', 'user_agent'];
}
