@extends('layouts.app')

@section('title', 'Megpreneur 2026 — Undian Live | HVM Digital')
@section('meta_description', 'Saksikan live undian Megpreneur 2026 oleh HVM Digital. Ribuan peserta UMKM berkompetisi memenangkan hadiah eksklusif!')

@push('head')
<meta property="og:title" content="Megpreneur 2026 — Undian Live by HVM Digital">
<meta property="og:description" content="Event undian UMKM terbesar! Daftarkan usaha Anda dan saksikan putaran roda keberuntungan Megpreneur 2026.">
<meta property="og:url" content="{{ url('/megpreneur') }}">
<meta property="og:type" content="website">

{{-- Canvas Confetti CDN --}}
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>

<style>
/* =============================================
   MEGPRENEUR 2026 — MAIN STYLES
   ============================================= */
:root {
  --mg-green: #9acb03;
  --mg-dark: #061009;
  --mg-mid:  #0d2a18;
  --mg-teal: #075749;
}

.mgp-page {
  background: var(--mg-dark);
  min-height: 100vh;
  color: #fff;
}

/* Hero Section */
.mgp-hero-section {
  position: relative;
  padding: 120px 0 80px;
  background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(7,87,73,0.6) 0%, transparent 70%),
              radial-gradient(ellipse 60% 40% at 80% 100%, rgba(154,203,3,0.15) 0%, transparent 60%),
              var(--mg-dark);
  overflow: hidden;
}
.mgp-hero-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239acb03' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  pointer-events: none;
}

/* Animated glow orbs */
.glow-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(80px);
  pointer-events: none;
  animation: orb-pulse 8s ease-in-out infinite alternate;
}
@keyframes orb-pulse {
  from { opacity: 0.3; transform: scale(1); }
  to   { opacity: 0.7; transform: scale(1.2); }
}

/* Title badge */
.event-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(154,203,3,0.12);
  border: 1px solid rgba(154,203,3,0.35);
  border-radius: 50px;
  padding: 6px 18px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--mg-green);
}

/* Counter stats */
.stat-box {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 16px;
  padding: 20px 24px;
  text-align: center;
  backdrop-filter: blur(10px);
}

/* Participant cards */
.participant-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 10px;
}
.participant-card {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 14px;
  padding: 14px 16px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: all 0.2s;
}
.participant-card:hover {
  background: rgba(154,203,3,0.07);
  border-color: rgba(154,203,3,0.3);
  transform: translateY(-1px);
}
.participant-card.winner-glow {
  animation: winner-pulse 1s ease-in-out infinite alternate;
  border-color: var(--mg-green) !important;
  background: rgba(154,203,3,0.15) !important;
}
@keyframes winner-pulse {
  from { box-shadow: 0 0 15px rgba(154,203,3,0.3); }
  to   { box-shadow: 0 0 40px rgba(154,203,3,0.7); }
}

/* SLOT MACHINE SECTION */
.slot-section {
  background: radial-gradient(ellipse at center, rgba(7,87,73,0.3) 0%, transparent 70%),
              rgba(0,0,0,0.5);
  border-top: 1px solid rgba(255,255,255,0.06);
  border-bottom: 1px solid rgba(255,255,255,0.06);
  padding: 80px 0;
}

.slot-machine-wrapper {
  max-width: 680px;
  margin: 0 auto;
}

