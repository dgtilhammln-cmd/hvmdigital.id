@extends('layouts.tenant')
@section('title', 'Dashboard')
@section('page-title', 'Overview')

@section('content')

{{-- Welcome Section --}}
<div class="panel" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
    <div>
        <h2 style="font-size:20px; font-weight:700; color:#111827; margin:0 0 4px;">Selamat datang, {{ Auth::user()->name }}!</h2>
        <p style="font-size:13px; color:#6b7280; margin:0;">Ini adalah pusat kendali untuk bisnis <strong>{!! $tenant->business_name !!}</strong> Anda.</p>
    </div>
</div>

{{-- Check if Pro or Upgrade Needed --}}
@if($tenant->plan !== 'pro')
<div class="dark-panel" style="margin-bottom: 24px; position: relative; overflow: hidden; display: flex; flex-direction: column; md:flex-row; justify-content: space-between; align-items: center; gap: 24px;">
    <div style="position: absolute; right: -80px; top: -80px; width: 250px; height: 250px; background: #9acb03; border-radius: 50%; filter: blur(80px); opacity: 0.15; pointer-events: none;"></div>
    
    <div style="position: relative; z-index: 10;">
        <div style="display: inline-flex; align-items: center; gap: 8px; padding: 4px 12px; border-radius: 20px; background: rgba(255,255,255,0.1); color: #fff; font-size: 11px; font-weight: 700; margin-bottom: 12px; border: 1px solid rgba(255,255,255,0.2);">
            <span style="width: 8px; height: 8px; border-radius: 50%; background: #9acb03; display: inline-block;"></span>
            Tingkatkan Bisnis Anda
        </div>
        <h3 style="font-size:18px; font-weight:700; margin: 0 0 8px;">Dapatkan Domain Kustom (.com / .id)</h3>
        <p style="font-size:13px; color:rgba(255,255,255,0.7); margin:0; max-width: 600px; line-height: 1.5;">
            Tingkatkan kepercayaan pelanggan dengan alamat website profesional. Upgrade sekarang dan dapatkan akses penuh ke tema premium, fitur toko online, dan prioritas dukungan.
        </p>
    </div>
    
    <div style="position: relative; z-index: 10; flex-shrink: 0;">
        <a href="{{ route('tenant.upgrade') }}" class="btn-accent">
            Upgrade Website Sekarang
        </a>
    </div>
</div>
@endif

{{-- Quick Stats --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 24px;">
    
    {{-- Pengunjung --}}
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 12px;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #eff6ff; color: #3b82f6; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <div>
                <p style="font-size:11px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin:0;">Pengunjung Website</p>
                <h4 style="font-size:24px; font-weight:700; color:#111827; margin:4px 0 0;">0</h4>
            </div>
        </div>
        <p style="font-size:12px; color:#9ca3af; margin:0;">Fitur analitik segera hadir.</p>
    </div>

    {{-- Produk --}}
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 12px;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fff7ed; color: #f97316; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div>
                <p style="font-size:11px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin:0;">Total Produk</p>
                <h4 style="font-size:24px; font-weight:700; color:#111827; margin:4px 0 0;">0</h4>
            </div>
        </div>
        <p style="font-size:12px; color:#9ca3af; margin:0;">Kelola produk di menu Manajemen.</p>
    </div>

    {{-- Artikel --}}
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 12px;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <div>
                <p style="font-size:11px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin:0;">Total Artikel</p>
                <h4 style="font-size:24px; font-weight:700; color:#111827; margin:4px 0 0;">0</h4>
            </div>
        </div>
        <p style="font-size:12px; color:#9ca3af; margin:0;">Tulis artikel untuk SEO Anda.</p>
    </div>
</div>

@endsection
