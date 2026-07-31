@extends('layouts.tenant')
@section('title', 'Upgrade Website')
@section('page-title', 'Upgrade Website')

@section('content')

<div x-data="upgradeWizard()">

    {{-- ===== GRADIENT STEP HEADER CARD ===== --}}
    <div style="background:linear-gradient(135deg,#075749 0%,#0a6d58 40%,#9acb03 100%);border-radius:20px;padding:28px 32px;margin-bottom:28px;position:relative;overflow:hidden;">
        {{-- Decorative circles --}}
        <div style="position:absolute;right:-40px;top:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.05);pointer-events:none;"></div>
        <div style="position:absolute;right:60px;bottom:-60px;width:140px;height:140px;border-radius:50%;background:rgba(255,255,255,0.04);pointer-events:none;"></div>

        <div style="position:relative;z-index:1;display:flex;align-items:center;gap:0;">
            <template x-for="(s, i) in steps" :key="i">
                <div style="display:flex;align-items:center;flex:1;">
                    <div style="display:flex;flex-direction:column;align-items:center;gap:6px;flex-shrink:0;">
                        <div style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:800;transition:all 0.3s;border:2.5px solid;"
                             :style="step > i+1 ? 'background:#9acb03;color:#0d1f15;border-color:#9acb03;' : step===i+1 ? 'background:rgba(255,255,255,0.15);color:#fff;border-color:rgba(255,255,255,0.8);backdrop-filter:blur(8px);' : 'background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.4);border-color:rgba(255,255,255,0.15);'">
                            <svg x-show="step > i+1" style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            <span x-show="step <= i+1" x-text="i+1"></span>
                        </div>
                        <span style="font-size:11px;font-weight:500;letter-spacing:0.3px;white-space:nowrap;transition:all 0.3s;"
                              :style="step === i+1 ? 'color:#fff;font-weight:700;' : (step > i+1 ? 'color:#9acb03;' : 'color:rgba(255,255,255,0.35);')"
                              x-text="s"></span>
                    </div>
                    <div x-show="i < steps.length-1" style="flex:1;height:2px;margin-bottom:18px;border-radius:2px;transition:background 0.5s;"
                         :style="step > i+1 ? 'background:#9acb03;' : 'background:rgba(255,255,255,0.15);'"></div>
                </div>
            </template>
        </div>
    </div>

    {{-- ===== STEP 1: DOMAIN SEARCH ===== --}}
    <div x-show="step === 1">

        {{-- Search --}}
        <div style="text-align:center;margin-bottom:24px;">
            <h1 style="font-size:26px;font-weight:800;color:#111827;margin:0 0 6px;letter-spacing:-0.5px;">Cari nama domain</h1>
            <p style="font-size:13px;font-weight:300;color:#9ca3af;margin:0 0 20px;">Masukkan nama usaha dan kami tampilkan ketersediaan domain terbaik.</p>

            <div style="display:flex;gap:10px;max-width:580px;margin:0 auto;">
                <div style="position:relative;flex:1;">
                    <svg style="position:absolute;left:15px;top:50%;transform:translateY(-50%);width:16px;height:16px;color:#9ca3af;pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" x-model="domainQuery" @keydown.enter="checkDomain"
                           style="width:100%;padding:13px 14px 13px 42px;border:2px solid #e5e7eb;border-radius:12px;font-size:14px;font-weight:400;color:#111827;outline:none;transition:all 0.2s;box-sizing:border-box;font-family:'Montserrat',sans-serif;"
                           @focus="$el.style.borderColor='#075749';$el.style.boxShadow='0 0 0 3px rgba(7,87,73,0.08)'"
                           @blur="$el.style.borderColor='#e5e7eb';$el.style.boxShadow='none'"
                           placeholder="Contoh: kedaikopi atau namadomain.com">
                </div>
                <button @click="checkDomain" :disabled="loading"
                        style="padding:0 22px;border-radius:12px;font-size:13px;font-weight:700;background:linear-gradient(135deg,#075749,#0a6d58);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;gap:7px;transition:all 0.2s;white-space:nowrap;flex-shrink:0;font-family:'Montserrat',sans-serif;letter-spacing:0.2px;"
                        @mouseover="if(!loading) $el.style.transform='scale(1.02)'" @mouseout="$el.style.transform='scale(1)'">
                    <svg x-show="!loading" style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <svg x-show="loading" style="width:15px;height:15px;animation:spin 1s linear infinite;" fill="none" viewBox="0 0 24 24"><circle style="opacity:.3" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    <span x-text="loading ? 'Mencari...' : 'Cari'"></span>
                </button>
            </div>
        </div>

        {{-- Empty state --}}
        <div x-show="!hasSearched && !loading" style="text-align:center;padding:20px;">
            <p style="font-size:12px;font-weight:300;color:#c0c0c0;margin:0 0 12px;">Coba contoh berikut:</p>
            <div style="display:flex;flex-wrap:wrap;gap:8px;justify-content:center;">
                <template x-for="eg in ['kedaikopi', 'salonwangi', 'tokokue', 'bengkelonline']" :key="eg">
                    <button @click="domainQuery = eg; checkDomain()"
                            style="padding:6px 16px;border:1.5px solid #e5e7eb;border-radius:20px;font-size:12px;font-weight:400;color:#6b7280;background:#fff;cursor:pointer;font-family:'Montserrat',sans-serif;transition:all 0.2s;"
                            @mouseover="$el.style.borderColor='#075749';$el.style.color='#075749'"
                            @mouseout="$el.style.borderColor='#e5e7eb';$el.style.color='#6b7280'"
                            x-text="eg + '.com'"></button>
                </template>
            </div>
        </div>

        {{-- Skeleton --}}
        <div x-show="loading" style="max-width:780px;margin:0 auto;">
            <div style="border:2px solid #f0f0f0;border-radius:14px;padding:20px 24px;margin-bottom:14px;display:flex;justify-content:space-between;align-items:center;">
                <div><div style="width:220px;height:18px;border-radius:6px;background:linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);background-size:600px 100%;animation:shimmer 1.5s infinite;margin-bottom:8px;"></div><div style="width:280px;height:13px;border-radius:6px;background:linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);background-size:600px 100%;animation:shimmer 1.5s infinite;"></div></div>
                <div style="display:flex;gap:12px;"><div style="width:90px;height:18px;border-radius:6px;background:linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);background-size:600px 100%;animation:shimmer 1.5s infinite;"></div><div style="width:100px;height:40px;border-radius:10px;background:linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);background-size:600px 100%;animation:shimmer 1.5s infinite;"></div></div>
            </div>
            <div style="background:#fff;border-radius:14px;border:1.5px solid #f0f0f0;overflow:hidden;">
                <template x-for="i in 4" :key="i">
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 20px;border-bottom:1px solid #f9f9f9;">
                        <div style="width:200px;height:14px;border-radius:6px;background:linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);background-size:600px 100%;animation:shimmer 1.5s infinite;"></div>
                        <div style="display:flex;gap:10px;"><div style="width:80px;height:14px;border-radius:6px;background:linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);background-size:600px 100%;animation:shimmer 1.5s infinite;"></div><div style="width:60px;height:32px;border-radius:8px;background:linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);background-size:600px 100%;animation:shimmer 1.5s infinite;"></div></div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Results --}}
        <div x-show="hasSearched && !loading" style="max-width:780px;margin:0 auto;">

            {{-- Primary Result --}}
            <template x-if="primaryResult">
                <div style="border-radius:24px;padding:24px 28px;margin-bottom:16px;border:1.5px solid;"
                     :style="primaryResult.available ? 'border-color:#e8f5d0;background:linear-gradient(140deg,rgba(154,203,3,0.03) 0%,#fff 70%);' : 'border-color:#f0f0f0;background:#fafafa;'">
                    
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;">
                        <span style="font-size:11px;font-weight:500;"
                              :style="primaryResult.available ? 'color:#6ab04c;' : 'color:#ccc;'"
                              x-text="primaryResult.available ? '✓ Sesuai permintaan' : '· tidak tersedia'"></span>
                        <span x-show="!primaryResult.available" style="font-size:11px;font-weight:300;color:#e0e0e0;">— cek alternatif di bawah</span>
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;">
                        <div style="flex:1;min-width:160px;">
                            <div style="font-size:18px;font-weight:700;color:#111827;letter-spacing:-0.3px;margin-bottom:8px;" x-text="primaryResult.domain"></div>
                            <div x-show="primaryResult.available" style="display:flex;flex-direction:column;gap:4px;">
                                <span style="font-size:12px;font-weight:300;color:#9ca3af;display:flex;align-items:center;gap:6px;"><svg style="width:12px;height:12px;color:#9acb03;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Domain profesional untuk bisnis Anda</span>
                                <span style="font-size:12px;font-weight:300;color:#9ca3af;display:flex;align-items:center;gap:6px;"><svg style="width:12px;height:12px;color:#9acb03;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Tingkatkan kepercayaan pelanggan</span>
                            </div>
                        </div>

                        <div x-show="primaryResult.available" style="flex-shrink:0;background:#fff;border:1px solid #f0f0f0;border-radius:18px;padding:16px 20px;display:flex;flex-direction:column;align-items:flex-end;gap:10px;box-shadow:0 2px 12px rgba(0,0,0,0.04);">
                            <div style="text-align:right;">
                                <div style="font-size:11px;font-weight:300;color:#d1d5db;text-decoration:line-through;" x-text="'Rp ' + Math.round(primaryResult.price.base * 2.5).toLocaleString('id-ID') + ' /Tahun'"></div>
                                <div style="font-size:20px;font-weight:700;color:#075749;letter-spacing:-0.3px;" x-text="primaryResult.price.total_formatted"></div>
                                <div style="font-size:10px;font-weight:300;color:#c0c0c0;">incl. PPN 11%</div>
                            </div>
                            <button @click="selectAndProceed(primaryResult)"
                                    style="padding:11px 22px;border-radius:14px;font-size:13px;font-weight:700;cursor:pointer;border:none;background:linear-gradient(135deg,#075749,#9acb03);color:#fff;font-family:'Montserrat',sans-serif;white-space:nowrap;transition:all 0.2s;letter-spacing:0.2px;box-shadow:0 4px 14px rgba(7,87,73,0.2);width:100%;"
                                    @mouseover="$el.style.transform='scale(1.03)';$el.style.boxShadow='0 6px 20px rgba(7,87,73,0.3)'"
                                    @mouseout="$el.style.transform='scale(1)';$el.style.boxShadow='0 4px 14px rgba(7,87,73,0.2)'">
                                Pilih Domain
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Other TLDs - COMPACT LIST --}}
            <div x-show="otherResults.length > 0" style="background:#fff;border-radius:20px;border:1.5px solid #f0f0f0;overflow:hidden;">
                {{-- Header only, no filter chips --}}
                <div style="padding:16px 22px;border-bottom:1px solid #f5f5f5;display:flex;align-items:center;justify-content:space-between;">
                    <span style="font-size:12px;font-weight:600;color:#374151;">Pilihan domain lainnya</span>
                    <span style="font-size:11px;font-weight:300;color:#c0c0c0;" x-text="otherResults.length + ' domain'"></span>
                </div>

                {{-- Compact Rows --}}
                <template x-for="(result, idx) in otherResults" :key="idx">
                    <div style="display:flex;align-items:center;padding:10px 20px;border-bottom:1px solid #fafafa;transition:background 0.12s;gap:10px;"
                         @mouseover="$el.style.background='#fafafa'" @mouseout="$el.style.background='transparent'">
                        
                        {{-- Domain name + badge --}}
                        <div style="flex:1;display:flex;align-items:center;gap:8px;min-width:0;">
                            <span style="font-size:14px;font-weight:600;color:#111827;letter-spacing:-0.2px;" x-text="result.domain"></span>
                            <span x-show="['com','id'].includes(result.tld)" style="padding:1px 8px;border-radius:20px;font-size:10px;font-weight:700;background:#f0fdf4;color:#15803d;flex-shrink:0;">Populer</span>
                            <span x-show="['my.id','biz.id'].includes(result.tld)" style="padding:1px 8px;border-radius:20px;font-size:10px;font-weight:700;background:#fef9c3;color:#854d0e;flex-shrink:0;">Hemat</span>
                        </div>

                        {{-- Price + Button (available) --}}
                        <template x-if="result.available">
                            <div x-show="result.available" style="display:flex;align-items:center;gap:14px;flex-shrink:0;">
                                <div style="text-align:right;line-height:1.3;">
                                    <div style="font-size:10px;font-weight:300;color:#d1d5db;text-decoration:line-through;" x-text="'Rp ' + Math.round(result.price.base * 2.5).toLocaleString('id-ID')"></div>
                                    <div style="font-size:13px;font-weight:500;color:#374151;" x-text="result.price.total_formatted"></div>
                                </div>
                                <button @click="selectAndProceed(result)"
                                        style="padding:7px 16px;border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;border:1.5px solid #075749;color:#075749;background:#fff;font-family:'Montserrat',sans-serif;transition:all 0.15s;white-space:nowrap;"
                                        @mouseover="$el.style.background='#075749';$el.style.color='#fff'"
                                        @mouseout="$el.style.background='#fff';$el.style.color='#075749'">
                                    Pilih
                                </button>
                            </div>
                        </template>

                        {{-- Not available --}}
                        <template x-if="!result.available">
                            <span style="font-size:11px;font-weight:400;color:#d1d5db;flex-shrink:0;">tidak tersedia</span>
                        </template>
                    </div>
                </template>

                <div x-show="filteredResults.length === 0" style="text-align:center;padding:20px;font-size:12px;font-weight:300;color:#9ca3af;">
                    Tidak ada hasil untuk filter ini.
                </div>
            </div>
        </div>
    </div>

    {{-- ===== STEP 2: LAYANAN TAMBAHAN ===== --}}
    <div x-show="step === 2" style="display:none;max-width:780px;margin:0 auto;">
        <div style="display:flex;align-items:center;gap:14px;background:#f0fdf4;border:2px solid #9acb03;border-radius:14px;padding:16px 20px;margin-bottom:20px;">
            <div style="width:40px;height:40px;background:linear-gradient(135deg,#075749,#9acb03);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg style="width:20px;height:20px;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div style="flex:1;">
                <div style="font-size:10px;font-weight:700;color:#15803d;text-transform:uppercase;letter-spacing:0.06em;">Domain Dipilih</div>
                <div style="font-size:17px;font-weight:800;color:#111827;" x-text="selectedDomain?.domain"></div>
            </div>
            <div style="text-align:right;flex-shrink:0;">
                <div style="font-size:20px;font-weight:800;color:#075749;" x-text="selectedDomain?.price.total_formatted"></div>
                <div style="font-size:10px;font-weight:300;color:#9ca3af;">/tahun</div>
            </div>
        </div>

        <div style="text-align:center;margin-bottom:20px;">
            <h2 style="font-size:20px;font-weight:800;color:#111827;margin:0 0 6px;">Layanan Tambahan <span style="font-weight:300;color:#9ca3af;">(Opsional)</span></h2>
            <p style="font-size:12px;font-weight:300;color:#9ca3af;margin:0;">Pilih atau lewati — bisa disesuaikan nanti.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;margin-bottom:24px;">
            <template x-for="feature in availableFeatures" :key="feature.id">
                <div style="border-radius:12px;border:2px solid;cursor:pointer;padding:16px;transition:all 0.2s;"
                     :style="selectedFeatures.includes(feature.id) ? 'border-color:#9acb03;background:linear-gradient(135deg,rgba(154,203,3,0.06),#fff);' : 'border-color:#e5e7eb;background:#fff;'"
                     @click="toggleFeature(feature.id)">
                    <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:10px;">
                        <span style="font-size:26px;" x-text="feature.icon"></span>
                        <div style="width:20px;height:20px;border-radius:5px;border:2px solid;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s;"
                             :style="selectedFeatures.includes(feature.id) ? 'background:#9acb03;border-color:#9acb03;' : 'border-color:#d1d5db;'">
                            <svg x-show="selectedFeatures.includes(feature.id)" style="width:12px;height:12px;" fill="none" stroke="#0d1f15" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </div>
                    <div style="font-size:13px;font-weight:700;color:#111827;margin-bottom:5px;" x-text="feature.name"></div>
                    <div style="font-size:11px;font-weight:300;color:#6b7280;margin-bottom:10px;line-height:1.5;" x-text="feature.desc"></div>
                    <div style="font-size:13px;font-weight:800;color:#075749;" x-text="'+ Rp ' + feature.price.toLocaleString('id-ID')"></div>
                </div>
            </template>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;">
            <button @click="step--" style="display:flex;align-items:center;gap:6px;padding:10px 18px;border-radius:10px;border:1.5px solid #e5e7eb;color:#6b7280;background:#fff;font-size:12px;font-weight:500;cursor:pointer;font-family:'Montserrat',sans-serif;transition:all 0.2s;" @mouseover="$el.style.borderColor='#075749'" @mouseout="$el.style.borderColor='#e5e7eb'">
                <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>
            <button @click="step++" style="display:flex;align-items:center;gap:7px;padding:11px 24px;border-radius:12px;background:linear-gradient(135deg,#075749,#9acb03);color:#fff;border:none;font-size:13px;font-weight:700;cursor:pointer;font-family:'Montserrat',sans-serif;letter-spacing:0.2px;box-shadow:0 4px 14px rgba(7,87,73,0.25);transition:all 0.2s;" @mouseover="$el.style.transform='scale(1.02)'" @mouseout="$el.style.transform='scale(1)'">
                Lanjutkan ke Pembayaran
                <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    {{-- ===== STEP 3: PEMBAYARAN ===== --}}
    <div x-show="step === 3" style="display:none;max-width:780px;margin:0 auto;">
        <div style="display:grid;grid-template-columns:1fr 300px;gap:16px;align-items:start;">

            <div style="background:#fff;border-radius:14px;border:1.5px solid #e5e7eb;padding:24px;">
                <h2 style="font-size:17px;font-weight:800;color:#111827;margin:0 0 18px;">Ringkasan Pesanan</h2>
                <div style="background:linear-gradient(135deg,#0d1f15,#075749);border-radius:12px;padding:18px 20px;margin-bottom:14px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <div style="font-size:10px;color:rgba(255,255,255,0.4);font-weight:500;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Domain</div>
                            <div style="font-size:17px;font-weight:800;color:#fff;" x-text="selectedDomain?.domain"></div>
                            <div style="font-size:10px;color:rgba(255,255,255,0.35);font-weight:300;margin-top:3px;">1 Tahun • incl. PPN 11%</div>
                        </div>
                        <div style="font-size:17px;font-weight:800;color:#9acb03;" x-text="selectedDomain?.price.total_formatted"></div>
                    </div>
                </div>
                <template x-if="selectedFeatures.length > 0">
                    <div style="margin-bottom:14px;">
                        <div style="font-size:10px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px;">Layanan Tambahan</div>
                        <template x-for="featId in selectedFeatures" :key="featId">
                            <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:13px;">
                                <span style="color:#374151;display:flex;align-items:center;gap:7px;font-weight:400;"><span x-text="getFeature(featId).icon"></span><span x-text="getFeature(featId).name"></span></span>
                                <span style="color:#111827;font-weight:700;" x-text="'Rp ' + getFeature(featId).price.toLocaleString('id-ID')"></span>
                            </div>
                        </template>
                    </div>
                </template>
                <div style="padding-top:14px;border-top:2px dashed #e5e7eb;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:12px;font-weight:600;color:#374151;">Total</span>
                    <span style="font-size:24px;font-weight:800;color:#075749;" x-text="'Rp ' + calculateTotal().toLocaleString('id-ID')"></span>
                </div>
                <button @click="step--" style="width:100%;margin-top:14px;display:flex;align-items:center;justify-content:center;gap:6px;padding:9px;border-radius:10px;border:1.5px solid #e5e7eb;color:#9ca3af;background:#fff;font-size:12px;font-weight:400;cursor:pointer;font-family:'Montserrat',sans-serif;">
                    <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Ubah Pilihan
                </button>
            </div>

            <div style="background:#fff;border-radius:14px;border:1.5px solid #e5e7eb;padding:22px;position:sticky;top:80px;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#075749,#9acb03);border-radius:13px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                    <svg style="width:24px;height:24px;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div style="font-size:15px;font-weight:700;color:#111827;margin-bottom:6px;">Pembayaran Aman</div>
                <p style="font-size:11px;font-weight:300;color:#6b7280;line-height:1.6;margin:0 0 16px;">Diproses via Midtrans dengan enkripsi SSL 256-bit.</p>
                <div style="display:flex;flex-wrap:wrap;gap:5px;margin-bottom:18px;">
                    <template x-for="m in ['VISA','Mastercard','QRIS','GoPay','OVO','Dana','Bank']" :key="m">
                        <span style="padding:2px 8px;border:1px solid #e5e7eb;border-radius:5px;font-size:10px;font-weight:500;color:#374151;" x-text="m"></span>
                    </template>
                </div>
                <button @click="submitOrder" style="width:100%;padding:13px;border-radius:12px;font-size:14px;font-weight:700;cursor:pointer;border:none;background:linear-gradient(135deg,#075749,#9acb03);color:#fff;font-family:'Montserrat',sans-serif;display:flex;align-items:center;justify-content:center;gap:8px;transition:all 0.2s;box-shadow:0 4px 14px rgba(7,87,73,0.25);" @mouseover="$el.style.transform='scale(1.02)'" @mouseout="$el.style.transform='scale(1)'">
                    <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Bayar Sekarang
                </button>
                <div style="display:flex;align-items:center;justify-content:center;gap:5px;margin-top:12px;">
                    <svg style="width:12px;height:12px;color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span style="font-size:10px;font-weight:300;color:#9ca3af;">Aman dengan SSL Encryption</span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<style>
