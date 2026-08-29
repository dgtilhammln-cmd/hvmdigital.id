@extends('layouts.admin')

@section('title', 'Data Akun — Self Service')

@section('content')
<div style="padding:28px 32px;">

  {{-- Header --}}
  <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
    <div>
      <h1 style="font-size:20px;font-weight:700;color:#111827;margin:0 0 3px;">Data Akun</h1>
      <p style="font-size:13px;color:#6b7280;margin:0;">Semua akun yang terdaftar di sistem HVM Digital.</p>
    </div>
  </div>

  {{-- Alert --}}
  @if(session('success'))
    <div class="alert-success">
      <svg style="width:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      {{ session('success') }}
    </div>
  @endif

  {{-- Filter --}}
  <div class="panel mb-5">
    <form method="GET" action="{{ route('admin.accounts.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
             class="form-input" style="max-width:280px;">
      <select name="role" class="form-select" style="max-width:160px;">
        <option value="">Semua Role</option>
        <option value="admin"      {{ request('role') === 'admin'      ? 'selected' : '' }}>Admin</option>
        <option value="copywriter" {{ request('role') === 'copywriter' ? 'selected' : '' }}>Copywriter</option>
        <option value="user"       {{ request('role') === 'user'       ? 'selected' : '' }}>UMKM / User</option>
      </select>
      <button type="submit" class="btn-primary">
        <svg style="width:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        Cari
      </button>
      @if(request('search') || request('role'))
        <a href="{{ route('admin.accounts.index') }}" class="btn-secondary">Reset</a>
      @endif
    </form>
  </div>

  {{-- Tabel --}}
  <div class="panel" style="padding:0;overflow:hidden;">
    <table class="admin-table">
      <thead>
        <tr>
          <th style="width:40px;">#</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Terdaftar</th>
          <th style="width:120px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr>
            <td style="color:#9ca3af;font-size:12px;">{{ $users->firstItem() + $loop->index }}</td>
            <td>
              <div style="display:flex;align-items:center;gap:9px;">
                <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#9acb03,#075749);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;flex-shrink:0;">
                  {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                  <div style="font-weight:600;font-size:13px;color:#111827;">{{ $user->name }}</div>
                  @if($user->username ?? null)
                    <div style="font-size:11px;color:#9ca3af;">@{{ $user->username }}</div>
                  @endif
                </div>
              </div>
            </td>
            <td style="font-size:13px;color:#374151;">{{ $user->email }}</td>
            <td>
              @php
                $roleBadge = match($user->role) {
                  'admin'      => ['label'=>'Admin',      'class'=>'badge-blue'],
                  'copywriter' => ['label'=>'Copywriter', 'class'=>'badge-gray'],
                  'user'       => ['label'=>'UMKM',       'class'=>'badge-green'],
                  default      => ['label'=>ucfirst($user->role ?? '-'), 'class'=>'badge-gray'],
                };
              @endphp
              <span class="{{ $roleBadge['class'] }}">{{ $roleBadge['label'] }}</span>
            </td>
            <td style="font-size:12px;color:#9ca3af;white-space:nowrap;">
              {{ $user->created_at->format('d M Y') }}<br>
              <span style="font-size:11px;">{{ $user->created_at->format('H:i') }}</span>
            </td>
            <td>
              <div style="display:flex;gap:6px;align-items:center;">
                {{-- Lihat Detail --}}
                <button type="button"
                        onclick="openDetailModal({{ $user->id }})"
                        style="width:30px;height:30px;border-radius:8px;border:1px solid #e5e7eb;background:#f9fafb;cursor:pointer;display:flex;align-items:center;justify-content:center;"
                        title="Lihat detail">
                  <svg style="width:14px;" fill="none" stroke="#374151" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </button>
                {{-- Ganti Password --}}
                <button type="button"
                        onclick="openPasswordModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                        style="width:30px;height:30px;border-radius:8px;border:1px solid #fde68a;background:#fffbeb;cursor:pointer;display:flex;align-items:center;justify-content:center;"
                        title="Ganti password">
                  <svg style="width:14px;" fill="none" stroke="#d97706" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>

          {{-- Detail row (hidden) --}}
          <tr id="detail-row-{{ $user->id }}" style="display:none;">
            <td colspan="6" style="background:#f9fafb;padding:16px 20px;">
              <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;font-size:13px;">
                <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">ID</span><br><strong>#{{ $user->id }}</strong></div>
                <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">Nama</span><br><strong>{{ $user->name }}</strong></div>
                <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">Email</span><br><strong>{{ $user->email }}</strong></div>
                @if($user->username ?? null)
                  <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">Username</span><br><strong>{{ $user->username }}</strong></div>
                @endif
                <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">Role</span><br><strong>{{ $user->role ?? '-' }}</strong></div>
                <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">Email Verified</span><br>
                  @if($user->email_verified_at)
                    <strong style="color:#15803d;">{{ $user->email_verified_at->format('d M Y H:i') }}</strong>
                  @else
                    <strong style="color:#dc2626;">Belum terverifikasi</strong>
                  @endif
                </div>
                <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">Terdaftar</span><br><strong>{{ $user->created_at->format('d M Y, H:i') }}</strong></div>
                <div><span style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:0.06em;">Update Terakhir</span><br><strong>{{ $user->updated_at->format('d M Y, H:i') }}</strong></div>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align:center;padding:40px;color:#9ca3af;font-size:14px;">
              Tidak ada akun ditemukan.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- Pagination --}}
    @if($users->hasPages())
      <div style="padding:14px 18px;border-top:1px solid #f0f0f0;">
        {{ $users->links() }}
      </div>
    @endif
  </div>

</div>

{{-- ======== MODAL: GANTI PASSWORD ======== --}}
<div id="password-modal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(0,0,0,0.4);align-items:center;justify-content:center;padding:20px;">
  <div style="background:#fff;border-radius:16px;width:100%;max-width:420px;padding:28px;box-shadow:0 20px 60px rgba(0,0,0,0.15);">
    <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 4px;" id="modal-title">Ganti Password</h3>
    <p style="font-size:13px;color:#6b7280;margin:0 0 20px;" id="modal-subtitle">Akun: —</p>

    <form id="password-form" method="POST">
      @csrf
      @method('PUT')

      <div style="margin-bottom:16px;">
        <label class="form-label">Password Baru</label>
        <input type="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
      </div>
      <div style="margin-bottom:22px;">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password baru" required>
      </div>

      <div style="display:flex;gap:10px;justify-content:flex-end;">
        <button type="button" onclick="closePasswordModal()" class="btn-secondary">Batal</button>
        <button type="submit" class="btn-primary">
          <svg style="width:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          Simpan Password
        </button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
  // Toggle detail row
  function openDetailModal(userId) {
    const row = document.getElementById('detail-row-' + userId);
    if (row) {
      row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }
  }

  // Password modal
  function openPasswordModal(userId, userName) {
    document.getElementById('modal-subtitle').textContent = 'Akun: ' + userName;
    document.getElementById('password-form').action = '/admin/accounts/' + userId + '/password';
    document.getElementById('password-modal').style.display = 'flex';
  }
  function closePasswordModal() {
    document.getElementById('password-modal').style.display = 'none';
    document.getElementById('password-form').reset();
  }
  // Tutup modal kalau klik backdrop
  document.getElementById('password-modal').addEventListener('click', function(e) {
    if (e.target === this) closePasswordModal();
  });
</script>
@endpush
@endsection