.slot-frame {
  background: linear-gradient(180deg, #0a1a0f 0%, #061009 100%);
  border: 2px solid rgba(154,203,3,0.3);
  border-radius: 28px;
  padding: 32px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 0 80px rgba(154,203,3,0.1), inset 0 1px 0 rgba(255,255,255,0.05);
}
.slot-frame::before {
  content: '';
  position: absolute;
  top: -2px; left: -2px; right: -2px; height: 3px;
  background: linear-gradient(90deg, transparent, #9acb03, transparent);
  border-radius: 28px 28px 0 0;
}

/* Slot window — scrolling names */
.slot-window {
  height: 200px;
  overflow: hidden;
  position: relative;
  border-radius: 16px;
  background: rgba(0,0,0,0.5);
  border: 1px solid rgba(154,203,3,0.2);
  margin-bottom: 28px;
}
.slot-window::before,
.slot-window::after {
  content: '';
  position: absolute;
  left: 0; right: 0;
  height: 60px;
  z-index: 2;
  pointer-events: none;
}
.slot-window::before {
  top: 0;
  background: linear-gradient(to bottom, rgba(6,16,9,1), transparent);
}
.slot-window::after {
  bottom: 0;
  background: linear-gradient(to top, rgba(6,16,9,1), transparent);
}
/* Center highlight line */
.slot-highlight {
  position: absolute;
  top: 50%;
  left: 0; right: 0;
  transform: translateY(-50%);
  height: 56px;
  background: rgba(154,203,3,0.08);
  border-top: 1px solid rgba(154,203,3,0.4);
  border-bottom: 1px solid rgba(154,203,3,0.4);
  z-index: 1;
  pointer-events: none;
}

.slot-tape {
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: transform 0.1s linear;
  will-change: transform;
}
.slot-item {
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 24px;
  white-space: nowrap;
  width: 100%;
  flex-shrink: 0;
}
.slot-item-inner {
  font-size: 18px;
  font-weight: 800;
  color: #fff;
  letter-spacing: 0.02em;
  display: flex;
  align-items: center;
  gap: 10px;
}
.slot-item-inner .nomor {
  font-size: 11px;
  font-weight: 600;
  color: rgba(154,203,3,0.7);
  background: rgba(154,203,3,0.1);
  border: 1px solid rgba(154,203,3,0.2);
  border-radius: 20px;
  padding: 2px 8px;
  letter-spacing: 0.06em;
  flex-shrink: 0;
}

/* Spin button */
.spin-btn {
  width: 100%;
  background: linear-gradient(135deg, #075749, #9acb03);
  border: none;
  border-radius: 18px;
  padding: 20px 40px;
  color: #fff;
  font-size: 18px;
  font-weight: 900;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.3s;
  position: relative;
  overflow: hidden;
  box-shadow: 0 8px 30px rgba(154,203,3,0.3);
}
.spin-btn::after {
  content: '';
  position: absolute;
  top: -50%; left: -60%;
  width: 40%; height: 200%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transform: skewX(-15deg);
  animation: btn-shimmer 3s ease-in-out infinite;
}
@keyframes btn-shimmer {
  0% { left: -60%; }
  100% { left: 120%; }
}
.spin-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 16px 50px rgba(154,203,3,0.5);
}
.spin-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none !important;
  box-shadow: none !important;
}
.spin-btn.spinning {
  background: linear-gradient(135deg, #9acb03, #075749);
  animation: spin-btn-pulse 0.5s ease-in-out infinite alternate;
}
@keyframes spin-btn-pulse {
  from { box-shadow: 0 8px 30px rgba(154,203,3,0.3); }
  to   { box-shadow: 0 8px 60px rgba(154,203,3,0.7); }
}

/* Winner overlay */
#winner-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(6,16,9,0.95);
  z-index: 9999;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(10px);
}
#winner-overlay.show {
  display: flex;
}
.winner-modal {
  max-width: 560px;
  width: 90%;
  text-align: center;
  animation: modal-in 0.5s cubic-bezier(0.175,0.885,0.32,1.275) both;
}
@keyframes modal-in {
  from { opacity: 0; transform: scale(0.7) translateY(40px); }
  to   { opacity: 1; transform: scale(1) translateY(0); }
}
.winner-card {
  background: linear-gradient(135deg, rgba(154,203,3,0.1), rgba(7,87,73,0.2));
  border: 2px solid rgba(154,203,3,0.5);
  border-radius: 28px;
  padding: 40px 36px;
  box-shadow: 0 0 100px rgba(154,203,3,0.25);
}