@keyframes spin { to { transform: rotate(360deg); } }
@keyframes shimmer { 0%{background-position:-600px 0} 100%{background-position:600px 0} }
</style>
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
            { id: 'premium_theme', icon: '🎨', name: 'Tema Premium',     desc: 'Desain profesional dengan animasi mewah untuk menarik pelanggan.', price: 250000 },
            { id: 'seo_copy',      icon: '✍️', name: 'Copywriting + SEO', desc: 'Teks halaman menarik + optimasi agar mudah ditemukan Google.', price: 150000 },
            { id: 'custom_logo',   icon: '🖼️', name: 'Desain Logo',       desc: '2 opsi logo eksklusif dari desainer profesional kami.', price: 100000 },
            { id: 'ecommerce',     icon: '🛒', name: 'Katalog Produk',     desc: 'Galeri produk tak terbatas + tombol pesan via WhatsApp.', price: 300000 },
        ],
        selectedFeatures: [],

        get primaryResult()  { return this.domainResults[0] ?? null; },
        get otherResults()   { return this.domainResults.slice(1); },
        get filteredResults() {
            if (this.activeFilter === 'Tersedia') return this.otherResults.filter(r => r.available);
            if (this.activeFilter === 'Populer')  return this.otherResults.filter(r => ['com','id'].includes(r.tld));
            if (this.activeFilter === 'Hemat')    return this.otherResults.filter(r => ['my.id','biz.id'].includes(r.tld));
            return this.otherResults;
        },

        async checkDomain() {
            if (this.domainQuery.trim().length < 2) return;
            this.loading = true;
            this.hasSearched = true;
            this.domainResults = [];
            this.selectedDomain = null;
            try {
                const res  = await fetch('{{ route("tenant.upgrade.check") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({ query: this.domainQuery.trim() })
                });
                const data = await res.json();
                if (data.success) this.domainResults = data.results;
            } catch(e) {
                alert('Gagal memeriksa domain. Coba lagi.');
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
            if (idx === -1) this.selectedFeatures.push(id);
            else            this.selectedFeatures.splice(idx, 1);
        },

        getFeature(id) { return this.availableFeatures.find(f => f.id === id); },

        calculateTotal() {
            let t = this.selectedDomain ? this.selectedDomain.price.total : 0;
            this.selectedFeatures.forEach(id => t += this.getFeature(id).price);
            return t;
        },

        submitOrder() {
            this.loading = true;
            setTimeout(() => { this.loading = false; alert('Integrasi Midtrans sedang dipersiapkan.'); }, 800);
        }
    }));
});
</script>
@endpush
