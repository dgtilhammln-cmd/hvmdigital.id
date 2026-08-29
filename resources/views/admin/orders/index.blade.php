@extends('layouts.admin')

@section('title', 'Riwayat Order — Self Service')

@section('content')
<div style="padding:28px 32px;">

  <div style="margin-bottom:24px;">
    <h1 style="font-size:20px;font-weight:700;color:#111827;margin:0 0 3px;">Riwayat Order</h1>
    <p style="font-size:13px;color:#6b7280;margin:0;">Rekap seluruh transaksi dan order dari akun UMKM.</p>
  </div>

  {{-- Placeholder state --}}
  <div class="panel" style="text-align:center;padding:80px 40px;">
    <div style="width:72px;height:72px;border-radius:20px;background:linear-gradient(135deg,rgba(154,203,3,0.12),rgba(7,87,73,0.1));display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
      <svg style="width:36px;height:36px;color:#9acb03;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
      </svg>
    </div>
    <h2 style="font-size:18px;font-weight:700;color:#111827;margin:0 0 8px;">Riwayat Order</h2>
    <p style="font-size:14px;color:#6b7280;max-width:360px;margin:0 auto 28px;line-height:1.6;">
      Fitur ini sedang dalam pengembangan. Data order dari seluruh akun UMKM akan ditampilkan di sini.
    </p>
    <span style="display:inline-flex;align-items:center;gap:6px;background:#fef9c3;border:1px solid #fde68a;color:#92400e;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:600;">
      <svg style="width:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      Coming Soon
    </span>
  </div>

</div>
@endsection