/* Waiting state */
.waiting-state {
  text-align: center;
  padding: 60px 24px;
}
.pulse-ring {
  width: 80px; height: 80px;
  border-radius: 50%;
  border: 3px solid rgba(154,203,3,0.4);
  margin: 0 auto 20px;
  animation: ring-pulse 2s ease-in-out infinite;
}
@keyframes ring-pulse {
  0%,100% { transform: scale(1); opacity: 0.5; }
  50% { transform: scale(1.1); opacity: 1; }
}

/* Admin controls area (hidden unless token present) */
#admin-trigger-area {
  display: none;
}
#admin-trigger-area.show {
  display: block;
}
</style>
@endpush

@section('content')
<div class="mgp-page">

  {{-- ======== HERO SECTION ======== --}}
  <section class="mgp-hero-section">
    {{-- Glow orbs --}}
    <div class="glow-orb" style="width:500px;height:500px;background:rgba(7,87,73,0.4);top:-100px;left:-100px;"></div>
    <div class="glow-orb" style="width:400px;height:400px;background:rgba(154,203,3,0.15);bottom:-80px;right:-80px;animation-delay:3s;"></div>

    <div class="container mx-auto px-4 relative z-10">
      <div class="text-center mb-16">
        {{-- Live badge --}}
        @if($isActive && $session->draw_started)
        <div class="event-badge mb-6" style="background:rgba(239,68,68,0.15);border-color:rgba(239,68,68,0.4);color:#f87171;">
          <span class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></span>
          LIVE · UNDIAN SEDANG BERJALAN
        </div>
        @elseif($isActive)
        <div class="event-badge mb-6">
          <span class="w-2 h-2 bg-[#9acb03] rounded-full animate-pulse"></span>
          MEGPRENEUR 2026 · UNDIAN AKTIF
        </div>
        @else
        <div class="event-badge mb-6" style="background:rgba(156,163,175,0.1);border-color:rgba(156,163,175,0.2);color:rgba(255,255,255,0.4);">
          <span class="w-2 h-2 bg-white/40 rounded-full"></span>
          MEGPRENEUR 2026 · COMING SOON
        </div>
        @endif

        {{-- Mega title --}}
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black leading-none mb-6">
          <span style="background:linear-gradient(135deg,#fff 30%,rgba(255,255,255,0.6));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">MEG</span><span style="background:linear-gradient(135deg,#9acb03,#5a7a00);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">PRENEUR</span><br>
          <span style="background:linear-gradient(135deg,#fff 30%,rgba(255,255,255,0.5));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-size:0.5em;letter-spacing:0.15em;">2026</span>
        </h1>

        <p class="text-white/60 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed mb-4">
          Event akbar UMKM bersama <strong class="text-[#9acb03]">HVM Digital</strong> — Daftar, Follow, dan Menangkan!
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3 mb-12">
          <a href="{{ route('megpreneur.form') }}"
             class="inline-flex items-center gap-2 bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-bold px-8 py-4 rounded-2xl hover:shadow-[0_12px_40px_rgba(154,203,3,0.4)] transition-all hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Daftar Sekarang
          </a>
          @if($isActive)
          <a href="#undian" class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white font-medium px-8 py-4 rounded-2xl hover:bg-white/15 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            Tonton Undian
          </a>
          @endif
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-xl mx-auto">
          <div class="stat-box">
            <div class="text-3xl font-black text-[#9acb03]" id="stat-total">{{ $participants->count() }}</div>
            <div class="text-white/50 text-xs mt-1 uppercase tracking-wider">Peserta</div>
          </div>
          <div class="stat-box">
            <div class="text-3xl font-black text-white">1</div>
            <div class="text-white/50 text-xs mt-1 uppercase tracking-wider">Event</div>
          </div>
          <div class="stat-box col-span-2 md:col-span-1">
            <div class="text-3xl font-black text-[#9acb03]">2026</div>
            <div class="text-white/50 text-xs mt-1 uppercase tracking-wider">Tahun</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ======== SLOT MACHINE / WHEEL SECTION ======== --}}
  @if($isActive)
  <section id="undian" class="slot-section">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-black text-white mb-3">
          🎰 Mesin Undian
          <span style="background:linear-gradient(135deg,#9acb03,#5a7a00);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Megpreneur</span>
        </h2>
        <p class="text-white/50 text-base" id="slot-status-text">
          @if($session->isAnnounced())
            🏆 Pemenang telah diumumkan!
          @elseif($session->draw_started)
            ⚡ Undian sedang berlangsung...
          @else
            Menunggu admin memulai undian...
          @endif
        </p>
      </div>

      <div class="slot-machine-wrapper">
        {{-- Slot machine frame --}}
        <div class="slot-frame">

          {{-- Title plate --}}
          <div class="flex items-center justify-between mb-6">
            <div>
              <p class="text-[#9acb03] text-xs font-bold tracking-widest uppercase mb-0.5">Megpreneur 2026</p>
              <h3 class="text-white font-black text-xl">UNDIAN KEBERUNTUNGAN</h3>
            </div>
            <div class="w-12 h-12 bg-[#9acb03]/15 rounded-2xl flex items-center justify-center">
              <svg class="w-6 h-6 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
              </svg>
            </div>
          </div>

          {{-- Slot window --}}
          <div class="slot-window">
            <div class="slot-highlight"></div>
            <div class="slot-tape" id="slotTape">
              {{-- Items populated by JS --}}
            </div>
          </div>

          {{-- Spin button --}}
          <button id="spinBtn" class="spin-btn" disabled>
            <span id="spinBtnText">⏳ MENUNGGU ADMIN...</span>
          </button>

          {{-- Status indicator --}}
          <div class="flex items-center justify-center gap-2 mt-5">
            <div id="statusDot" class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></div>
            <span id="statusLabel" class="text-white/40 text-xs">Menunggu undian dimulai</span>
          </div>
        </div>

        {{-- Admin hidden control area --}}
        <div id="admin-trigger-area" class="mt-6">
          <div class="bg-[#9acb03]/10 border border-[#9acb03]/30 rounded-2xl p-5 text-center">
            <p class="text-[#9acb03] text-xs font-bold uppercase tracking-wider mb-3">Panel Admin (Token Aktif)</p>
            <button onclick="adminTriggerSpin()" id="adminTriggerBtn"
                    class="bg-[#9acb03] text-black font-black px-8 py-3 rounded-xl hover:bg-[#8ab803] transition-all text-sm">
              🎰 REMOTE START — PUTAR SEKARANG
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  @else
  {{-- ======== COMING SOON / INACTIVE ======== --}}
  <section class="py-24" style="background:rgba(0,0,0,0.3);">
    <div class="container mx-auto px-4 text-center">
      <div class="w-20 h-20 bg-[#9acb03]/10 rounded-3xl flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-[#9acb03]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
      <h2 class="text-3xl font-black text-white mb-3">Undian Belum Dimulai</h2>
      <p class="text-white/50 max-w-md mx-auto mb-8">Daftarkan usaha Anda terlebih dahulu dan pantau halaman ini saat event berlangsung!</p>
      <a href="{{ route('megpreneur.form') }}"
         class="inline-flex items-center gap-2 bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-bold px-8 py-4 rounded-2xl hover:shadow-[0_12px_40px_rgba(154,203,3,0.4)] transition-all">
        Daftar Sekarang →
      </a>
    </div>
  </section>
  @endif

  {{-- ======== DAFTAR PESERTA SECTION ======== --}}
  @if($participants->count() > 0)
  <section class="py-20" style="background:rgba(0,0,0,0.2);">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between mb-10 flex-wrap gap-4">
        <div>
          <h2 class="text-2xl md:text-3xl font-black text-white mb-1">
            Daftar Peserta
            <span class="text-[#9acb03]">({{ $participants->count() }})</span>
          </h2>
          <p class="text-white/40 text-sm">Semua peserta yang telah mendaftar Megpreneur 2026</p>
        </div>
        <a href="{{ route('megpreneur.form') }}"
           class="inline-flex items-center gap-2 bg-[#9acb03]/15 border border-[#9acb03]/30 text-[#9acb03] font-semibold px-5 py-2.5 rounded-xl text-sm hover:bg-[#9acb03]/25 transition-all">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Daftar
        </a>
      </div>

      <div class="participant-grid" id="participantGrid">
        @foreach($participants as $p)
        <div class="participant-card" id="pcard-{{ $p->id }}" data-id="{{ $p->id }}" data-nama="{{ $p->nama_usaha }}" data-nomor="{{ $p->nomor_peserta }}">
          <div class="w-9 h-9 bg-gradient-to-br from-[#075749]/60 to-[#9acb03]/30 rounded-xl flex items-center justify-center shrink-0 font-bold text-sm text-[#9acb03]">
            {{ strtoupper(substr($p->nama_usaha, 0, 1)) }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-white text-sm font-semibold truncate">{{ $p->nama_usaha }}</p>
            <p class="text-[#9acb03]/70 text-xs font-mono">{{ $p->nomor_peserta }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

</div>

{{-- ======== WINNER OVERLAY ======== --}}
<div id="winner-overlay" aria-modal="true" role="dialog">
  <div class="winner-modal">
    <div class="winner-card">
      {{-- Trophy icon with animation --}}
      <div class="text-7xl mb-4" style="animation:float 2s ease-in-out infinite alternate; display:inline-block;">🏆</div>
      <div class="inline-flex items-center gap-2 bg-[#9acb03]/20 border border-[#9acb03]/40 rounded-full px-4 py-1.5 mb-5">
        <span class="w-2 h-2 bg-[#9acb03] rounded-full animate-pulse"></span>
        <span class="text-[#9acb03] text-xs font-bold tracking-wider uppercase">Pemenang Resmi Megpreneur 2026</span>
      </div>
      <div id="winners-display" class="space-y-4 mb-8"></div>
      <p class="text-white/40 text-sm">Selamat kepada para pemenang! 🎉</p>
      <button onclick="closeWinnerOverlay()"
              class="mt-6 inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white px-8 py-3 rounded-xl text-sm font-medium hover:bg-white/15 transition-all">
        Tutup
      </button>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
// =============================================
// MEGPRENEUR 2026 — SLOT MACHINE ENGINE
// =============================================

// All participants data (safe — no sensitive info)
const PARTICIPANTS = @json($participants->values());

// Current session state (no winner_ids!)
let sessionState = {
  active: {{ $isActive ? 'true' : 'false' }},
  draw_started: {{ $session->draw_started ? 'true' : 'false' }},
  announced: {{ $session->isAnnounced() ? 'true' : 'false' }},
};

// Resolved winners (only after announced)
let resolvedWinners = null;

// Spinning state
let isSpinning = false;
let hasSpun = false;
let pollingInterval = null;
let animationFrame = null;

// DOM refs
const slotTape = document.getElementById('slotTape');
const spinBtn  = document.getElementById('spinBtn');
const spinBtnText = document.getElementById('spinBtnText');
const statusDot = document.getElementById('statusDot');
const statusLabel = document.getElementById('statusLabel');

// =============================================
// BUILD SLOT TAPE
// =============================================
function buildSlotTape(items) {
  // Repeat items many times for infinite scroll illusion
  const repeated = [];
  for (let i = 0; i < 12; i++) {
    repeated.push(...items);
  }

  slotTape.innerHTML = '';
  repeated.forEach(p => {
    const div = document.createElement('div');
    div.className = 'slot-item';
    div.innerHTML = `
      <div class="slot-item-inner">
        <span class="nomor">${p.nomor_peserta}</span>
        <span>${p.nama_usaha}</span>
      </div>`;
    slotTape.appendChild(div);
  });
}

if (PARTICIPANTS.length > 0) {
  buildSlotTape(PARTICIPANTS);
}

// =============================================
// SLOT ANIMATION ENGINE
// =============================================
const ITEM_HEIGHT = 56; // must match CSS .slot-item height
let currentOffset = 0;

function startSpinAnimation(durationMs, targetIndex, onComplete) {
  const totalItems = slotTape.children.length;
  const maxOffset = totalItems * ITEM_HEIGHT;

  // Starting speed: 40px per frame (~2400px/s at 60fps)
  let speed = 40;
  const startTime = performance.now();

  function animate(now) {
    const elapsed = now - startTime;
    const progress = Math.min(elapsed / durationMs, 1);

    // Ease: fast → slow via easeOutQuint
    const easedProgress = 1 - Math.pow(1 - progress, 5);

    // Speed curve: peaks at 40px/frame, decelerates to ~0.5px/frame
    speed = 40 * (1 - easedProgress) + 0.5;

    currentOffset = (currentOffset + speed) % maxOffset;

    // In last 15% of animation, snap to target
    if (progress > 0.85) {
      const wrappedTarget = (targetIndex * ITEM_HEIGHT) % maxOffset;
      const diff = ((wrappedTarget - currentOffset) + maxOffset) % maxOffset;
      if (diff < speed * 3) {
        currentOffset = wrappedTarget;
      }
    }

    slotTape.style.transform = `translateY(-${currentOffset}px)`;

    if (progress < 1) {
      animationFrame = requestAnimationFrame(animate);
    } else {
      // Snap exactly to target
      currentOffset = (targetIndex * ITEM_HEIGHT) % maxOffset;
      slotTape.style.transform = `translateY(-${currentOffset}px)`;
      onComplete();
    }
  }

  animationFrame = requestAnimationFrame(animate);
}

// =============================================
// MAIN SPIN FUNCTION
// =============================================
function startSpin() {
  if (isSpinning || hasSpun) return;
  isSpinning = true;

  spinBtn.disabled = true;
  spinBtn.classList.add('spinning');
  spinBtnText.textContent = '🎰 SEDANG BERPUTAR...';
  updateStatus('spinning', 'Mesin sedang berputar...');

  // Animation duration: 8-12 seconds (random to feel natural)
  const duration = 8000 + Math.random() * 4000;

  // Pick a random visible target index (will be overridden by actual winner at end)
  const randomTargetIdx = Math.floor(Math.random() * PARTICIPANTS.length) + PARTICIPANTS.length * 5;

  startSpinAnimation(duration, randomTargetIdx, async function() {
    // Animation finished — now fetch actual winners from server
    spinBtnText.textContent = '⚡ Mengambil hasil...';

    try {
      const res = await fetch('{{ route("megpreneur.api.reveal") }}', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });

      if (!res.ok) {
        // Admin hasn't announced yet — wait a bit and try again
        spinBtnText.textContent = '⏳ Menunggu pengumuman...';
        setTimeout(() => pollForAnnouncement(), 2000);
        return;
      }

      const data = await res.json();
      resolvedWinners = data.winners;

      // Animate to actual winner (if found in list)
      snapToWinner(resolvedWinners, function() {
        hasSpun = true;
        isSpinning = false;
        spinBtn.classList.remove('spinning');
        revealWinners(resolvedWinners);
      });

    } catch (e) {
      isSpinning = false;
      spinBtn.disabled = false;
      spinBtn.classList.remove('spinning');
      spinBtnText.textContent = '🎰 PUTAR ULANG';
      updateStatus('error', 'Terjadi kesalahan. Coba lagi.');
    }
  });
}

// Snap the slot to the actual winner's name
function snapToWinner(winners, callback) {
  if (!winners || winners.length === 0) { callback(); return; }

  const winner = winners[0]; // snap to first winner
  const tapeItems = Array.from(slotTape.children);
  const midBatch = Math.floor(tapeItems.length / 2);

  // Find winner item in the middle batch
  let targetItemIndex = -1;
  for (let i = midBatch; i < tapeItems.length; i++) {
    const nomor = tapeItems[i].querySelector('.nomor');
    if (nomor && nomor.textContent.trim() === winner.nomor_peserta) {
      targetItemIndex = i;
      break;
    }
  }

  if (targetItemIndex === -1) { callback(); return; }

  // Smooth snap over 0.8 seconds
  const targetOffset = targetItemIndex * ITEM_HEIGHT;
  const startOffset = currentOffset;
  const startTime = performance.now();
  const snapDuration = 800;

  function snapAnimate(now) {
    const progress = Math.min((now - startTime) / snapDuration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    currentOffset = startOffset + (targetOffset - startOffset) * eased;
    slotTape.style.transform = `translateY(-${currentOffset}px)`;

    if (progress < 1) {
      requestAnimationFrame(snapAnimate);
    } else {
      currentOffset = targetOffset;
      slotTape.style.transform = `translateY(-${currentOffset}px)`;
      callback();
    }
  }

  requestAnimationFrame(snapAnimate);
}

// Poll until admin announces
function pollForAnnouncement() {
  const pollId = setInterval(async () => {
    try {
      const res = await fetch('{{ route("megpreneur.api.reveal") }}', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      if (res.ok) {
        clearInterval(pollId);
        const data = await res.json();
        resolvedWinners = data.winners;
        snapToWinner(resolvedWinners, function() {
          hasSpun = true;
          isSpinning = false;
          spinBtn.classList.remove('spinning');
          revealWinners(resolvedWinners);
        });
      }
    } catch (e) {}
  }, 2000);
}

// =============================================
// REVEAL WINNERS — Overlay + Confetti
// =============================================
function revealWinners(winners) {
  updateStatus('done', '🏆 Pemenang telah ditentukan!');

  // Build winner display
  const display = document.getElementById('winners-display');
  display.innerHTML = '';

  winners.forEach((w, i) => {
    // Highlight winner card in participant grid
    const card = document.getElementById('pcard-' + w.id);
    if (card) card.classList.add('winner-glow');

    const el = document.createElement('div');
    el.className = 'flex items-center justify-center gap-4';
    el.innerHTML = `
      <div style="background:rgba(154,203,3,0.12);border:2px solid rgba(154,203,3,0.4);border-radius:20px;padding:20px 32px;width:100%;">
        <p style="color:rgba(154,203,3,0.7);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:4px;">
          Pemenang ${winners.length > 1 ? (i+1) : ''} 🏆
        </p>
        <p style="color:#fff;font-size:24px;font-weight:900;margin-bottom:4px;">${w.nama_usaha}</p>
        <p style="color:#9acb03;font-size:13px;font-family:monospace;">${w.nomor_peserta}</p>
      </div>`;
    display.appendChild(el);
  });

  // Show overlay with delay for dramatic effect
  setTimeout(() => {
    document.getElementById('winner-overlay').classList.add('show');
    fireConfetti();
  }, 600);
}

function closeWinnerOverlay() {
  document.getElementById('winner-overlay').classList.remove('show');
  // Fire smaller confetti on close
  setTimeout(fireConfetti, 300);
}

function fireConfetti() {
  const count = 300;
  const defaults = { origin: { y: 0.5 } };

  function fire(particleRatio, opts) {
    confetti({ ...defaults, ...opts,
      particleCount: Math.floor(count * particleRatio)
    });
  }

  fire(0.25, { spread: 26, startVelocity: 55, colors: ['#9acb03','#075749','#fff'] });
  fire(0.2,  { spread: 60, colors: ['#9acb03','#fbbf24'] });
  fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8, colors: ['#9acb03','#ffffff','#075749'] });
  fire(0.1,  { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
  fire(0.1,  { spread: 120, startVelocity: 45 });
}

// =============================================
// STATUS UPDATES
// =============================================
function updateStatus(state, text) {
  statusLabel.textContent = text;
  statusDot.className = 'w-2 h-2 rounded-full';
  if (state === 'waiting')  { statusDot.classList.add('bg-yellow-400','animate-pulse'); }
  if (state === 'ready')    { statusDot.classList.add('bg-[#9acb03]','animate-pulse'); }
  if (state === 'spinning') { statusDot.classList.add('bg-blue-400','animate-pulse'); }
  if (state === 'done')     { statusDot.classList.add('bg-[#9acb03]'); }
  if (state === 'error')    { statusDot.classList.add('bg-red-400'); }
}

// =============================================
// POLLING — SYNC WITH ADMIN ACTIONS
// =============================================
function startPolling() {
  pollingInterval = setInterval(async () => {
    if (hasSpun) { clearInterval(pollingInterval); return; }

    try {
      const res = await fetch('{{ route("megpreneur.api.status") }}', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const data = await res.json();

      // Update participant count
      document.getElementById('stat-total').textContent = data.total;

      // If announced and spin already happened
      if (data.announced && hasSpun) {
        clearInterval(pollingInterval);
        return;
      }

      // If already announced but we haven't shown winners
      if (data.announced && !hasSpun && !isSpinning) {
        clearInterval(pollingInterval);
        // Fetch winners directly
        const wRes = await fetch('{{ route("megpreneur.api.reveal") }}', {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        if (wRes.ok) {
          const wData = await wRes.json();
          hasSpun = true;
          revealWinners(wData.winners);
        }
        return;
      }

      // Admin triggered draw — enable spin!
      if (data.draw_started && !isSpinning && !hasSpun) {
        spinBtn.disabled = false;
        spinBtn.classList.remove('spinning');
        spinBtnText.innerHTML = '🎰 PUTAR UNDIAN!';
        updateStatus('ready', '⚡ Admin telah memulai — klik PUTAR!');

        // Auto-trigger after 1.5 seconds for seamless UX
        setTimeout(() => {
          if (!isSpinning && !hasSpun) startSpin();
        }, 1500);

        clearInterval(pollingInterval);
      }
    } catch (e) {}
  }, 2000);
}

// =============================================
// SPIN BUTTON CLICK
// =============================================
spinBtn.addEventListener('click', function() {
  if (!isSpinning && !hasSpun) startSpin();
});

// =============================================
// ADMIN REMOTE TRIGGER (hidden, token-based)
// =============================================
function checkAdminToken() {
  const params = new URLSearchParams(window.location.search);
  const token = params.get('admin_token');
  if (token) {
    // Verify token against session (simple check)
    const adminArea = document.getElementById('admin-trigger-area');
    if (adminArea) adminArea.classList.add('show');
  }
}

function adminTriggerSpin() {
  if (typeof startSpin === 'function') startSpin();
}

// =============================================
// INIT
// =============================================
document.addEventListener('DOMContentLoaded', function() {
  checkAdminToken();

  @if($isActive)
  // If already announced on page load, show winners immediately
  @if($session->isAnnounced())
    fetch('{{ route("megpreneur.api.reveal") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(r => r.ok ? r.json() : null)
      .then(data => {
        if (data) {
          hasSpun = true;
          spinBtnText.textContent = '🏆 PEMENANG SUDAH DIUMUMKAN';
          updateStatus('done', '🏆 Undian telah selesai!');
          revealWinners(data.winners);
        }
      });
  @elseif($session->draw_started)
    spinBtn.disabled = false;
    spinBtnText.innerHTML = '🎰 PUTAR UNDIAN!';
    updateStatus('ready', '⚡ Siap diputar!');
    startPolling();
  @else
    updateStatus('waiting', 'Menunggu admin memulai undian...');
    startPolling();
  @endif
  @endif
});

// Float animation for trophy
const style = document.createElement('style');
style.textContent = `@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }`;
document.head.appendChild(style);
</script>
@endpush
