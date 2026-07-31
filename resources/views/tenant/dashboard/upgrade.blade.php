@extends('layouts.tenant')
@section('title', 'Upgrade Website')
@section('page-title', 'Upgrade Website')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .upgrade-page, .upgrade-page * { font-family: 'Montserrat', sans-serif !important; }
    .upgrade-search-bar {
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 16px 20px;
        font-size: 16px;
        font-weight: 300;
        width: 100%;
        outline: none;
        transition: all 0.25s;
        box-sizing: border-box;
        color: #111827;
        letter-spacing: 0.3px;
    }
    .upgrade-search-bar:focus { border-color: #075749; box-shadow: 0 0 0 4px rgba(7,87,73,0.08); }
    .upgrade-search-bar::placeholder { color: #d1d5db; font-weight: 300; }

    .domain-card-main {
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 24px 28px;
        background: #fff;
        transition: all 0.25s;
    }
    .domain-card-main.available { border-color: #9acb03; background: linear-gradient(135deg,#f9ffe0 0%,#ffffff 60%); }
    .domain-card-main.taken { border-color: #fca5a5; background: #fff; }

    .domain-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        border-bottom: 1px solid #f5f5f5;
        transition: background 0.15s;
        gap: 12px;
    }
    .domain-row:last-child { border-bottom: none; }
    .domain-row:hover { background: #fafafa; }

    .chip-filter {
        padding: 5px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #6b7280;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 0.2px;
    }
    .chip-filter.active { background: #075749; color: #fff; border-color: #075749; }

    .btn-pilih {
        padding: 9px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        border: 2px solid #075749;
        color: #075749;
        background: #fff;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
        white-space: nowrap;
    }
    .btn-pilih:hover { background: #075749; color: #fff; }

    .btn-pilih-main {
        padding: 13px 28px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        background: #9acb03;
        color: #0d1f15;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
        white-space: nowrap;
        letter-spacing: 0.3px;
    }
    .btn-pilih-main:hover { transform: scale(1.03); box-shadow: 0 4px 16px rgba(154,203,3,0.35); }

    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes shimmer {
        0% { background-position: -600px 0; }
        100% { background-position: 600px 0; }
    }
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
        background-size: 600px 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 8px;
    }
    .badge-available { padding:3px 12px;border-radius:20px;font-size:10px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;background:#dcfce7;color:#15803d; }
    .badge-taken { padding:3px 12px;border-radius:20px;font-size:10px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;background:#fee2e2;color:#dc2626; }
    .badge-popular { padding:2px 10px;border-radius:20px;font-size:10px;font-weight:700;background:#f0fdf4;color:#15803d; }
    .badge-cheap { padding:2px 10px;border-radius:20px;font-size:10px;font-weight:700;background:#fef9c3;color:#854d0e; }
    .price-strike { font-size:11px;color:#d1d5db;text-decoration:line-through;font-weight:400; }
    .price-main { font-size:18px;font-weight:800;color:#111827; }
    .price-main-big { font-size:22px;font-weight:800;color:#075749; }
</style>
@endpush

@section('content')

<div x-data="upgradeWizard()" class="upgrade-page">

    {{-- ===================== STEP HEADER ===================== --}}
    <div style="display:flex;align-items:center;gap:0;margin-bottom:36px;max-width:480px;">
        <template x-for="(s, i) in steps" :key="i">
            <div style="display:flex;align-items:center;flex:1;">
                <div style="display:flex;flex-direction:column;align-items:center;gap:6px;flex-shrink:0;">
                    <div style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;transition:all 0.3s;"
                         :style="step > i+1 ? 'background:#9acb03;color:#0d1f15;' : step===i+1 ? 'background:#075749;color:#fff;' : 'background:#f3f4f6;color:#c0c0c0;'">
                        <svg x-show="step > i+1" style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span x-show="step <= i+1" x-text="i+1"></span>
                    </div>
                    <span style="font-size:11px;font-weight:500;letter-spacing:0.2px;white-space:nowrap;"
                          :style="step >= i+1 ? 'color:#111827;' : 'color:#c0c0c0;'" x-text="s"></span>
                </div>
                <div x-show="i < steps.length-1" style="flex:1;height:1.5px;margin-bottom:18px;"
                     :style="step > i+1 ? 'background:#9acb03;' : 'background:#e5e7eb;'"></div>
            </div>
        </template>
    </div>

    {{-- ===================== STEP 1: DOMAIN SEARCH ===================== --}}
    <div x-show="step === 1">

        {{-- Search Section --}}
        <div style="text-align:center;margin-bottom:32px;">
            <h1 style="font-size:30px;font-weight:800;color:#111827;margin:0 0 8px;letter-spacing:-0.5px;">Cari nama domain</h1>
            <p style="font-size:14px;font-weight:300;color:#6b7280;margin:0 0 24px;">Masukkan nama usaha Anda dan kami tampilkan ketersediaan domain terbaik beserta harganya.</p>

            <div style="display:flex;gap:10px;max-width:640px;margin:0 auto;">
                <div style="position:relative;flex:1;">
                    <svg style="position:absolute;left:16px;top:50%;transform:translateY(-50%);width:18px;height:18px;color:#9ca3af;pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" x-model="domainQuery" @keydown.enter="checkDomain"
                           class="upgrade-search-bar"
                           style="padding-left:48px;"
                           placeholder="Contoh: kedaikopi atau tokobaju.com">
                </div>
                <button @click="checkDomain" :disabled="loading"
                        style="padding:0 24px;border-radius:16px;font-size:14px;font-weight:600;background:#075749;color:#fff;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;transition:all 0.2s;white-space:nowrap;flex-shrink:0;font-family:'Montserrat',sans-serif;"
                        :style="loading ? 'opacity:0.8' : ''"
                        @mouseover="if(!loading)$el.style.background='#053d33'" @mouseout="$el.style.background='#075749'">
                    <template x-if="!loading">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </template>
                    <template x-if="loading">
                        <svg style="width:16px;height:16px;animation:spin 1s linear infinite;" fill="none" viewBox="0 0 24 24"><circle style="opacity:.3" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    </template>
                    <span x-text="loading ? 'Mencari...' : 'Cari'"></span>
                </button>
            </div>
        </div>

        {{-- Empty State --}}
        <div x-show="!hasSearched && !loading" style="text-align:center;padding:40px 20px;">
            <div style="width:80px;height:80px;border-radius:24px;background:linear-gradient(135deg,#0d1f15,#075749);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <svg style="width:40px;height:40px;color:#9acb03;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
            </div>
            <p style="font-size:14px;font-weight:300;color:#9ca3af;margin:0 0 16px;">Coba cari dengan contoh ini:</p>
            <div style="display:flex;flex-wrap:wrap;gap:10px;justify-content:center;">
                <template x-for="eg in ['kedaikopi', 'salonwangi', 'tokokue', 'bengkelonline', 'rumahbunga']" :key="eg">
                    <button @click="domainQuery = eg; checkDomain()"
                            style="padding:7px 18px;border:1.5px solid #e5e7eb;border-radius:20px;font-size:13px;color:#374151;background:#fff;cursor:pointer;font-family:'Montserrat',sans-serif;font-weight:400;transition:all 0.2s;"
                            @mouseover="$el.style.borderColor='#075749';$el.style.color='#075749'"
                            @mouseout="$el.style.borderColor='#e5e7eb';$el.style.color='#374151'"
                            x-text="eg + '.com'"></button>
                </template>
            </div>
        </div>

        {{-- Skeleton Loading --}}
        <div x-show="loading" style="max-width:800px;margin:0 auto;">
            <div style="border:2px solid #f0f0f0;border-radius:16px;padding:24px 28px;margin-bottom:16px;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <div>
                        <div class="skeleton" style="width:200px;height:20px;margin-bottom:10px;"></div>
                        <div class="skeleton" style="width:280px;height:14px;"></div>
                    </div>
                    <div style="display:flex;gap:12px;align-items:center;">
                        <div class="skeleton" style="width:100px;height:24px;"></div>
                        <div class="skeleton" style="width:100px;height:44px;border-radius:12px;"></div>
                    </div>
                </div>
            </div>
            <div style="background:#fff;border-radius:16px;border:1.5px solid #f0f0f0;overflow:hidden;">
                <div style="padding:20px 24px;border-bottom:1px solid #f5f5f5;"><div class="skeleton" style="width:180px;height:16px;"></div></div>
                <template x-for="i in 5" :key="i">
                    <div class="domain-row">
                        <div class="skeleton" style="width:220px;height:16px;"></div>
                        <div style="display:flex;gap:12px;align-items:center;">
                            <div class="skeleton" style="width:90px;height:16px;"></div>
                            <div class="skeleton" style="width:70px;height:36px;border-radius:10px;"></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Results --}}
        <div x-show="hasSearched && !loading" style="max-width:800px;margin:0 auto;">

            {{-- Primary Result --}}
            <template x-if="primaryResult">
                <div class="domain-card-main" :class="primaryResult.available ? 'available' : 'taken'" style="margin-bottom:20px;">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;">
                        <span :class="primaryResult.available ? 'badge-available' : 'badge-taken'"
                              x-text="primaryResult.available ? '✓ Sesuai Permintaan' : '✗ Tidak Tersedia'"></span>
                        <span x-show="!primaryResult.available" style="font-size:12px;font-weight:300;color:#9ca3af;">— cek alternatif di bawah</span>
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
                        <div style="flex:1;">
                            <div style="font-size:24px;font-weight:800;color:#111827;letter-spacing:-0.5px;margin-bottom:8px;" x-text="primaryResult.domain"></div>
                            <div x-show="primaryResult.available" style="display:flex;flex-direction:column;gap:5px;">
                                <span style="font-size:12px;font-weight:300;color:#6b7280;display:flex;align-items:center;gap:6px;">
                                    <svg style="width:14px;height:14px;color:#9acb03;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Domain profesional untuk bisnis Anda
                                </span>
                                <span style="font-size:12px;font-weight:300;color:#6b7280;display:flex;align-items:center;gap:6px;">
                                    <svg style="width:14px;height:14px;color:#9acb03;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Tingkatkan kepercayaan pelanggan Anda
                                </span>
                            </div>
                        </div>

                        <div x-show="primaryResult.available" style="display:flex;align-items:center;gap:20px;flex-shrink:0;">
                            <div style="text-align:right;">
                                <div class="price-strike" x-text="'Rp ' + Math.round(primaryResult.price.base * 2.5).toLocaleString('id-ID') + ' /Tahun ke-1'"></div>
                                <div class="price-main-big" x-text="primaryResult.price.total_formatted"></div>
                                <div style="font-size:11px;font-weight:300;color:#9ca3af;">incl. PPN 11%</div>
                            </div>
                            <button class="btn-pilih-main" @click="selectAndProceed(primaryResult)">
                                Pilih Domain
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Other TLDs Section --}}
            <div x-show="otherResults.length > 0" style="background:#fff;border-radius:16px;border:1.5px solid #e5e7eb;overflow:hidden;">
                <div style="padding:20px 24px 14px;border-bottom:1px solid #f0f0f0;">
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:14px;">
                        <h4 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Pilihan domain lainnya</h4>
                        <span style="font-size:12px;font-weight:300;color:#9ca3af;" x-text="filteredResults.length + ' domain ditemukan'"></span>
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        <template x-for="cat in ['Semua', 'Tersedia', 'Populer', 'Hemat']" :key="cat">
                            <button class="chip-filter" :class="activeFilter === cat ? 'active' : ''" @click="activeFilter = cat" x-text="cat"></button>
                        </template>
                    </div>
                </div>

                <div>
                    <template x-for="(result, idx) in filteredResults" :key="idx">
                        <div class="domain-row">
                            <div style="display:flex;align-items:center;gap:10px;flex:1;">
                                <span style="font-size:15px;font-weight:600;color:#111827;letter-spacing:-0.2px;" x-text="result.domain"></span>
                                <span x-show="['com','id'].includes(result.tld)" class="badge-popular">Populer</span>
                                <span x-show="result.tld === 'my.id'" class="badge-cheap">Hemat</span>
                            </div>

                            <div x-show="result.available" style="display:flex;align-items:center;gap:16px;flex-shrink:0;">
                                <div style="text-align:right;">
                                    <div class="price-strike" x-text="'Rp ' + Math.round(result.price.base * 2.5).toLocaleString('id-ID') + ' /Tahun'"></div>
                                    <div class="price-main" x-text="result.price.total_formatted"></div>
                                </div>
                                <button class="btn-pilih" @click="selectAndProceed(result)">Pilih</button>
                            </div>

                            <div x-show="!result.available" style="flex-shrink:0;">
                                <span class="badge-taken">Tidak Tersedia</span>
                            </div>
                        </div>
                    </template>

                    <div x-show="filteredResults.length === 0" style="text-align:center;padding:32px;font-size:13px;font-weight:300;color:#9ca3af;">
                        Tidak ada domain yang sesuai dengan filter ini.
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ===================== STEP 2: LAYANAN TAMBAHAN ===================== --}}
    <div x-show="step === 2" style="display:none;">

        {{-- Domain Chosen Banner --}}
        <div style="display:flex;align-items:center;gap:14px;background:#f0fdf4;border:1.5px solid #9acb03;border-radius:14px;padding:18px 22px;margin-bottom:24px;max-width:800px;margin-left:auto;margin-right:auto;">
            <div style="width:42px;height:42px;background:#9acb03;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg style="width:22px;height:22px;color:#0d1f15;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div style="flex:1;">
                <div style="font-size:11px;font-weight:700;color:#15803d;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:2px;">Domain Dipilih</div>
                <div style="font-size:18px;font-weight:800;color:#111827;" x-text="selectedDomain?.domain"></div>
            </div>
            <div style="text-align:right;flex-shrink:0;">
                <div style="font-size:22px;font-weight:800;color:#075749;" x-text="selectedDomain?.price.total_formatted"></div>
                <div style="font-size:11px;font-weight:300;color:#9ca3af;">/ tahun</div>
            </div>
        </div>

        <div style="max-width:800px;margin:0 auto;">
            <div style="text-align:center;margin-bottom:28px;">
                <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0 0 8px;letter-spacing:-0.3px;">Lengkapi website Anda</h2>
                <p style="font-size:13px;font-weight:300;color:#6b7280;margin:0;">Pilih layanan tambahan yang Anda butuhkan. Semuanya opsional — bisa dilewati.</p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:14px;margin-bottom:28px;">
                <template x-for="feature in availableFeatures" :key="feature.id">
                    <div style="border-radius:14px;border:2px solid;cursor:pointer;padding:20px;transition:all 0.2s;"
                         :style="selectedFeatures.includes(feature.id) ? 'border-color:#9acb03;background:#f9ffe0;' : 'border-color:#e5e7eb;background:#fff;'"
                         @click="toggleFeature(feature.id)">
                        <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:12px;">
                            <span style="font-size:30px;" x-text="feature.icon"></span>
                            <div style="width:22px;height:22px;border-radius:6px;border:2px solid;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s;"
                                 :style="selectedFeatures.includes(feature.id) ? 'background:#9acb03;border-color:#9acb03;' : 'border-color:#d1d5db;'">
                                <svg x-show="selectedFeatures.includes(feature.id)" style="width:13px;height:13px;" fill="none" stroke="#0d1f15" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <div style="font-size:13px;font-weight:700;color:#111827;margin-bottom:6px;" x-text="feature.name"></div>
                        <div style="font-size:12px;font-weight:300;color:#6b7280;margin-bottom:12px;line-height:1.6;" x-text="feature.desc"></div>
                        <div style="font-size:14px;font-weight:700;color:#075749;" x-text="'+ Rp ' + feature.price.toLocaleString('id-ID')"></div>
                    </div>
                </template>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;">
                <button @click="step--" style="display:flex;align-items:center;gap:6px;padding:10px 20px;border-radius:10px;border:1.5px solid #e5e7eb;color:#374151;background:#fff;font-size:13px;font-weight:500;cursor:pointer;font-family:'Montserrat',sans-serif;transition:all 0.2s;" @mouseover="$el.style.borderColor='#075749'" @mouseout="$el.style.borderColor='#e5e7eb'">
                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                </button>
                <button @click="step++" style="display:flex;align-items:center;gap:8px;padding:12px 28px;border-radius:12px;background:#075749;color:#fff;border:none;font-size:14px;font-weight:600;cursor:pointer;font-family:'Montserrat',sans-serif;transition:background 0.2s;" @mouseover="$el.style.background='#053d33'" @mouseout="$el.style.background='#075749'">
                    Lanjutkan ke Pembayaran
                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ===================== STEP 3: PEMBAYARAN ===================== --}}
    <div x-show="step === 3" style="display:none;">
        <div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;max-width:900px;margin:0 auto;">

            {{-- Order Summary --}}
            <div style="background:#fff;border-radius:16px;border:1.5px solid #e5e7eb;padding:28px;">
                <h2 style="font-size:18px;font-weight:800;color:#111827;margin:0 0 20px;">Ringkasan Pesanan</h2>

                <div style="background:linear-gradient(135deg,#0d1f15,#075749);border-radius:12px;padding:20px 22px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <div style="font-size:11px;color:rgba(255,255,255,0.5);font-weight:500;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Domain</div>
                            <div style="font-size:18px;font-weight:800;color:#fff;" x-text="selectedDomain?.domain"></div>
                            <div style="font-size:11px;color:rgba(255,255,255,0.4);font-weight:300;margin-top:4px;">Perpanjangan 1 Tahun • incl. PPN 11%</div>
                        </div>
                        <div style="font-size:18px;font-weight:800;color:#9acb03;" x-text="selectedDomain?.price.total_formatted"></div>
                    </div>
                </div>

                <template x-if="selectedFeatures.length > 0">
                    <div style="margin-bottom:16px;">
                        <div style="font-size:11px;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:10px;">Layanan Tambahan</div>
                        <template x-for="featId in selectedFeatures" :key="featId">
                            <div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f5f5f5;font-size:13px;font-weight:400;">
                                <span style="color:#374151;display:flex;align-items:center;gap:8px;">
                                    <span x-text="getFeature(featId).icon"></span>
                                    <span x-text="getFeature(featId).name"></span>
                                </span>
                                <span style="color:#111827;font-weight:700;" x-text="'Rp ' + getFeature(featId).price.toLocaleString('id-ID')"></span>
                            </div>
                        </template>
                    </div>
                </template>

                <div style="padding-top:16px;border-top:2px dashed #e5e7eb;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13px;font-weight:600;color:#374151;">Total Pembayaran</span>
                    <span style="font-size:26px;font-weight:800;color:#075749;" x-text="'Rp ' + calculateTotal().toLocaleString('id-ID')"></span>
                </div>

                <button @click="step--" style="width:100%;margin-top:16px;display:flex;align-items:center;justify-content:center;gap:6px;padding:10px;border-radius:10px;border:1.5px solid #e5e7eb;color:#6b7280;background:#fff;font-size:13px;font-weight:400;cursor:pointer;font-family:'Montserrat',sans-serif;">
                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Ubah Pilihan
                </button>
            </div>

            {{-- Payment Box --}}
            <div style="background:#fff;border-radius:16px;border:1.5px solid #e5e7eb;padding:24px;position:sticky;top:80px;">
                <div style="width:52px;height:52px;background:linear-gradient(135deg,#0d1f15,#075749);border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <svg style="width:26px;height:26px;color:#9acb03;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div style="font-size:16px;font-weight:700;color:#111827;margin-bottom:6px;">Pembayaran Aman</div>
                <p style="font-size:12px;font-weight:300;color:#6b7280;line-height:1.6;margin:0 0 18px;">Transaksi diproses via Midtrans dengan enkripsi SSL 256-bit. Aman dan terpercaya.</p>

                <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:20px;">
                    <template x-for="m in ['VISA','Mastercard','Transfer Bank','QRIS','GoPay','OVO','Dana']" :key="m">
                        <span style="padding:3px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:11px;font-weight:500;color:#374151;" x-text="m"></span>
                    </template>
                </div>

                <button @click="submitOrder" class="btn-pilih-main" style="width:100%;padding:14px;font-size:15px;border-radius:12px;display:flex;align-items:center;justify-content:center;gap:8px;">
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Bayar Sekarang
                </button>

                <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-top:14px;">
                    <svg style="width:13px;height:13px;color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span style="font-size:11px;font-weight:300;color:#9ca3af;">Aman dengan SSL Encryption</span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('upgradeWizard', () => ({
        step: 1,
        steps: ['Pilih Domain', 'Layanan Tambahan', 'Pembayaran'],
        loading: false,
        hasSearched: false,
        domainQuery: '',
        domainResults: [],
        selectedDomain: null,
        activeFilter: 'Semua',

        availableFeatures: [
            { id: 'premium_theme', icon: '🎨', name: 'Tema Premium', desc: 'Desain profesional dengan animasi halus dan tampilan mewah yang menarik pelanggan.', price: 250000 },
            { id: 'seo_copy', icon: '✍️', name: 'Copywriting + SEO', desc: 'Teks halaman yang menarik perhatian dan dioptimasi agar mudah ditemukan di Google.', price: 150000 },
            { id: 'custom_logo', icon: '🖼️', name: 'Desain Logo', desc: '2 opsi logo eksklusif dari desainer profesional kami untuk identitas merek Anda.', price: 100000 },
            { id: 'ecommerce', icon: '🛒', name: 'Katalog Produk', desc: 'Galeri produk tak terbatas dengan tombol pesan via WhatsApp yang mudah digunakan.', price: 300000 },
        ],
        selectedFeatures: [],

        get primaryResult() { return this.domainResults[0] ?? null; },
        get otherResults() { return this.domainResults.slice(1); },
        get filteredResults() {
            if(this.activeFilter === 'Tersedia') return this.otherResults.filter(r => r.available);
            if(this.activeFilter === 'Populer') return this.otherResults.filter(r => ['com','id'].includes(r.tld));
            if(this.activeFilter === 'Hemat') return this.otherResults.filter(r => ['my.id','biz.id'].includes(r.tld));
            return this.otherResults;
        },

        async checkDomain() {
            if(this.domainQuery.trim().length < 2) return;
            this.loading = true;
            this.hasSearched = true;
            this.domainResults = [];
            this.selectedDomain = null;

            try {
                const res = await fetch('{{ route("tenant.upgrade.check") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ query: this.domainQuery.trim() })
                });
                const data = await res.json();
                if(data.success) this.domainResults = data.results;
            } catch(e) {
                alert('Gagal memeriksa domain. Silakan coba lagi.');
            } finally {
                this.loading = false;
            }
        },

        selectAndProceed(result) {
            this.selectedDomain = result;
            this.step = 2;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },

        toggleFeature(id) {
            const idx = this.selectedFeatures.indexOf(id);
            if(idx === -1) this.selectedFeatures.push(id);
            else this.selectedFeatures.splice(idx, 1);
        },

        getFeature(id) { return this.availableFeatures.find(f => f.id === id); },

        calculateTotal() {
            let total = this.selectedDomain ? this.selectedDomain.price.total : 0;
            this.selectedFeatures.forEach(id => total += this.getFeature(id).price);
            return total;
        },

        submitOrder() {
            this.loading = true;
            setTimeout(() => {
                this.loading = false;
                alert('Integrasi Midtrans sedang dalam proses. Terima kasih!');
            }, 800);
        }
    }));
});
</script>
@endpush
