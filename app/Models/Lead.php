<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'company', 'needs', 'source_url',
        'status', 'notes',
        'assigned_to',
        'followup_at', 'last_contacted_at',
    ];

    protected $casts = [
        'followup_at'       => 'datetime',
        'last_contacted_at' => 'datetime',
    ];

    // Status labels & colors
    public static array $statusLabels = [
        'new'       => 'Baru',
        'contacted' => 'Dicontact',
        'proposal'  => 'Proposal',
        'closing'   => 'Closing',
        'won'       => 'Won ✅',
        'lost'      => 'Lost ❌',
    ];

    public static array $statusColors = [
        'new'       => '#6366f1',
        'contacted' => '#f59e0b',
        'proposal'  => '#3b82f6',
        'closing'   => '#8b5cf6',
        'won'       => '#10b981',
        'lost'      => '#ef4444',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::$statusLabels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::$statusColors[$this->status] ?? '#6b7280';
    }

    public function getIsFollowupOverdueAttribute(): bool
    {
        return $this->followup_at && $this->followup_at->isPast()
            && !in_array($this->status, ['won', 'lost']);
    }

    // Relations
    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function tags()
    {
        return $this->belongsToMany(LeadTag::class, 'lead_tag');
    }

    // Scopes
    public function scopeNeedsFollowup($query)
    {
        return $query->whereNotNull('followup_at')
            ->where('followup_at', '<=', now())
            ->whereNotIn('status', ['won', 'lost']);
    }
}
