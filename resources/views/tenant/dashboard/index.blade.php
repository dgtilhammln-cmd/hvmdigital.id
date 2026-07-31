@extends('layouts.tenant')
@section('title', 'Dashboard')
@section('page-title', 'Overview')

@section('content')

{{-- Welcome Section --}}
<div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-fg mb-1">Selamat datang, {{ Auth::user()->name }}!</h2>
        <p class="text-muted text-sm">Ini adalah pusat kendali untuk bisnis <strong class="text-[#9acb03]">{!! $tenant->business_name !!}</strong> Anda.</p>
    </div>
    
    <div class="flex items-center gap-3">
        <a href="{{ $tenant->publicUrl() }}" target="_blank" class="px-5 py-2.5 rounded-xl border border-white/10 hover:border-[#9acb03]/50 bg-white/5 hover:bg-white/10 transition-all text-sm font-semibold flex items-center gap-2 text-fg">
            <span>Lihat Website</span>
            <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        </a>
    </div>
</div>

{{-- Check if Pro or Upgrade Needed --}}
@if($tenant->plan !== 'pro')
<div class="mb-8 p-6 rounded-3xl bg-gradient-to-br from-[#075749] to-[#053d33] border border-[#9acb03]/30 shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#9acb03] rounded-full blur-[80px] opacity-30 pointer-events-none"></div>
    
    <div class="relative z-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-bold mb-3 border border-white/20">
            <span class="w-2 h-2 rounded-full bg-[#9acb03] animate-pulse"></span>
            Tingkatkan Bisnis Anda
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Dapatkan Domain Kustom (.com / .id)</h3>
        <p class="text-white/80 text-sm max-w-xl">
            Tingkatkan kepercayaan pelanggan dengan alamat website profesional. Upgrade sekarang dan dapatkan akses penuh ke tema premium, fitur toko online, dan prioritas dukungan.
        </p>
    </div>
    
    <div class="relative z-10 shrink-0 w-full md:w-auto">
        <a href="{{ route('tenant.upgrade') }}" class="block w-full md:w-auto text-center px-8 py-3 rounded-xl font-bold text-[#053d33] shadow-[0_0_20px_rgba(154,203,3,0.4)] hover:shadow-[0_0_30px_rgba(154,203,3,0.6)] hover:scale-105 transition-all duration-300" style="background: #9acb03;">
            Upgrade Website Sekarang
        </a>
    </div>
</div>
@endif

{{-- Quick Stats --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Pengunjung --}}
    <div class="p-6 rounded-3xl bg-white/5 border border-white/5 backdrop-blur-xl hover:border-white/10 transition-colors">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <div>
                <p class="text-xs text-muted font-medium uppercase tracking-wider">Pengunjung Website</p>
                <h4 class="text-2xl font-bold text-fg mt-1">0</h4>
            </div>
        </div>
        <p class="text-xs text-muted">Fitur analitik segera hadir.</p>
    </div>

    {{-- Produk --}}
    <div class="p-6 rounded-3xl bg-white/5 border border-white/5 backdrop-blur-xl hover:border-white/10 transition-colors">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-orange-500/10 text-orange-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div>
                <p class="text-xs text-muted font-medium uppercase tracking-wider">Total Produk</p>
                <h4 class="text-2xl font-bold text-fg mt-1">0</h4>
            </div>
        </div>
        <p class="text-xs text-muted">Kelola produk di menu Manajemen.</p>
    </div>

    {{-- Artikel --}}
    <div class="p-6 rounded-3xl bg-white/5 border border-white/5 backdrop-blur-xl hover:border-white/10 transition-colors">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-[#9acb03]/10 text-[#9acb03] flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <div>
                <p class="text-xs text-muted font-medium uppercase tracking-wider">Total Artikel</p>
                <h4 class="text-2xl font-bold text-fg mt-1">0</h4>
            </div>
        </div>
        <p class="text-xs text-muted">Tulis artikel untuk SEO Anda.</p>
    </div>
</div>

@endsection
