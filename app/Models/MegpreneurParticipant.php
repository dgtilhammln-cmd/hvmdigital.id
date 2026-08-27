<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegpreneurParticipant extends Model
{
    protected $table = 'megpreneur_participants';

    protected $fillable = [
        'nomor_peserta',
        'nama_pic',
        'nama_usaha',
        'kontak_pic',
        'bidang_sektor',
        'foto_follow_ig',
        'foto_follow_tiktok',
        'foto_selfie_booth',
        'konfirmasi_maps',
        'is_valid',
        'is_winner',
    ];

    protected $casts = [
        'konfirmasi_maps' => 'boolean',
        'is_valid'        => 'boolean',
        'is_winner'       => 'boolean',
    ];

    /**
     * Generate nomor peserta berikutnya (HVM-XXXX).
     */
    public static function generateNomor(): string
    {
        $last = static::max('id') ?? 0;
        return 'HVM-' . str_pad($last + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Scope: hanya peserta yang valid.
     */
    public function scopeValid($query)
    {
        return $query->where('is_valid', true);
    }

    /**
     * Accessor: nomor peserta dalam format HVM-0001.
     */
    public function getNomorFormattedAttribute(): string
    {
        return $this->nomor_peserta;
    }

    /**
     * URL foto IG.
     */
    public function getFotoIgUrlAttribute(): string
    {
        return asset('storage/' . $this->foto_follow_ig);
    }

    /**
     * URL foto TikTok.
     */
    public function getFotoTiktokUrlAttribute(): string
    {
        return asset('storage/' . $this->foto_follow_tiktok);
    }
}
