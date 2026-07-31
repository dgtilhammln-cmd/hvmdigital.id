<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaClick extends Model
{
    protected $fillable = ['page_url', 'page_title', 'ip_address', 'source', 'city'];
}
