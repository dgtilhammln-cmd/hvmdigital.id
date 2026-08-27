@extends('layouts.admin')
@section('title','Megpreneur 2026')
@section('page-title','Megpreneur 2026')
@section('page-subtitle','Manajemen peserta & kontrol undian interaktif')

@section('content')

{{-- ======== STATUS BANNER ======== --}}
<div class="mb-6 p-5 rounded-2xl border flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4
  @if($session->status === 'announced') bg-green-50 border-green-200
  @elseif($session->status === 'locked') bg-amber-50 border-amber-200
  @else bg-blue-50 border-blue-200 @endif">
  <div class="flex items-center gap-3">
    @if($session->status === 'announced')
      <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center"><span class="text-xl">🏆</span></div>
      <div>
        <p class="font-bold text-green-800 text-sm">Status: DIUMUMKAN</p>
        <p class="text-green-600 text-xs">Pemenang sudah resmi diumumkan. Undian selesai.</p>
      </div>
    @elseif($session->status === 'locked')
      <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center"><span class="text-xl">🔒</span></div>
      <div>
        <p class="font-bold text-amber-800 text-sm">Status: DIKUNCI</p>
        <p class="text-amber-600 text-xs">{{ $session->draw_started ? 'Animasi sudah dimulai. Klik Umumkan setelah animasi selesai.' : 'Siap untuk diputar. Aktifkan halaman publik, lalu trigger undian.' }}</p>
      </div>
    @else
      <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center"><span class="text-xl">📋</span></div>
      <div>
        <p class="font-bold text-blue-800 text-sm">Status: DRAFT</p>
        <p class="text-blue-600 text-xs">Pilih pemenang → Kunci Hasil → Aktifkan Publik → Trigger Undian → Umumkan.</p>
      </div>
    @endif
  </div>
  <div class="flex items-center gap-2 flex-wrap">
    <span class="text-xs font-medium px-3 py-1.5 rounded-full
      @if($session->is_public) bg-green-100 text-green-700 @else bg-gray-100 text-gray-500 @endif">
      {{ $session->is_public ? '🌐 Publik AKTIF' : '🔒 Publik NONAKTIF' }}
    </span>
    @if($session->drawn_by)
    <span class="text-xs bg-white border border-gray-200 text-gray-600 px-3 py-1.5 rounded-full">
      Oleh: {{ $session->drawn_by }} · {{ $session->drawn_at?->format('d/m H:i') }}
    </span>
    @endif
  </div>
</div>

