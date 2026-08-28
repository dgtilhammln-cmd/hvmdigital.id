@extends('layouts.app')

@section('title', 'Undian Giveaway Booth HVM Digital - Megpreneur 2026')
@section('meta_description', 'Saksikan live undian Giveaway Booth HVM Digital di Megpreneur 2026. Siapa yang beruntung?')

@push('head')
  <meta property="og:title" content="Megpreneur 2026 — Undian Live by HVM Digital">
  <meta property="og:description"
    content="Event undian UMKM terbesar! Daftarkan usaha Anda dan saksikan putaran roda keberuntungan Megpreneur 2026.">
  <meta property="og:url" content="{{ url('/megpreneur') }}">
  <meta property="og:type" content="website">

  {{-- Canvas Confetti CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>

  <style>
    /* =============================================
     MEGPRENEUR 2026 — MOBILE-FIRST STYLES
     ============================================= */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap');

    * { box-sizing: border-box; }

    .mgp-page {
      background: #061009;
      min-height: 100vh;
      color: #fff;
      font-family: 'Montserrat', sans-serif;
    }

    /* ---- HERO ---- */
    .mgp-hero-section {
      position: relative;
      min-height: 100svh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 100px 20px 60px;
      background:
        radial-gradient(ellipse 120% 60% at 50% -10%, rgba(7,87,73,0.55) 0%, transparent 65%),
        radial-gradient(ellipse 80% 50% at 80% 110%, rgba(154,203,3,0.12) 0%, transparent 60%),
        #061009;
      overflow: hidden;
    }

    .mgp-hero-section::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Ccircle cx='30' cy='30' r='1' fill='%239acb03' fill-opacity='0.04'/%3E%3C/g%3E%3C/svg%3E");
      pointer-events: none;
    }

    .glow-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      pointer-events: none;
      animation: orb-pulse 8s ease-in-out infinite alternate;
    }
    @keyframes orb-pulse {
      from { opacity: 0.25; transform: scale(1); }
      to   { opacity: 0.55; transform: scale(1.15); }
    }

    /* Event badge */
    .event-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(154,203,3,0.1);
      border: 1px solid rgba(154,203,3,0.3);
      border-radius: 50px;
      padding: 5px 16px;
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: #9acb03;
      font-family: 'Montserrat', sans-serif;
    }

    /* Hero title */
    .hero-title {
      font-family: 'Montserrat', sans-serif;
      font-weight: 900;
      line-height: 1.1;
      letter-spacing: -0.01em;
      /* Mobile default */
      font-size: clamp(36px, 10vw, 80px);
    }
    .hero-year {
      font-size: clamp(20px, 6vw, 38px);
      font-weight: 300;
      letter-spacing: 0.18em;
      color: rgba(255,255,255,0.45);
      display: block;
      margin-top: 4px;
    }
    .hero-subtitle {
      font-family: 'Montserrat', sans-serif;
      font-weight: 300;
      font-size: clamp(13px, 3.5vw, 16px);
      color: rgba(255,255,255,0.5);
      line-height: 1.65;
      max-width: 320px;
      margin: 0 auto;
    }
    .hero-subtitle strong {
      font-weight: 600;
      color: #9acb03;
    }

    /* CTA button */
    .cta-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: linear-gradient(135deg, #075749, #9acb03);
      color: #fff;
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      font-size: 14px;
      padding: 14px 28px;
      border-radius: 14px;
      text-decoration: none;
      transition: all 0.3s;
      letter-spacing: 0.02em;
    }
    .cta-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 36px rgba(154,203,3,0.35);
    }

    /* Stats */
    .stat-box {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 14px;
      padding: 16px 12px;
      text-align: center;
    }
    .stat-box .stat-num {
      font-family: 'Montserrat', sans-serif;
      font-size: clamp(22px, 6vw, 32px);
      font-weight: 800;
      color: #9acb03;
      line-height: 1;
    }
    .stat-box .stat-num.white { color: #fff; }
    .stat-box .stat-label {
      font-size: 10px;
      font-weight: 500;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.35);
      margin-top: 5px;
    }

    /* ---- SLOT MACHINE SECTION ---- */
    .slot-section {
      background: radial-gradient(ellipse at center, rgba(7,87,73,0.25) 0%, transparent 70%), rgba(0,0,0,0.4);
      border-top: 1px solid rgba(255,255,255,0.06);
      border-bottom: 1px solid rgba(255,255,255,0.06);
      padding: 60px 20px;
    }

    .slot-machine-wrapper { max-width: 600px; margin: 0 auto; }

    .slot-frame {
      background: linear-gradient(180deg, #0a1a0f 0%, #061009 100%);
      border: 2px solid rgba(154,203,3,0.25);
      border-radius: 24px;
      padding: 24px 20px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 0 60px rgba(154,203,3,0.08), inset 0 1px 0 rgba(255,255,255,0.04);
    }
    .slot-frame::before {
      content: '';
      position: absolute;
      top: -2px; left: -2px; right: -2px;
      height: 3px;
      background: linear-gradient(90deg, transparent, #9acb03, transparent);
      border-radius: 24px 24px 0 0;
    }

    .slot-window {
      height: 180px;
      overflow: hidden;
      position: relative;
      border-radius: 14px;
      background: rgba(0,0,0,0.45);
      border: 1px solid rgba(154,203,3,0.18);
      margin-bottom: 20px;
    }
    .slot-window::before, .slot-window::after {
      content: '';
      position: absolute;
      left: 0; right: 0;
      height: 55px;
      z-index: 2;
      pointer-events: none;
    }
    .slot-window::before { top: 0; background: linear-gradient(to bottom, rgba(6,16,9,1), transparent); }
    .slot-window::after  { bottom: 0; background: linear-gradient(to top, rgba(6,16,9,1), transparent); }

    .slot-highlight {
      position: absolute;
      top: 50%; left: 0; right: 0;
      transform: translateY(-50%);
      height: 52px;
      background: rgba(154,203,3,0.07);
      border-top: 1px solid rgba(154,203,3,0.35);
      border-bottom: 1px solid rgba(154,203,3,0.35);
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
      height: 52px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 16px;
      width: 100%;
      flex-shrink: 0;
    }
    .slot-item-inner {
      font-family: 'Montserrat', sans-serif;
      font-size: clamp(14px, 4vw, 17px);
      font-weight: 700;
      color: #fff;
      letter-spacing: 0.01em;
      display: flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
      overflow: hidden;
      max-width: 100%;
    }
    .slot-item-inner .nomor {
      font-size: 10px;
      font-weight: 600;
      color: rgba(154,203,3,0.7);
      background: rgba(154,203,3,0.1);
      border: 1px solid rgba(154,203,3,0.2);
      border-radius: 20px;
      padding: 2px 7px;
      letter-spacing: 0.06em;
      flex-shrink: 0;
    }

    /* Spin button */
    .spin-btn {
      width: 100%;
      background: linear-gradient(135deg, #075749, #9acb03);
      border: none;
      border-radius: 14px;
      padding: 16px 32px;
      color: #fff;
      font-family: 'Montserrat', sans-serif;
      font-size: 15px;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
      box-shadow: 0 6px 24px rgba(154,203,3,0.25);
    }
    .spin-btn::after {
      content: '';
      position: absolute;
      top: -50%; left: -60%;
      width: 40%; height: 200%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
      transform: skewX(-15deg);
      animation: btn-shimmer 3s ease-in-out infinite;
    }
    @keyframes btn-shimmer { 0% { left: -60%; } 100% { left: 120%; } }
    .spin-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(154,203,3,0.45); }
    .spin-btn:disabled { opacity: 0.45; cursor: not-allowed; transform: none !important; box-shadow: none !important; }
    .spin-btn.spinning {
      background: linear-gradient(135deg, #9acb03, #075749);
      animation: spin-btn-pulse 0.5s ease-in-out infinite alternate;
    }
    @keyframes spin-btn-pulse {
      from { box-shadow: 0 6px 24px rgba(154,203,3,0.25); }
      to   { box-shadow: 0 6px 50px rgba(154,203,3,0.65); }
    }

    /* ---- WINNER OVERLAY ---- */
    #winner-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(6,16,9,0.95);
      z-index: 9999;
      align-items: center;
      justify-content: center;
      padding: 20px;
      backdrop-filter: blur(10px);
    }
    #winner-overlay.show { display: flex; }

    .winner-modal {
      max-width: 480px;
      width: 100%;
      text-align: center;
      animation: modal-in 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
    }
    @keyframes modal-in {
      from { opacity: 0; transform: scale(0.75) translateY(30px); }
      to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .winner-card {
      background: linear-gradient(135deg, rgba(154,203,3,0.08), rgba(7,87,73,0.18));
      border: 2px solid rgba(154,203,3,0.45);
      border-radius: 24px;
      padding: 32px 24px;
      box-shadow: 0 0 80px rgba(154,203,3,0.2);
    }

    /* Waiting state */
    .waiting-state { text-align: center; padding: 40px 20px; }
    .pulse-ring {
      width: 70px; height: 70px;
      border-radius: 50%;
      border: 3px solid rgba(154,203,3,0.35);
      margin: 0 auto 16px;
      animation: ring-pulse 2s ease-in-out infinite;
    }
    @keyframes ring-pulse {
      0%,100% { transform: scale(1); opacity: 0.45; }
      50%      { transform: scale(1.1); opacity: 1; }
    }

    /* Admin controls */
    #admin-trigger-area { display: none; }
    #admin-trigger-area.show { display: block; }

    /* Section heading */
    .section-title {
      font-family: 'Montserrat', sans-serif;
      font-weight: 800;
      font-size: clamp(22px, 6vw, 32px);
      color: #fff;
      letter-spacing: -0.01em;
    }
  </style>
@endpush

@section('content')
  <div class="mgp-page">

    {{-- ======== HERO SECTION ======== --}}
    <section class="mgp-hero-section">
      {{-- Glow orbs --}}
      <div class="glow-orb" style="width:500px;height:500px;background:rgba(7,87,73,0.4);top:-100px;left:-100px;"></div>
      <div class="glow-orb"
        style="width:400px;height:400px;background:rgba(154,203,3,0.15);bottom:-80px;right:-80px;animation-delay:3s;">
      </div>

      <div class="container mx-auto px-5 relative z-10 text-center">

        {{-- Live/Active badge --}}
        @if($isActive && $session->draw_started)
          <div class="event-badge mb-6"
            style="background:rgba(239,68,68,0.12);border-color:rgba(239,68,68,0.35);color:#f87171;">
            <span class="w-2 h-2 bg-red-400 rounded-full" style="animation:orb-pulse 1s ease-in-out infinite alternate;"></span>
            LIVE &middot; UNDIAN BERJALAN
          </div>
        @elseif($isActive)
          <div class="event-badge mb-6">
            <span class="w-2 h-2 bg-[#9acb03] rounded-full" style="animation:orb-pulse 1.5s ease-in-out infinite alternate;"></span>
            GIVEAWAY BOOTH HVM DIGITAL
          </div>
        @endif

        {{-- Mega title --}}
        <h1 class="hero-title mb-2">
          <span style="background:linear-gradient(135deg,#fff 40%,rgba(255,255,255,0.55));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">MEG</span><span style="background:linear-gradient(135deg,#9acb03,#6a9500);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">PRENEUR</span>
        </h1>
        <span class="hero-year">2026</span>

        <p class="hero-subtitle mt-5 mb-8">
          Kunjungi <strong>Booth HVM Digital</strong>, ikuti undian, dan menangkan hadiah spesial!
        </p>

        <a href="{{ route('megpreneur.form') }}" class="cta-btn mb-10" id="cta-daftar">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Daftar Sekarang
        </a>

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-3 max-w-xs mx-auto mt-2">
          <div class="stat-box">
            <div class="stat-num" id="stat-total">{{ $participants->count() }}</div>
            <div class="stat-label">Peserta</div>
          </div>
          <div class="stat-box">
            <div class="stat-num white">1</div>
            <div class="stat-label">Event</div>
          </div>
          <div class="stat-box">
            <div class="stat-num">2026</div>
            <div class="stat-label">Tahun</div>
          </div>
        </div>

      </div>
    </section>

    {{-- SLOT MACHINE SECTION --}}
    @if($isActive)
      <section id="undian" class="slot-section">
        <div class="container mx-auto px-5">
          <div class="text-center mb-10">
            <h2 class="section-title flex items-center justify-center gap-3 mb-2">
              <svg class="w-7 h-7 text-[#9acb03] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Mesin Undian <span style="background:linear-gradient(135deg,#9acb03,#5a7a00);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Live</span>
            </h2>
            <p class="text-white/45 text-sm" id="slot-status-text">
              @if($session->isAnnounced())
                Pemenang telah diumumkan!
              @elseif($session->draw_started)
                Undian sedang berlangsung...
              @else
                Menunggu admin memulai undian...
              @endif
            </p>
          </div>

          <div class="slot-machine-wrapper">
            {{-- Slot machine frame --}}
            <div class="slot-frame">
              <div class="slot-window">
                <div class="slot-highlight"></div>
                <div class="slot-tape" id="slotTape"></div>
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
                  class="bg-[#9acb03] text-black font-black px-8 py-3 rounded-xl hover:bg-[#8ab803] transition-all text-sm flex items-center justify-center gap-2 mx-auto">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                  </svg>
                  REMOTE START - PUTAR SEKARANG
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif

    {{-- Daftar Peserta section dihapus per request --}}

  </div>

  {{-- ======== WINNER OVERLAY ======== --}}
  <div id="winner-overlay" aria-modal="true" role="dialog">
    <div class="winner-modal">
      <div class="winner-card">
        <div class="mb-4 flex justify-center" style="animation:float 2s ease-in-out infinite alternate;">
          <svg class="w-16 h-16 text-yellow-400 drop-shadow-[0_0_15px_rgba(250,204,21,0.5)]" fill="currentColor"
            viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 2.25a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM4.75 5.5a.75.75 0 00-.75.75v1.5c0 .414.336.75.75.75h1.5a.75.75 0 00.75-.75v-1.5a.75.75 0 00-.75-.75h-1.5zm10.5 0a.75.75 0 00-.75.75v1.5c0 .414.336.75.75.75h1.5a.75.75 0 00.75-.75v-1.5a.75.75 0 00-.75-.75h-1.5zM3 10.25a.75.75 0 01.75-.75h12.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75zM10 12.25a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5a.75.75 0 01.75-.75zm-5.5 3a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v1.5a.75.75 0 01-.75.75h-1.5a.75.75 0 01-.75-.75v-1.5zm10.5 0a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v1.5a.75.75 0 01-.75.75h-1.5a.75.75 0 01-.75-.75v-1.5z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <div
          class="inline-flex items-center gap-2 bg-[#9acb03]/20 border border-[#9acb03]/40 rounded-full px-4 py-1.5 mb-5">
          <span class="w-2 h-2 bg-[#9acb03] rounded-full animate-pulse"></span>
          <span class="text-[#9acb03] text-xs font-bold tracking-wider uppercase">Pemenang Resmi Megpreneur 2026</span>
        </div>
        <div id="winners-display" class="space-y-4 mb-8"></div>
        <p class="text-white/40 text-sm">Selamat kepada para pemenang!</p>
        <button onclick="closeWinnerOverlay()"
          class="mt-6 inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white px-8 py-3 rounded-xl text-sm font-medium hover:bg-white/15 transition-all">
          Tutup & Mainkan Lagi
        </button>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    const PARTICIPANTS = @json($participants->values());
    let isSpinning = false;
    let hasSpun = false;
    let pollingInterval = null;
    let animationFrame = null;
    const slotTape = document.getElementById('slotTape');
    const spinBtn = document.getElementById('spinBtn');
    const spinBtnText = document.getElementById('spinBtnText');
    const statusDot = document.getElementById('statusDot');
    const statusLabel = document.getElementById('statusLabel');

    function buildSlotTape(items) {
      const repeated = [];
      for (let i = 0; i < 12; i++) {
        repeated.push(...items);
      }
      slotTape.innerHTML = '';
      repeated.forEach(p => {
        const div = document.createElement('div');
        div.className = 'slot-item';
        div.innerHTML = `<div class="slot-item-inner"><span class="nomor">${p.nomor_peserta}</span><span>${p.nama_usaha}</span></div>`;
        slotTape.appendChild(div);
      });
    }

    if (PARTICIPANTS.length > 0) buildSlotTape(PARTICIPANTS);

    const ITEM_HEIGHT = 56;
    let currentOffset = 0;

    function startSpinAnimation(durationMs, targetIndex, onComplete) {
      const totalItems = slotTape.children.length;
      const maxOffset = totalItems * ITEM_HEIGHT;
      let speed = 40;
      const startTime = performance.now();

      function animate(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / durationMs, 1);
        const easedProgress = 1 - Math.pow(1 - progress, 5);
        speed = 40 * (1 - easedProgress) + 0.5;
        currentOffset = (currentOffset + speed) % maxOffset;

        if (progress > 0.85) {
          const wrappedTarget = (targetIndex * ITEM_HEIGHT) % maxOffset;
          const diff = ((wrappedTarget - currentOffset) + maxOffset) % maxOffset;
          if (diff < speed * 3) currentOffset = wrappedTarget;
        }
        slotTape.style.transform = `translateY(-${currentOffset}px)`;
        if (progress < 1) animationFrame = requestAnimationFrame(animate);
        else {
          currentOffset = (targetIndex * ITEM_HEIGHT) % maxOffset;
          slotTape.style.transform = `translateY(-${currentOffset}px)`;
          onComplete();
        }
      }
      animationFrame = requestAnimationFrame(animate);
    }

    function startSpin() {
      if (isSpinning) return;
      isSpinning = true;
      spinBtn.disabled = true;
      spinBtn.classList.add('spinning');
      spinBtnText.textContent = 'SEDANG BERPUTAR...';
      updateStatus('spinning', 'Mesin sedang berputar...');
      const duration = 8000 + Math.random() * 4000;
      const randomTargetIdx = Math.floor(Math.random() * PARTICIPANTS.length) + PARTICIPANTS.length * 5;

      startSpinAnimation(duration, randomTargetIdx, async function() {
        spinBtnText.textContent = '⚡ Mengambil hasil...';
        try {
          const res = await fetch('{{ route("megpreneur.api.reveal") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
          if (!res.ok) {
            spinBtnText.textContent = '⏳ Menunggu pengumuman...';
            setTimeout(() => pollForAnnouncement(), 2000);
            return;
          }
          const data = await res.json();
          snapToWinner(data.winners, function() {
            hasSpun = true;
            isSpinning = false;
            spinBtn.classList.remove('spinning');
            revealWinners(data.winners);
          });
        } catch (e) {
          isSpinning = false;
          spinBtn.disabled = false;
          spinBtn.classList.remove('spinning');
          spinBtnText.textContent = '🎰 PUTAR ULANG';
          updateStatus('error', 'Terjadi kesalahan.');
        }
      });
    }

    function snapToWinner(winners, callback) {
      if (!winners || winners.length === 0) { callback(); return; }
      const winner = winners[0];
      const tapeItems = Array.from(slotTape.children);
      const midBatch = Math.floor(tapeItems.length / 2);
      let targetItemIndex = -1;
      for (let i = midBatch; i < tapeItems.length; i++) {
        const nomor = tapeItems[i].querySelector('.nomor');
        if (nomor && nomor.textContent.trim() === winner.nomor_peserta) { targetItemIndex = i; break; }
      }
      if (targetItemIndex === -1) { callback(); return; }
      const targetOffset = targetItemIndex * ITEM_HEIGHT;
      const startOffset = currentOffset;
      const startTime = performance.now();
      const snapDuration = 800;

      function snapAnimate(now) {
        const progress = Math.min((now - startTime) / snapDuration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        currentOffset = startOffset + (targetOffset - startOffset) * eased;
        slotTape.style.transform = `translateY(-${currentOffset}px)`;
        if (progress < 1) requestAnimationFrame(snapAnimate);
        else {
          currentOffset = targetOffset;
          slotTape.style.transform = `translateY(-${currentOffset}px)`;
          callback();
        }
      }
      requestAnimationFrame(snapAnimate);
    }

    function pollForAnnouncement() {
      const pollId = setInterval(async () => {
        try {
          const res = await fetch('{{ route("megpreneur.api.reveal") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
          if (res.ok) {
            clearInterval(pollId);
            const data = await res.json();
            snapToWinner(data.winners, function() {
              hasSpun = true;
              isSpinning = false;
              spinBtn.classList.remove('spinning');
              revealWinners(data.winners);
            });
          }
        } catch (e) {}
      }, 2000);
    }

    function revealWinners(winners) {
      updateStatus('done', 'Pemenang telah ditentukan!');
      const display = document.getElementById('winners-display');
      display.innerHTML = '';
      winners.forEach((w, i) => {
        const card = document.getElementById('pcard-' + w.id);
        if (card) card.classList.add('winner-glow');
        const el = document.createElement('div');
        el.className = 'flex items-center justify-center gap-4';
        el.innerHTML = `<div style="background:rgba(154,203,3,0.12);border:2px solid rgba(154,203,3,0.4);border-radius:20px;padding:20px 32px;width:100%;"><p style="color:rgba(154,203,3,0.7);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:4px;">Pemenang ${winners.length > 1 ? (i+1) : ''}</p><p style="color:#fff;font-size:24px;font-weight:900;margin-bottom:4px;">${w.nama_usaha}</p><p style="color:#9acb03;font-size:13px;font-family:monospace;">${w.nomor_peserta}</p></div>`;
        display.appendChild(el);
      });
      setTimeout(() => {
        document.getElementById('winner-overlay').classList.add('show');
        fireConfetti();
      }, 600);
    }

    function closeWinnerOverlay() {
      document.getElementById('winner-overlay').classList.remove('show');
      setTimeout(fireConfetti, 300);
    }

    function fireConfetti() {
      const count = 300;
      function fire(ratio, opts) {
        confetti({ ...opts, particleCount: Math.floor(count * ratio) });
      }
      fire(0.25, { spread: 26, startVelocity: 55, colors: ['#9acb03', '#075749', '#fff'] });
      fire(0.2, { spread: 60, colors: ['#9acb03', '#fbbf24'] });
      fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8, colors: ['#9acb03', '#ffffff', '#075749'] });
    }

    function updateStatus(state, text) {
      statusLabel.textContent = text;
      statusDot.className = 'w-2 h-2 rounded-full';
      if (state === 'waiting') statusDot.classList.add('bg-yellow-400', 'animate-pulse');
      else if (state === 'ready') statusDot.classList.add('bg-[#9acb03]', 'animate-pulse');
      else if (state === 'spinning') statusDot.classList.add('bg-blue-400', 'animate-pulse');
      else if (state === 'done') statusDot.classList.add('bg-[#9acb03]');
      else if (state === 'error') statusDot.classList.add('bg-red-400');
    }

    function startPolling() {
      pollingInterval = setInterval(async () => {
        try {
          const res = await fetch('{{ route("megpreneur.api.status") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
          const data = await res.json();
          document.getElementById('stat-total').textContent = data.total;
          if (data.announced && !isSpinning && (!hasSpun || data.draw_started)) {
            clearInterval(pollingInterval);
            const wRes = await fetch('{{ route("megpreneur.api.reveal") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (wRes.ok) {
              const wData = await wRes.json();
              hasSpun = true;
              revealWinners(wData.winners);
            }
            return;
          }
          if (data.draw_started && !isSpinning) {
            spinBtn.disabled = false;
            spinBtn.classList.remove('spinning');
            spinBtnText.innerHTML = 'PUTAR UNDIAN!';
            updateStatus('ready', 'Admin telah memulai - klik PUTAR!');
            setTimeout(() => { if (!isSpinning) startSpin(); }, 1500);
            clearInterval(pollingInterval);
          }
        } catch (e) {}
      }, 2000);
    }

    spinBtn.addEventListener('click', function() { if (!isSpinning) startSpin(); });

    function checkAdminToken() {
      const params = new URLSearchParams(window.location.search);
      if (params.get('admin_token')) document.getElementById('admin-trigger-area').classList.add('show');
    }
    function adminTriggerSpin() { if (typeof startSpin === 'function') startSpin(); }

    document.addEventListener('DOMContentLoaded', function() {
      checkAdminToken();
      @if($isActive)
        @if($session->isAnnounced())
          fetch('{{ route("megpreneur.api.reveal") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.ok ? r.json() : null)
            .then(data => {
              if (data) {
                hasSpun = true;
                spinBtnText.textContent = 'PEMENANG SUDAH DIUMUMKAN';
                updateStatus('done', 'Undian telah selesai!');
                revealWinners(data.winners);
                startPolling();
              }
            });
        @elseif($session->draw_started)
          spinBtn.disabled = false;
          spinBtnText.innerHTML = 'PUTAR UNDIAN!';
          updateStatus('ready', 'Siap diputar!');
          startPolling();
        @else
          updateStatus('waiting', 'Menunggu admin memulai undian...');
          startPolling();
        @endif
      @endif
    });
    const style = document.createElement('style');
    style.textContent = `@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }`;
    document.head.appendChild(style);
  </script>
@endpush