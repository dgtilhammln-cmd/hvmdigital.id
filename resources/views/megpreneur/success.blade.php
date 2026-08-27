@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil — Megpreneur 2026')
@section('meta_description', 'Pendaftaran Anda untuk Megpreneur 2026 berhasil! Pantau undian di halaman utama Megpreneur.')

@push('head')
<style>
  .success-hero {
    background: linear-gradient(135deg, #061009 0%, #0d2a18 40%, #075749 100%);
    min-height: 100vh;
    padding-top: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  @keyframes checkmark-draw {
    from { stroke-dashoffset: 80; }
    to   { stroke-dashoffset: 0; }
  }
  @keyframes circle-in {
    from { transform: scale(0) rotate(-180deg); opacity: 0; }
    to   { transform: scale(1) rotate(0deg); opacity: 1; }
  }
  @keyframes slide-up {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }
  .check-circle {
    animation: circle-in 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.2s both;
  }
  .check-path {
    stroke-dasharray: 80;
    stroke-dashoffset: 80;
    animation: checkmark-draw 0.5s ease 0.7s forwards;
  }
  .content-anim {
    animation: slide-up 0.6s ease 0.5s both;
  }
  .nomor-badge {
    animation: float 3s ease-in-out infinite;
  }
  .confetti-piece {
    position: absolute;
    width: 8px;
    height: 8px;
    border-radius: 2px;
    animation: confetti-fall 3s ease-in infinite;
    opacity: 0;
  }
  @keyframes confetti-fall {
    0% { transform: translateY(-20px) rotate(0deg); opacity: 1; }
    100% { transform: translateY(120vh) rotate(720deg); opacity: 0; }
  }
</style>
@endpush

@section('content')
<div class="success-hero relative overflow-hidden">
  {{-- Confetti pieces --}}
  @php $colors = ['#9acb03','#075749','#fff','#fbbf24','#f472b6','#60a5fa']; @endphp
  @for($i=0; $i<30; $i++)
  <div class="confetti-piece" style="
    left:{{ rand(0,100) }}%;
    background:{{ $colors[array_rand($colors)] }};
    animation-delay:{{ $i * 0.12 }}s;
    animation-duration:{{ rand(25,45)/10 }}s;
    width:{{ rand(6,12) }}px;
    height:{{ rand(6,12) }}px;
    border-radius:{{ rand(0,1) ? '50%' : '2px' }};
  "></div>
  @endfor

  <div class="relative z-10 w-full max-w-lg mx-auto px-6 py-12 text-center">

    {{-- Check icon --}}
    <div class="mb-8 flex justify-center">
      <div class="check-circle w-28 h-28 bg-gradient-to-br from-[#9acb03] to-[#5a7a00] rounded-full flex items-center justify-center shadow-[0_0_60px_rgba(154,203,3,0.5)]">
        <svg class="w-14 h-14" viewBox="0 0 60 60" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
          <path class="check-path" d="M15 30 L26 41 L45 19"/>
        </svg>
      </div>
    </div>

    <div class="content-anim">
      {{-- Badge nomor peserta --}}
      <div class="nomor-badge inline-block mb-6">
        <div class="bg-[#9acb03]/10 border-2 border-[#9acb03]/40 rounded-2xl px-8 py-4">
          <p class="text-[#9acb03]/70 text-xs font-bold tracking-widest uppercase mb-1">Nomor Peserta Anda</p>
          <p class="text-[#9acb03] text-4xl font-black tracking-wider">{{ session('nomor_peserta') }}</p>
        </div>
      </div>

      <h1 class="text-3xl md:text-4xl font-black text-white mb-3">
        Pendaftaran<br>
        <span class="text-[#9acb03]">Berhasil! 🎉</span>
      </h1>

      <p class="text-white/60 leading-relaxed mb-2">
        Selamat! <strong class="text-white">{{ session('nama_usaha') }}</strong> berhasil terdaftar di event <strong class="text-[#9acb03]">Megpreneur 2026</strong>.
      </p>
      <p class="text-white/50 text-sm leading-relaxed mb-10">
        Simpan nomor peserta Anda dan pantau terus halaman undian untuk mengetahui siapa yang beruntung!
      </p>

      {{-- Info steps --}}
      <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-8 text-left space-y-3">
        <p class="text-white/80 text-sm font-semibold mb-2">Apa selanjutnya?</p>
        <div class="flex items-start gap-3">
          <span class="w-5 h-5 bg-[#9acb03] rounded-full flex items-center justify-center text-xs font-black text-black shrink-0 mt-0.5">1</span>
          <p class="text-white/60 text-sm">Pastikan Anda masih follow <strong class="text-white">@hvmdigital.id</strong> di Instagram & TikTok hingga pengumuman.</p>
        </div>
        <div class="flex items-start gap-3">
          <span class="w-5 h-5 bg-[#9acb03] rounded-full flex items-center justify-center text-xs font-black text-black shrink-0 mt-0.5">2</span>
          <p class="text-white/60 text-sm">Catat nomor peserta <strong class="text-[#9acb03]">{{ session('nomor_peserta') }}</strong> untuk memudahkan identifikasi saat undian.</p>
        </div>
        <div class="flex items-start gap-3">
          <span class="w-5 h-5 bg-[#9acb03] rounded-full flex items-center justify-center text-xs font-black text-black shrink-0 mt-0.5">3</span>
          <p class="text-white/60 text-sm">Pantau halaman undian langsung di bawah ini saat event berlangsung!</p>
        </div>
      </div>

      {{-- CTA Buttons --}}
      <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ route('megpreneur.index') }}"
           class="flex-1 bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-bold py-4 px-6 rounded-2xl flex items-center justify-center gap-2 hover:shadow-[0_8px_30px_rgba(154,203,3,0.4)] transition-all hover:-translate-y-0.5">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
          Tonton Halaman Undian
        </a>
        <a href="{{ route('home') }}"
           class="flex-1 bg-white/10 border border-white/20 text-white font-medium py-4 px-6 rounded-2xl flex items-center justify-center gap-2 hover:bg-white/15 transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