{{-- ======== TOP STATS ======== --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
  <div class="admin-card">
    <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">Total Peserta</p>
    <p class="text-2xl font-black text-gray-900">{{ $totalAll }}</p>
  </div>
  <div class="admin-card">
    <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">Valid</p>
    <p class="text-2xl font-black text-green-600">{{ $totalValid }}</p>
  </div>
  <div class="admin-card">
    <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">Invalid</p>
    <p class="text-2xl font-black text-red-500">{{ $totalInvalid }}</p>
  </div>
  <div class="admin-card">
    <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">Pemenang</p>
    <p class="text-2xl font-black text-amber-600">{{ count($session->winner_ids ?? []) }}</p>
  </div>
</div>

{{-- ======== TABS ======== --}}
<div style="background:#fff;border-radius:20px;border:1px solid #e5e7eb;overflow:hidden;">

  {{-- Tab Nav --}}
  <div style="border-bottom:1px solid #f3f4f6;display:flex;overflow-x:auto;">
    @foreach([
      ['id'=>'tab-peserta',   'label'=>'Manajemen Peserta',    'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
      ['id'=>'tab-pemenang',  'label'=>'Setting Pemenang',      'icon'=>'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
      ['id'=>'tab-kontrol',   'label'=>'Kontrol Undian',        'icon'=>'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
    ] as $tab)
    <button onclick="openTab('{{ $tab['id'] }}')" id="btn-{{ $tab['id'] }}"
            style="display:flex;align-items:center;gap:8px;padding:16px 24px;font-size:13px;font-weight:600;border:none;background:none;cursor:pointer;white-space:nowrap;transition:all 0.2s;border-bottom:2px solid transparent;"
            class="mgp-tab-btn">
      <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $tab['icon'] }}"/>
      </svg>
      {{ $tab['label'] }}
    </button>
    @endforeach
  </div>

  {{-- ============================================================
       TAB 1: MANAJEMEN PESERTA
       ============================================================ --}}
  <div id="tab-peserta" class="mgp-tab-content" style="padding:24px;">

    {{-- Toolbar --}}
    <form method="GET" action="{{ route('admin.megpreneur.index') }}" class="flex flex-wrap gap-3 mb-6 items-center">
      <input type="text" name="search" value="{{ request('search') }}"
             placeholder="Cari nama, usaha, kontak..." class="form-input" style="max-width:280px;">
      <select name="sektor" class="form-select" style="max-width:180px;">
        <option value="">Semua Sektor</option>
        @foreach($sectors as $s)
        <option value="{{ $s }}" {{ request('sektor')==$s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
      </select>
      <select name="valid" class="form-select" style="max-width:160px;">
        <option value="">Semua Status</option>
        <option value="1" {{ request('valid')==='1' ? 'selected' : '' }}>Valid</option>
        <option value="0" {{ request('valid')==='0' ? 'selected' : '' }}>Invalid</option>
      </select>
      <button type="submit" class="btn-primary">
        <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        Filter
      </button>
      <a href="{{ route('admin.megpreneur.index') }}" class="btn-secondary">Reset</a>
      <a href="{{ route('admin.megpreneur.export') }}" class="btn-secondary" style="margin-left:auto;">
        <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Export CSV
      </a>
    </form>

    {{-- Table --}}
    <div style="overflow-x:auto;border-radius:14px;border:1px solid #f3f4f6;">
      <table class="admin-table" style="min-width:900px;">
        <thead>
          <tr>
            <th>No. Peserta</th>
            <th>Nama PIC</th>
            <th>Nama Usaha</th>
            <th>Kontak WA</th>
            <th>Sektor</th>
            <th>Bukti Foto</th>
            <th>Daftar</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($participants as $p)
          <tr>
            <td>
              <span style="font-family:monospace;font-size:12px;font-weight:700;color:#075749;background:#f0fdf4;padding:3px 8px;border-radius:6px;">
                {{ $p->nomor_peserta }}
              </span>
              @if($p->is_winner) <span class="badge-green" style="font-size:10px;">🏆</span> @endif
            </td>
            <td style="font-weight:500;color:#111827;">{{ $p->nama_pic }}</td>
            <td style="font-weight:600;color:#075749;">{{ $p->nama_usaha }}</td>
            <td style="font-size:12px;color:#6b7280;">{{ $p->kontak_pic }}</td>
            <td>
              <span class="badge-gray">{{ $p->bidang_sektor }}</span>
            </td>
            <td>
              <div style="display:flex;gap:6px;">
                {{-- Preview IG --}}
                <button onclick="openPhotoModal('{{ asset('storage/'.$p->foto_follow_ig) }}','Follow Instagram')"
                        style="width:32px;height:32px;border-radius:8px;border:1px solid #e5e7eb;overflow:hidden;cursor:pointer;padding:0;background:none;flex-shrink:0;"
                        title="Lihat foto follow IG">
                  <img src="{{ asset('storage/'.$p->foto_follow_ig) }}" alt="IG" style="width:100%;height:100%;object-fit:cover;">
                </button>
                {{-- Preview TikTok --}}
                <button onclick="openPhotoModal('{{ asset('storage/'.$p->foto_follow_tiktok) }}','Follow TikTok')"
                        style="width:32px;height:32px;border-radius:8px;border:1px solid #e5e7eb;overflow:hidden;cursor:pointer;padding:0;background:none;flex-shrink:0;"
                        title="Lihat foto follow TikTok">
                  <img src="{{ asset('storage/'.$p->foto_follow_tiktok) }}" alt="TikTok" style="width:100%;height:100%;object-fit:cover;">
                </button>
              </div>
            </td>
            <td style="font-size:12px;color:#9ca3af;white-space:nowrap;">{{ $p->created_at->format('d M Y\nH:i') }}</td>
            <td>
              @if($p->is_valid)
                <span class="badge-green">Valid</span>
              @else
                <span class="badge-gray">Invalid</span>
              @endif
            </td>
            <td>
              <div style="display:flex;gap:6px;">
                {{-- Toggle valid --}}
                <form method="POST" action="{{ route('admin.megpreneur.toggle-valid', $p->id) }}">
                  @csrf
                  <button type="submit" title="{{ $p->is_valid ? 'Set Invalid' : 'Set Valid' }}"
                          style="width:30px;height:30px;border-radius:7px;border:1px solid #e5e7eb;background:#f9fafb;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;">
                    {{ $p->is_valid ? '✗' : '✓' }}
                  </button>
                </form>
                {{-- Delete --}}
                <form method="POST" action="{{ route('admin.megpreneur.destroy', $p->id) }}"
                      onsubmit="return confirm('Hapus peserta {{ addslashes($p->nama_usaha) }}? Foto akan ikut dihapus.')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-danger" style="padding:4px 10px;font-size:11px;">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" style="text-align:center;padding:40px;color:#9ca3af;">
              <svg style="width:40px;height:40px;margin:0 auto 12px;color:#d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              Belum ada peserta terdaftar.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if($participants->hasPages())
    <div class="mt-5">{{ $participants->links() }}</div>
    @endif
  </div>

  {{-- ============================================================
       TAB 2: SETTING PEMENANG
       ============================================================ --}}
  <div id="tab-pemenang" class="mgp-tab-content" style="padding:24px;display:none;">

    @if($session->isLocked())
    <div style="background:#fef3c7;border:1px solid #fcd34d;border-radius:12px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px;">
      <svg style="width:20px;height:20px;color:#d97706;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
      <div>
        <p style="font-weight:700;color:#92400e;font-size:13px;">Hasil Dikunci — Tidak Bisa Diubah</p>
        <p style="color:#b45309;font-size:12px;">Status: <strong>{{ strtoupper($session->status) }}</strong>. Hubungi super admin untuk reset jika diperlukan.</p>
      </div>
    </div>
    @endif

    {{-- Form pilih pemenang --}}
    <form method="POST" action="{{ route('admin.megpreneur.set-winners') }}" id="winnerForm">
      @csrf

      <div class="flex items-center justify-between mb-5 flex-wrap gap-3">
        <div>
          <h3 style="font-weight:700;color:#111827;font-size:15px;">Pilih Pemenang</h3>
          <p style="color:#9ca3af;font-size:12px;">Centang peserta yang akan menjadi pemenang. Bisa lebih dari satu.</p>
        </div>
        <div style="display:flex;gap:8px;">
          <button type="button" onclick="selectAll()" class="btn-secondary" style="font-size:12px;padding:6px 12px;">Pilih Semua</button>
          <button type="button" onclick="selectNone()" class="btn-secondary" style="font-size:12px;padding:6px 12px;">Batal Semua</button>
        </div>
      </div>

      @php $allParticipants = \App\Models\MegpreneurParticipant::valid()->orderBy('id')->get(); @endphp

      <div style="max-height:500px;overflow-y:auto;border:1px solid #e5e7eb;border-radius:14px;padding:8px;" id="winnerList">
        @forelse($allParticipants as $p)
        <label style="display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:10px;cursor:pointer;transition:background 0.15s;{{ $session->isLocked() ? 'pointer-events:none;opacity:0.7;' : '' }}"
               onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
          <input type="checkbox" name="winner_ids[]" value="{{ $p->id }}"
                 {{ in_array($p->id, $session->winner_ids ?? []) ? 'checked' : '' }}
                 {{ $session->isLocked() ? 'disabled' : '' }}
                 onchange="updateCount()"
                 style="width:18px;height:18px;accent-color:#075749;cursor:pointer;flex-shrink:0;">
          <div style="flex:1;min-width:0;">
            <div style="display:flex;align-items:center;gap:8px;">
              <span style="font-weight:700;color:#111827;font-size:13px;">{{ $p->nama_usaha }}</span>
              <span style="font-size:10px;font-family:monospace;background:#f0fdf4;color:#075749;border:1px solid #bbf7d0;padding:1px 7px;border-radius:20px;font-weight:600;">{{ $p->nomor_peserta }}</span>
              <span style="font-size:10px;background:#f3f4f6;color:#6b7280;padding:1px 7px;border-radius:20px;">{{ $p->bidang_sektor }}</span>
            </div>
            <p style="color:#9ca3af;font-size:11px;margin-top:2px;">PIC: {{ $p->nama_pic }}</p>
          </div>
        </label>
        <div style="height:1px;background:#f3f4f6;margin:0 14px;"></div>
        @empty
        <p style="text-align:center;padding:32px;color:#9ca3af;">Belum ada peserta valid.</p>
        @endforelse
      </div>

      <div style="display:flex;align-items:center;gap:12px;margin-top:16px;flex-wrap:wrap;">
        <p style="font-size:13px;color:#6b7280;">Terpilih: <strong id="selectedCount" style="color:#075749;">{{ count($session->winner_ids ?? []) }}</strong> peserta</p>

        @if(!$session->isLocked())
        <button type="submit" class="btn-primary">
          <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          Simpan Pemenang (Draft)
        </button>
        @endif
      </div>
    </form>

    {{-- Lock & Reset buttons --}}
    <div style="border-top:1px solid #f3f4f6;margin-top:24px;padding-top:24px;display:flex;flex-wrap:wrap;gap:10px;">
      @if(!$session->isLocked())
      <form method="POST" action="{{ route('admin.megpreneur.lock') }}"
            onsubmit="return confirm('⚠️ KUNCI HASIL? Setelah dikunci, pemenang tidak bisa diubah kecuali di-reset oleh admin. Lanjutkan?')">
        @csrf
        <button type="submit" style="background:#f59e0b;color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;">
          <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
          🔒 Kunci Hasil Undian
        </button>
      </form>
      @endif

      <form method="POST" action="{{ route('admin.megpreneur.reset') }}"
            onsubmit="return confirm('⛔ RESET TOTAL? Ini akan menghapus semua pemenang dan mengembalikan sesi ke draft. Tindakan ini tidak bisa dibatalkan. Lanjutkan?')">
        @csrf
        <button type="submit" class="btn-danger" style="padding:9px 20px;font-size:13px;font-weight:600;">
          🔄 Reset Sesi (Super Admin)
        </button>
      </form>
    </div>
  </div>

  {{-- ============================================================
       TAB 3: KONTROL UNDIAN
       ============================================================ --}}
  <div id="tab-kontrol" class="mgp-tab-content" style="padding:24px;display:none;">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      {{-- Left: Control Panel --}}
      <div>
        <h3 style="font-weight:700;color:#111827;font-size:15px;margin-bottom:16px;">Panel Kontrol</h3>

        {{-- Step 1: Aktifkan Halaman Publik --}}
        <div style="border:1px solid #e5e7eb;border-radius:14px;padding:18px;margin-bottom:12px;" class="control-step">
          <div style="display:flex;align-items:flex-start;gap:12px;">
            <div style="width:32px;height:32px;background:{{ $session->is_public ? '#f0fdf4' : '#f9fafb' }};border:1px solid {{ $session->is_public ? '#bbf7d0' : '#e5e7eb' }};border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <span style="font-size:14px;">{{ $session->is_public ? '✅' : '1️⃣' }}</span>
            </div>
            <div style="flex:1;">
              <p style="font-weight:700;font-size:13px;color:#111827;margin-bottom:2px;">Aktifkan Halaman Publik</p>
              <p style="color:#9ca3af;font-size:11px;margin-bottom:10px;">Halaman /megpreneur akan {{ $session->is_public ? 'menonaktifkan' : 'mengaktifkan' }} tampilan undian.</p>
              <form method="POST" action="{{ route('admin.megpreneur.activate') }}">
                @csrf
                <button type="submit"
                        style="font-size:12px;padding:7px 16px;border-radius:8px;border:none;cursor:pointer;font-weight:600;
                        background:{{ $session->is_public ? '#fee2e2' : '#075749' }};
                        color:{{ $session->is_public ? '#dc2626' : '#fff' }};">
                  {{ $session->is_public ? '🔒 Nonaktifkan Halaman' : '🌐 Aktifkan Halaman Publik' }}
                </button>
              </form>
            </div>
          </div>
        </div>

        {{-- Step 2: Trigger Animasi --}}
        <div style="border:1px solid #e5e7eb;border-radius:14px;padding:18px;margin-bottom:12px;{{ !$session->isLocked() ? 'opacity:0.5;pointer-events:none;' : '' }}">
          <div style="display:flex;align-items:flex-start;gap:12px;">
            <div style="width:32px;height:32px;background:{{ $session->draw_started ? '#f0fdf4' : '#f9fafb' }};border:1px solid {{ $session->draw_started ? '#bbf7d0' : '#e5e7eb' }};border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <span style="font-size:14px;">{{ $session->draw_started ? '✅' : '2️⃣' }}</span>
            </div>
            <div style="flex:1;">
              <p style="font-weight:700;font-size:13px;color:#111827;margin-bottom:2px;">Remote Start Animasi</p>
              <p style="color:#9ca3af;font-size:11px;margin-bottom:10px;">Mulai animasi undian di semua browser yang membuka halaman publik secara real-time (polling 2 detik).</p>
              @if(!$session->draw_started)
              <form method="POST" action="{{ route('admin.megpreneur.trigger') }}"
                    onsubmit="return confirm('Mulai animasi undian sekarang? Semua pengunjung halaman publik akan melihat roda berputar!')">
                @csrf
                <button type="submit"
                        style="font-size:12px;padding:7px 16px;border-radius:8px;border:none;cursor:pointer;font-weight:700;background:#075749;color:#fff;">
                  ▶ TRIGGER START — Putar Sekarang!
                </button>
              </form>
              @else
              <p style="font-size:12px;font-weight:600;color:#15803d;">✅ Animasi sudah dimulai pada {{ $session->drawn_at?->format('H:i:s') }}</p>
              @endif
            </div>
          </div>
        </div>

        {{-- Step 3: Umumkan Pemenang --}}
        <div style="border:1px solid #e5e7eb;border-radius:14px;padding:18px;{{ !$session->draw_started ? 'opacity:0.5;pointer-events:none;' : '' }}">
          <div style="display:flex;align-items:flex-start;gap:12px;">
            <div style="width:32px;height:32px;background:{{ $session->isAnnounced() ? '#fef3c7' : '#f9fafb' }};border:1px solid {{ $session->isAnnounced() ? '#fcd34d' : '#e5e7eb' }};border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <span style="font-size:14px;">{{ $session->isAnnounced() ? '🏆' : '3️⃣' }}</span>
            </div>
            <div style="flex:1;">
              <p style="font-weight:700;font-size:13px;color:#111827;margin-bottom:2px;">Umumkan Pemenang</p>
              <p style="color:#9ca3af;font-size:11px;margin-bottom:10px;">Mengaktifkan API reveal. Frontend akan mengambil data pemenang dan menampilkan overlay setelah animasi.</p>
              @if(!$session->isAnnounced())
              <form method="POST" action="{{ route('admin.megpreneur.announce') }}"
                    onsubmit="return confirm('Umumkan pemenang? API reveal akan aktif dan overlay pemenang muncul di halaman publik.')">
                @csrf
                <button type="submit"
                        style="font-size:12px;padding:7px 16px;border-radius:8px;border:none;cursor:pointer;font-weight:700;background:linear-gradient(135deg,#075749,#9acb03);color:#fff;">
                  🏆 UMUMKAN PEMENANG SEKARANG
                </button>
              </form>
              @else
              <p style="font-size:12px;font-weight:600;color:#15803d;">✅ Pemenang sudah diumumkan!</p>
              @endif
            </div>
          </div>
        </div>

        {{-- Quick link to public page --}}
        <div style="margin-top:16px;padding:14px;background:#f9fafb;border-radius:12px;border:1px dashed #e5e7eb;display:flex;align-items:center;justify-between;">
          <p style="font-size:12px;color:#6b7280;">Halaman publik:</p>
          <a href="{{ route('megpreneur.index') }}" target="_blank"
             style="font-size:12px;font-weight:600;color:#075749;display:flex;align-items:center;gap:4px;text-decoration:none;">
            /megpreneur
            <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
          </a>
        </div>
      </div>

      {{-- Right: History & Winners --}}
      <div>
        {{-- Current winners --}}
        @if(!empty($session->winner_ids))
        <div style="margin-bottom:20px;">
          <h3 style="font-weight:700;color:#111827;font-size:15px;margin-bottom:12px;">
            Pemenang yang Dikunci
            <span style="background:#fef3c7;border:1px solid #fcd34d;color:#b45309;font-size:10px;padding:2px 8px;border-radius:20px;font-weight:600;vertical-align:middle;">{{ count($session->winner_ids) }}</span>
          </h3>
          @php $winners = $session->getWinnersData(); @endphp
          @foreach($winners as $w)
          <div style="display:flex;align-items:center;gap:10px;padding:12px 14px;background:#fffbeb;border:1px solid #fde68a;border-radius:12px;margin-bottom:8px;">
            <span style="font-size:20px;">🏆</span>
            <div>
              <p style="font-weight:700;font-size:13px;color:#92400e;">{{ $w->nama_usaha }}</p>
              <p style="font-size:11px;color:#b45309;font-family:monospace;">{{ $w->nomor_peserta }} · {{ $w->bidang_sektor }}</p>
            </div>
          </div>
          @endforeach
        </div>
        @endif

        {{-- Draw log --}}
        <div>
          <h3 style="font-weight:700;color:#111827;font-size:15px;margin-bottom:12px;">Log Undian</h3>
          <div style="border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;">
            @php
              $logs = [
                ['icon'=>'📋','label'=>'Sesi dibuat','time'=>$session->created_at,'show'=>true],
                ['icon'=>'🔒','label'=>'Dikunci','time'=>$session->isLocked() ? $session->updated_at : null,'show'=>$session->isLocked()],
                ['icon'=>'▶','label'=>'Animasi dimulai oleh '.($session->drawn_by ?? '-'),'time'=>$session->drawn_at,'show'=>$session->draw_started],
                ['icon'=>'🏆','label'=>'Pemenang diumumkan','time'=>$session->isAnnounced() ? $session->updated_at : null,'show'=>$session->isAnnounced()],
              ];
            @endphp
            @foreach($logs as $log)
            @if($log['show'])
            <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-bottom:1px solid #f3f4f6;">
              <span style="font-size:16px;">{{ $log['icon'] }}</span>
              <div style="flex:1;">
                <p style="font-size:12px;font-weight:600;color:#374151;">{{ $log['label'] }}</p>
                @if($log['time'])
                <p style="font-size:11px;color:#9ca3af;">{{ $log['time']->format('d M Y, H:i:s') }}</p>
                @endif
              </div>
            </div>
            @endif
            @endforeach
            @if(!$session->draw_started && !$session->isLocked())
            <p style="text-align:center;padding:20px;color:#9ca3af;font-size:12px;">Belum ada aktivitas undian.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

{{-- Photo Preview Modal --}}
<div id="photoModal"
     onclick="closePhotoModal()"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.85);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(8px);">
  <div onclick="event.stopPropagation()" style="max-width:90vw;max-height:90vh;position:relative;">
    <button onclick="closePhotoModal()"
            style="position:absolute;top:-12px;right:-12px;width:32px;height:32px;background:#fff;border:none;border-radius:50%;cursor:pointer;font-size:16px;z-index:10;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.3);">✕</button>
    <p id="photoModalLabel" style="color:rgba(255,255,255,0.6);font-size:12px;margin-bottom:10px;text-align:center;"></p>
    <img id="photoModalImg" src="" alt="" style="max-width:90vw;max-height:80vh;border-radius:16px;object-fit:contain;">
  </div>
</div>

<style>
.admin-card {
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:14px;
  padding:16px 20px;
}
.mgp-tab-btn.active {
  color:#075749 !important;
  border-bottom-color:#075749 !important;
  background: rgba(7,87,73,0.04);
}
</style>

@endsection

@push('scripts')
<script>
// =============================================
// TAB SYSTEM
// =============================================
function openTab(tabId) {
  document.querySelectorAll('.mgp-tab-content').forEach(t => t.style.display = 'none');
  document.querySelectorAll('.mgp-tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById(tabId).style.display = 'block';
  document.getElementById('btn-' + tabId).classList.add('active');
}
// Activate first tab on load
openTab('tab-peserta');

// =============================================
// WINNER CHECKBOX COUNTER
// =============================================
function updateCount() {
  const count = document.querySelectorAll('input[name="winner_ids[]"]:checked').length;
  document.getElementById('selectedCount').textContent = count;
}
function selectAll() {
  document.querySelectorAll('input[name="winner_ids[]"]:not(:disabled)').forEach(cb => cb.checked = true);
  updateCount();
}
function selectNone() {
  document.querySelectorAll('input[name="winner_ids[]"]:not(:disabled)').forEach(cb => cb.checked = false);
  updateCount();
}

// =============================================
// PHOTO MODAL
// =============================================
function openPhotoModal(src, label) {
  document.getElementById('photoModalImg').src = src;
  document.getElementById('photoModalLabel').textContent = label;
  const m = document.getElementById('photoModal');
  m.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closePhotoModal() {
  document.getElementById('photoModal').style.display = 'none';
  document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closePhotoModal(); });
</script>
@endpush
