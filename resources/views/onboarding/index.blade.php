@extends('layouts.app')

@section('content')
<section class="min-h-screen py-20 px-4 relative overflow-hidden" x-data="onboardingWizard()">
    {{-- Background decoration --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-gradient-to-tr from-[#9acb03]/10 to-[#075749]/10 blur-3xl"></div>
    </div>

    <div class="max-w-2xl mx-auto relative z-10">
        {{-- Header --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4 group">
                @php $logoUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('images/logohvm.png'); @endphp
                <img src="{{ $logoUrl }}" alt="HVM Digital" class="w-8 h-8 rounded-lg shadow group-hover:scale-110 transition-transform">
                <span class="font-bold text-lg text-fg">HVM<span class="text-lime">Digital</span></span>
            </a>
            <h1 class="text-2xl md:text-3xl font-bold text-fg mb-2">Setup Website Usaha Anda</h1>
            <p class="text-muted text-sm font-light">Lengkapi data berikut untuk membuat website UMKM Anda.</p>
        </div>

        {{-- Progress Steps --}}
        <div class="flex items-center justify-center gap-0 mb-10">
            <template x-for="(label, idx) in ['Profil Usaha', 'Pilih Domain']" :key="idx">
                <div class="flex items-center">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 shadow-md"
                             :class="step > idx + 1 ? 'bg-[#9acb03] text-[#053d33]' : (step === idx + 1 ? 'bg-gradient-to-br from-[#075749] to-[#9acb03] text-white ring-4 ring-[#9acb03]/20' : 'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500')">
                            <span x-show="step <= idx + 1" x-text="idx + 1"></span>
                            <svg x-show="step > idx + 1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-[11px] mt-1.5 font-medium transition-colors"
                              :class="step >= idx + 1 ? 'text-fg' : 'text-muted'" x-text="label"></span>
                    </div>
                    <div x-show="idx < 1" class="w-16 md:w-24 h-0.5 mx-2 mb-5 rounded-full transition-all duration-500"
                         :class="step > idx + 1 ? 'bg-[#9acb03]' : 'bg-gray-200 dark:bg-gray-700'"></div>
                </div>
            </template>
        </div>

        {{-- Card --}}
        <div class="bg-card dark:bg-card-dark rounded-3xl border border-theme shadow-xl p-6 md:p-8">

            {{-- Alert --}}
            <div x-show="alertMessage" x-transition
                 class="mb-6 p-4 rounded-2xl border"
                 :class="alertType === 'error' ? 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800/30 text-red-600 dark:text-red-400' : 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800/30 text-green-600 dark:text-green-400'">
                <p class="text-sm flex items-center gap-2" x-text="alertMessage"></p>
            </div>

            {{-- ===================== STEP 1: Profil Usaha ===================== --}}
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                <h2 class="text-lg font-bold text-fg mb-1">Profil Usaha Anda</h2>
                <p class="text-muted text-sm font-light mb-6">Informasi dasar tentang bisnis Anda.</p>

                <div class="space-y-4">
                    {{-- Nama Usaha --}}
                    <div>
                        <label class="block text-sm font-medium text-fg mb-1">Nama Usaha <span class="text-red-500">*</span></label>
                        <input type="text" x-model="form.business_name" required
                            class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                            placeholder="Contoh: Toko Batik Nusantara">
                    </div>

                    {{-- Jenis Usaha --}}
                    <div>
                        <label class="block text-sm font-medium text-fg mb-1">Jenis Usaha <span class="text-red-500">*</span></label>
                        <select x-model="form.business_type"
                            class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all">
                            <option value="">Pilih jenis usaha...</option>
                            <option value="fnb">Makanan & Minuman (F&B)</option>
                            <option value="fashion">Fashion & Pakaian</option>
                            <option value="jasa">Jasa & Layanan</option>
                            <option value="retail">Retail & Toko</option>
                            <option value="kesehatan">Kesehatan & Kecantikan</option>
                            <option value="pendidikan">Pendidikan & Kursus</option>
                            <option value="properti">Properti & Real Estate</option>
                            <option value="otomotif">Otomotif</option>
                            <option value="teknologi">Teknologi & IT</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- No. WhatsApp --}}
                        <div>
                            <label class="block text-sm font-medium text-fg mb-1">No. WhatsApp</label>
                            <input type="tel" x-model="form.whatsapp"
                                class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                                placeholder="08123456789">
                        </div>

                        {{-- Email Bisnis --}}
                        <div>
                            <label class="block text-sm font-medium text-fg mb-1">Email Bisnis</label>
                            <input type="email" x-model="form.email_business"
                                class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                                placeholder="info@usahaku.com">
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-medium text-fg mb-1">Alamat Usaha</label>
                        <textarea x-model="form.address" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all resize-none"
                            placeholder="Jl. Raya Darmo No. 123, Surabaya"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-fg mb-1">Kota</label>
                            <input type="text" x-model="form.city"
                                class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                                placeholder="Surabaya">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-fg mb-1">Provinsi</label>
                            <input type="text" x-model="form.province"
                                class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                                placeholder="Jawa Timur">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium text-fg mb-1">Deskripsi Singkat Usaha</label>
                        <textarea x-model="form.description" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all resize-none"
                            placeholder="Ceritakan secara singkat tentang usaha Anda..."></textarea>
                    </div>

                    {{-- Instagram --}}
                    <div>
                        <label class="block text-sm font-medium text-fg mb-1">Instagram (opsional)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-muted text-sm">@</span>
                            <input type="text" x-model="form.instagram"
                                class="w-full pl-8 pr-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                                placeholder="usahaku.official">
                        </div>
                    </div>
                </div>

                {{-- Next Button --}}
                <button @click="saveStep1()" :disabled="saving"
                    class="w-full mt-6 py-3.5 rounded-xl font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                    style="background: linear-gradient(135deg, #075749, #9acb03);">
                    <span x-show="!saving">Lanjut — Pilih Domain</span>
                    <span x-show="saving" class="flex items-center gap-2">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        Menyimpan...
                    </span>
                    <svg x-show="!saving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
            </div>

            {{-- ===================== STEP 2: Pilih Domain ===================== --}}
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                <h2 class="text-lg font-bold text-fg mb-1">Pilih Alamat Website</h2>
                <p class="text-muted text-sm font-light mb-6">Pilih domain gratis atau beli domain custom untuk usaha Anda.</p>

                {{-- Domain Type Selection --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    {{-- Free Option --}}
                    <label class="relative cursor-pointer group">
                        <input type="radio" x-model="form.domain_type" value="free" class="sr-only">
                        <div class="p-5 rounded-2xl border-2 transition-all duration-200"
                             :class="form.domain_type === 'free' ? 'border-[#9acb03] bg-[#f0fdf4] dark:bg-[#0d1f15] shadow-lg ring-2 ring-[#9acb03]/20' : 'border-theme hover:border-[#9acb03]/50'">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                                     :class="form.domain_type === 'free' ? 'bg-[#9acb03] text-[#053d33]' : 'bg-gray-100 dark:bg-gray-800 text-muted'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-fg text-sm">Gratis</h3>
                                    <span class="text-xs font-bold text-[#9acb03]">Rp 0</span>
                                </div>
                            </div>
                            <p class="text-xs text-muted font-light leading-relaxed">hvmdigital.id/s/<span class="text-fg font-medium" x-text="form.business_name ? form.business_name.toLowerCase().replace(/\s+/g, '-') : 'nama-usaha'"></span></p>
                            <ul class="mt-3 space-y-1.5 text-xs text-muted font-light">
                                <li class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-[#9acb03]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> 1 Tema Starter</li>
                                <li class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-[#9acb03]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Branding HVM Digital</li>
                                <li class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-[#9acb03]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Halaman dasar</li>
                            </ul>
                        </div>
                    </label>

                    {{-- Custom Domain Option --}}
                    <label class="relative cursor-pointer group">
                        <input type="radio" x-model="form.domain_type" value="custom" class="sr-only">
                        <div class="p-5 rounded-2xl border-2 transition-all duration-200"
                             :class="form.domain_type === 'custom' ? 'border-[#9acb03] bg-[#f0fdf4] dark:bg-[#0d1f15] shadow-lg ring-2 ring-[#9acb03]/20' : 'border-theme hover:border-[#9acb03]/50'">
                            <div class="absolute -top-2.5 right-4">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full text-white" style="background: linear-gradient(135deg, #075749, #9acb03);">Populer</span>
                            </div>
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                                     :class="form.domain_type === 'custom' ? 'bg-[#9acb03] text-[#053d33]' : 'bg-gray-100 dark:bg-gray-800 text-muted'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-fg text-sm">Custom Domain</h3>
                                    <span class="text-xs font-bold text-[#9acb03]">Mulai Rp 150rb/thn</span>
                                </div>
                            </div>
                            <p class="text-xs text-muted font-light leading-relaxed">www.<span class="text-fg font-medium">nama-usaha-anda</span>.com</p>
                            <ul class="mt-3 space-y-1.5 text-xs text-muted font-light">
                                <li class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-[#9acb03]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Semua Tema Pro</li>
                                <li class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-[#9acb03]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Tanpa Branding</li>
                                <li class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-[#9acb03]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> SEO & Fitur Premium</li>
                            </ul>
                        </div>
                    </label>
                </div>

                {{-- Domain Search (only for custom) --}}
                <div x-show="form.domain_type === 'custom'" x-transition class="mb-6">
                    <label class="block text-sm font-medium text-fg mb-2">Cari Domain Impian Anda</label>
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                            </div>
                            <input type="text" x-model="domainQuery" @keydown.enter.prevent="searchDomain()"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                                placeholder="contoh: tokobatik atau tokobatik.com">
                        </div>
                        <button @click="searchDomain()" :disabled="searchingDomain"
                            class="px-6 py-3 rounded-xl font-semibold text-sm text-white hover:scale-[1.02] active:scale-[0.98] transition-all disabled:opacity-50 shrink-0"
                            style="background: linear-gradient(135deg, #075749, #9acb03);">
                            <span x-show="!searchingDomain">Cek</span>
                            <svg x-show="searchingDomain" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        </button>
                    </div>

                    {{-- Domain Results --}}
                    <div x-show="domainResults.length > 0" x-transition class="mt-4 space-y-2">
                        <template x-for="(result, idx) in domainResults" :key="idx">
                            <div class="flex items-center justify-between p-4 rounded-xl border transition-all cursor-pointer"
                                 :class="result.available ? (form.domain_name === result.domain ? 'border-[#9acb03] bg-[#f0fdf4] dark:bg-[#0d1f15] shadow-md' : 'border-theme hover:border-[#9acb03]/50 hover:shadow-sm') : 'border-theme opacity-50 cursor-not-allowed'"
                                 @click="result.available && (form.domain_name = result.domain)">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold"
                                         :class="result.available ? 'bg-green-100 dark:bg-green-900/30 text-green-600' : 'bg-red-100 dark:bg-red-900/30 text-red-500'">
                                        <svg x-show="result.available" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        <svg x-show="!result.available" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-sm text-fg" x-text="result.domain"></span>
                                        <p class="text-xs" :class="result.available ? 'text-green-500' : 'text-red-400'" x-text="result.available ? 'Tersedia!' : 'Sudah terdaftar'"></p>
                                    </div>
                                </div>
                                <div x-show="result.available && form.domain_name === result.domain" class="w-6 h-6 rounded-full bg-[#9acb03] flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <div class="flex gap-3 mt-6">
                    <button @click="step = 1"
                        class="flex-1 py-3.5 rounded-xl font-semibold text-sm border-2 border-theme text-fg hover:bg-surface dark:hover:bg-[#0d1f15] transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
                        Kembali
                    </button>
                    <button @click="saveStep2()" :disabled="saving"
                        class="flex-[2] py-3.5 rounded-xl font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #075749, #9acb03);">
                        <span x-show="!saving" x-text="form.domain_type === 'free' ? 'Buat Website Gratis!' : 'Lanjut ke Pembayaran'"></span>
                        <span x-show="saving" class="flex items-center gap-2">
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            Memproses...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Logout --}}
        <div class="text-center mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs text-muted hover:text-lime transition-colors font-light">Keluar dari akun</button>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
function onboardingWizard() {
    return {
        step: {{ $tenant->onboarding_step ?? 1 }},
        saving: false,
        searchingDomain: false,
        alertMessage: '',
        alertType: 'error',
        domainQuery: '',
        domainResults: [],

        form: {
            business_name:     '{{ $tenant->business_name ?? '' }}',
            business_type:     '{{ $tenant->business_type ?? '' }}',
            business_category: '{{ $tenant->business_category ?? '' }}',
            description:       '{{ $tenant->description ?? '' }}',
            whatsapp:          '{{ $tenant->whatsapp ?? '' }}',
            email_business:    '{{ $tenant->email_business ?? '' }}',
            address:           '{{ $tenant->address ?? '' }}',
            city:              '{{ $tenant->city ?? '' }}',
            province:          '{{ $tenant->province ?? '' }}',
            instagram:         '{{ $tenant->instagram ?? '' }}',
            domain_type:       '{{ $tenant->plan === "pro" ? "custom" : "free" }}',
            domain_name:       '',
        },

        async saveStep1() {
            if (!this.form.business_name || !this.form.business_type) {
                this.showAlert('Nama Usaha dan Jenis Usaha wajib diisi.', 'error');
                return;
            }
            this.saving = true;
            this.alertMessage = '';

            try {
                const res = await fetch('{{ route("onboarding.profile") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(this.form),
                });
                const data = await res.json();
                if (data.success) {
                    this.step = 2;
                } else {
                    this.showAlert(data.message || 'Terjadi kesalahan.', 'error');
                }
            } catch (e) {
                this.showAlert('Koneksi gagal, coba lagi.', 'error');
            }
            this.saving = false;
        },

        async saveStep2() {
            if (this.form.domain_type === 'custom' && !this.form.domain_name) {
                this.showAlert('Silakan cari dan pilih domain terlebih dahulu.', 'error');
                return;
            }
            this.saving = true;

            try {
                const res = await fetch('{{ route("onboarding.domain") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(this.form),
                });
                const data = await res.json();
                if (data.success) {
                    if (this.form.domain_type === 'free') {
                        window.location.href = '{{ route("tenant.dashboard") }}';
                    } else {
                        // Redirect to checkout (Midtrans) — will be built next
                        window.location.href = '{{ route("tenant.dashboard") }}';
                    }
                }
            } catch (e) {
                this.showAlert('Koneksi gagal, coba lagi.', 'error');
            }
            this.saving = false;
        },

        async searchDomain() {
            if (!this.domainQuery.trim()) return;
            this.searchingDomain = true;
            this.domainResults = [];

            try {
                const res = await fetch('{{ route("api.check-domain") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ domain: this.domainQuery.trim() }),
                });
                const data = await res.json();
                if (data.success) {
                    this.domainResults = data.results;
                }
            } catch (e) {
                this.showAlert('Gagal mengecek domain. Coba lagi.', 'error');
            }
            this.searchingDomain = false;
        },

        showAlert(msg, type = 'error') {
            this.alertMessage = msg;
            this.alertType = type;
            setTimeout(() => { this.alertMessage = ''; }, 5000);
        },
    };
}
</script>
@endpush
@endsection
