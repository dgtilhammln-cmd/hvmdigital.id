<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadTag extends Model
{
    protected $fillable = ['name', 'color'];

    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'lead_tag');
    }
}
