<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'session_id', 'ip_address', 'page_url', 'page_title',
        'referer', 'user_agent', 'device_type', 'browser', 'country', 'city',
    ];
}
