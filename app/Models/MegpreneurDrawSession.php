<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegpreneurDrawSession extends Model
{
    protected $table = 'megpreneur_draw_sessions';

    protected $fillable = [
        'status',
        'is_public',
        'draw_started',
        'winner_ids',
        'drawn_at',
        'drawn_by',
    ];

    protected $casts = [
        'is_public'    => 'boolean',
        'draw_started' => 'boolean',
        'winner_ids'   => 'array',
        'drawn_at'     => 'datetime',
    ];

    /**
     * Ambil sesi aktif (terbaru), atau buat baru jika belum ada.
     */
    public static function current(): static
    {
        return static::latest()->firstOrCreate(
            [],
            [
                'status'       => 'draft',
                'is_public'    => false,
                'draw_started' => false,
                'winner_ids'   => null,
            ]
        );
    }

    /**
     * Apakah sesi ini sudah dikunci (tidak bisa ubah pemenang).
     */
    public function isLocked(): bool
    {
        return in_array($this->status, ['locked', 'announced']);
    }

    /**
     * Apakah pemenang sudah diumumkan (API reveal aktif).
     */
    public function isAnnounced(): bool
    {
        return $this->status === 'announced';
    }

    /**
     * Ambil data pemenang lengkap.
     */
    public function getWinnersData(): \Illuminate\Support\Collection
    {
        if (empty($this->winner_ids)) {
            return collect();
        }

        return MegpreneurParticipant::whereIn('id', $this->winner_ids)->get();
    }
}
