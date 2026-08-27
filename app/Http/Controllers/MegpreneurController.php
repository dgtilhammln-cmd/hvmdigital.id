<?php

namespace App\Http\Controllers;

use App\Models\MegpreneurParticipant;
use App\Models\MegpreneurDrawSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MegpreneurController extends Controller
{
    /**
     * GET /megpreneur — Halaman undian publik.
     */
    public function index()
    {
        $session = MegpreneurDrawSession::current();

        // Jika halaman tidak diaktifkan oleh admin, tampilkan coming soon
        $isActive = $session->is_public;

        // Ambil peserta valid (hanya nama usaha + nomor peserta — tanpa data sensitif)
        $participants = MegpreneurParticipant::valid()
            ->select('id', 'nomor_peserta', 'nama_usaha')
            ->orderBy('id')
            ->get();

        return view('megpreneur.index', compact('participants', 'session', 'isActive'));
    }

    /**
     * GET /megpreneur/form — Form pendaftaran.
     */
    public function showForm()
    {
        return view('megpreneur.form');
    }

    /**
     * POST /megpreneur/form — Proses pendaftaran.
     */
    public function submitForm(Request $request)
    {
        $request->validate([
            'nama_pic'          => 'required|string|max:255',
            'nama_usaha'        => 'required|string|max:255',
            'kontak_pic'        => 'required|string|max:20|unique:megpreneur_participants,kontak_pic',
            'bidang_sektor'     => 'required|string|max:100',
            'foto_follow_ig'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_follow_tiktok'=> 'required|image|mimes:jpg,jpeg,png|max:2048',
            'konfirmasi_maps'   => 'required|accepted',
        ], [
            'nama_pic.required'           => 'Nama penanggung jawab wajib diisi.',
            'nama_usaha.required'         => 'Nama usaha wajib diisi.',
            'kontak_pic.required'         => 'Nomor WhatsApp wajib diisi.',
            'kontak_pic.unique'           => 'Nomor WhatsApp ini sudah terdaftar. Setiap nomor hanya bisa mendaftar sekali.',
            'bidang_sektor.required'      => 'Bidang usaha wajib dipilih.',
            'foto_follow_ig.required'     => 'Screenshot follow Instagram wajib diupload.',
            'foto_follow_ig.image'        => 'File harus berupa gambar.',
            'foto_follow_ig.max'          => 'Ukuran file maksimal 2MB.',
            'foto_follow_tiktok.required' => 'Screenshot follow TikTok wajib diupload.',
            'foto_follow_tiktok.image'    => 'File harus berupa gambar.',
            'foto_follow_tiktok.max'      => 'Ukuran file maksimal 2MB.',
            'konfirmasi_maps.accepted'    => 'Konfirmasi kunjungan Google Maps wajib dicentang.',
        ]);

        // Upload foto
        $pathIg     = $request->file('foto_follow_ig')->store('megpreneur/bukti', 'public');
        $pathTiktok = $request->file('foto_follow_tiktok')->store('megpreneur/bukti', 'public');

        // Generate nomor peserta unik
        $nomor = MegpreneurParticipant::generateNomor();

        $participant = MegpreneurParticipant::create([
            'nomor_peserta'     => $nomor,
            'nama_pic'          => $request->nama_pic,
            'nama_usaha'        => $request->nama_usaha,
            'kontak_pic'        => $request->kontak_pic,
            'bidang_sektor'     => $request->bidang_sektor,
            'foto_follow_ig'    => $pathIg,
            'foto_follow_tiktok'=> $pathTiktok,
            'konfirmasi_maps'   => true,
        ]);

        return redirect()->route('megpreneur.success')
            ->with('nomor_peserta', $participant->nomor_peserta)
            ->with('nama_usaha', $participant->nama_usaha);
    }

    /**
     * GET /megpreneur/sukses — Halaman sukses pendaftaran.
     */
    public function success()
    {
        // Jika tidak ada session flash, redirect ke form
        if (!session('nomor_peserta')) {
            return redirect()->route('megpreneur.form');
        }

        return view('megpreneur.success');
    }

    /**
     * GET /megpreneur/api/status — Polling API untuk status undian (publik).
     *
     * SECURITY: winner_ids TIDAK pernah dikembalikan di endpoint ini.
     * Hanya berisi flag boolean yang dibutuhkan oleh frontend.
     */
    public function apiStatus()
    {
        $session = MegpreneurDrawSession::current();

        return response()->json([
            'active'       => $session->is_public,
            'draw_started' => $session->draw_started,
            'announced'    => $session->isAnnounced(),
            'total'        => MegpreneurParticipant::valid()->count(),
        ]);
    }

    /**
     * GET /megpreneur/api/reveal — Reveal pemenang (hanya setelah diumumkan admin).
     *
     * SECURITY: Endpoint ini hanya aktif setelah status = 'announced'.
     * Dipanggil oleh JS frontend SETELAH animasi selesai.
     */
    public function apiRevealWinners()
    {
        $session = MegpreneurDrawSession::current();

        if (!$session->isAnnounced()) {
            return response()->json(['error' => 'Undian belum diumumkan.'], 403);
        }

        $winners = $session->getWinnersData()->map(fn($p) => [
            'id'           => $p->id,
            'nomor_peserta'=> $p->nomor_peserta,
            'nama_usaha'   => $p->nama_usaha,
        ]);

        return response()->json([
            'winners' => $winners,
        ]);
    }
}
