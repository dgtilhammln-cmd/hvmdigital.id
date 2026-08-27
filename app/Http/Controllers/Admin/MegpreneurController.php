<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MegpreneurParticipant;
use App\Models\MegpreneurDrawSession;
use Illuminate\Http\Request;

class MegpreneurController extends Controller
{
    /**
     * GET /admin/megpreneur — Panel admin utama.
     */
    public function index(Request $request)
    {
        $query = MegpreneurParticipant::query()->latest();

        // Filter search
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_pic', 'like', "%{$s}%")
                  ->orWhere('nama_usaha', 'like', "%{$s}%")
                  ->orWhere('kontak_pic', 'like', "%{$s}%")
                  ->orWhere('nomor_peserta', 'like', "%{$s}%");
            });
        }

        // Filter sektor
        if ($request->filled('sektor')) {
            $query->where('bidang_sektor', $request->sektor);
        }

        // Filter validitas
        if ($request->filled('valid')) {
            $query->where('is_valid', $request->valid === '1');
        }

        $participants = $query->paginate(20)->withQueryString();
        $session      = MegpreneurDrawSession::current();
        $sectors      = MegpreneurParticipant::distinct()->pluck('bidang_sektor')->sort()->values();
        $totalValid   = MegpreneurParticipant::valid()->count();
        $totalInvalid = MegpreneurParticipant::where('is_valid', false)->count();
        $totalAll     = MegpreneurParticipant::count();

        return view('admin.megpreneur.index', compact(
            'participants', 'session', 'sectors',
            'totalValid', 'totalInvalid', 'totalAll'
        ));
    }

    /**
     * POST /admin/megpreneur/{id}/toggle-valid
     */
    public function toggleValid($id)
    {
        $participant = MegpreneurParticipant::findOrFail($id);
        $participant->update(['is_valid' => !$participant->is_valid]);

        return back()->with('success', "Peserta {$participant->nama_usaha} berhasil " . ($participant->is_valid ? 'divalidasi' : 'dinonaktifkan') . '.');
    }

    /**
     * POST /admin/megpreneur/set-winners — Simpan pilihan pemenang (status tetap draft).
     */
    public function setWinners(Request $request)
    {
        $session = MegpreneurDrawSession::current();

        if ($session->isLocked()) {
            return back()->with('error', 'Undian sudah dikunci. Tidak bisa mengubah pemenang.');
        }

        $request->validate([
            'winner_ids'   => 'required|array|min:1',
            'winner_ids.*' => 'exists:megpreneur_participants,id',
        ], [
            'winner_ids.required' => 'Pilih minimal satu pemenang.',
            'winner_ids.min'      => 'Pilih minimal satu pemenang.',
        ]);

        $session->update(['winner_ids' => $request->winner_ids]);

        return back()->with('success', count($request->winner_ids) . ' pemenang berhasil disimpan. Status masih DRAFT — belum dikunci.');
    }

    /**
     * POST /admin/megpreneur/lock — Kunci hasil undian.
     */
    public function lockDraw()
    {
        $session = MegpreneurDrawSession::current();

        if ($session->isLocked()) {
            return back()->with('error', 'Undian sudah dalam status terkunci.');
        }

        if (empty($session->winner_ids)) {
            return back()->with('error', 'Belum ada pemenang yang dipilih. Pilih pemenang terlebih dahulu.');
        }

        $session->update(['status' => 'locked']);

        return back()->with('success', 'Hasil undian berhasil dikunci! Tidak bisa diubah kecuali di-reset.');
    }

    /**
     * POST /admin/megpreneur/activate — Toggle tampilan halaman publik.
     */
    public function activatePublic()
    {
        $session = MegpreneurDrawSession::current();
        $newVal  = !$session->is_public;
        $session->update(['is_public' => $newVal]);

        $msg = $newVal ? 'Halaman undian publik DIAKTIFKAN.' : 'Halaman undian publik DINONAKTIFKAN.';
        return back()->with('success', $msg);
    }

    /**
     * POST /admin/megpreneur/trigger — Remote start animasi undian.
     */
    public function triggerDraw(Request $request)
    {
        $session = MegpreneurDrawSession::current();

        if (!$session->isLocked()) {
            return back()->with('error', 'Hasil undian harus dikunci sebelum memulai animasi.');
        }

        $session->update([
            'draw_started' => true,
            'drawn_at'     => now(),
            'drawn_by'     => session('admin_name', 'Admin'),
        ]);

        return back()->with('success', '🎰 Animasi undian telah dimulai di halaman publik!');
    }

    /**
     * POST /admin/megpreneur/announce — Umumkan pemenang.
     */
    public function announceDraw()
    {
        $session = MegpreneurDrawSession::current();

        if (!$session->draw_started) {
            return back()->with('error', 'Mulai animasi undian terlebih dahulu.');
        }

        $session->update(['status' => 'announced']);

        return back()->with('success', 'Pemenang resmi diumumkan! API reveal sekarang aktif.');
    }

    /**
     * POST /admin/megpreneur/reset — Reset undian untuk sesi baru
     */
    public function resetDraw()
    {
        $session = MegpreneurDrawSession::current();
        $session->update([
            'status'       => 'draft',
            'draw_started' => false,
            'winner_ids'   => null,
            'drawn_at'     => null,
            'drawn_by'     => null,
        ]);

        return back()->with('success', 'Sesi undian berhasil di-reset. Anda dapat memilih pemenang baru!');
    }

    /**
     * GET /admin/megpreneur/export — Export CSV peserta.
     */
    public function export()
    {
        $participants = MegpreneurParticipant::orderBy('id')->get();

        $filename = 'megpreneur-peserta-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($participants) {
            $handle = fopen('php://output', 'w');

            // BOM untuk Excel agar terbaca UTF-8
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header baris
            fputcsv($handle, [
                'No. Peserta', 'Nama PIC', 'Nama Usaha', 'Kontak (WA)',
                'Bidang Sektor', 'Konfirmasi Maps', 'Valid', 'Pemenang', 'Tanggal Daftar',
            ]);

            foreach ($participants as $p) {
                fputcsv($handle, [
                    $p->nomor_peserta,
                    $p->nama_pic,
                    $p->nama_usaha,
                    $p->kontak_pic,
                    $p->bidang_sektor,
                    $p->konfirmasi_maps ? 'Ya' : 'Tidak',
                    $p->is_valid ? 'Valid' : 'Invalid',
                    $p->is_winner ? 'Pemenang' : '-',
                    $p->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * DELETE /admin/megpreneur/{id} — Hapus peserta.
     */
    public function destroyParticipant($id)
    {
        $participant = MegpreneurParticipant::findOrFail($id);

        // Hapus foto dari storage
        if ($participant->foto_follow_ig) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($participant->foto_follow_ig);
        }
        if ($participant->foto_follow_tiktok) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($participant->foto_follow_tiktok);
        }
        if ($participant->foto_selfie_booth) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($participant->foto_selfie_booth);
        }

        $participant->delete();

        return back()->with('success', "Peserta berhasil dihapus.");
    }
}
