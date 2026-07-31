@extends('layouts.auth')

@section('content')
<section class="min-h-screen py-16 px-4 relative overflow-hidden bg-surface dark:bg-[#061009]" x-data="onboardingWizard()">
    {{-- Background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-gradient-to-tr from-[#9acb03]/10 to-[#075749]/10 blur-3xl"></div>
    </div>

    <div class="max-w-4xl mx-auto relative z-10">
        {{-- Header & Progress --}}
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-6">
            <div class="text-center md:text-left">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-2 group">
                    @php $logoUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('images/logohvm.png'); @endphp
                    <img src="{{ $logoUrl }}" alt="HVM Digital" class="w-8 h-8 rounded-lg shadow bg-white p-1">
                    <span class="font-bold text-lg text-fg">HVM<span class="text-[#9acb03]">Digital</span></span>
                </a>
                <h1 class="text-2xl font-bold text-fg">Setup Website Anda</h1>
                <p class="text-muted text-sm font-light">Lengkapi 2 langkah mudah ini.</p>
            </div>

            {{-- Progress Steps --}}
            <div class="flex items-center gap-0">
                <template x-for="(label, idx) in ['Profil Usaha', 'Domain', 'Selesai']" :key="idx">
                    <div class="flex items-center">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all duration-300 shadow-sm"
                                 :class="step > idx + 1 ? 'bg-[#9acb03] text-[#053d33]' : (step === idx + 1 ? 'bg-[#075749] text-white ring-2 ring-[#075749]/30' : 'bg-gray-200 dark:bg-gray-800 text-gray-400 dark:text-gray-500')">
                                <span x-show="step <= idx + 1" x-text="idx + 1"></span>
                                <svg x-show="step > idx + 1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-[10px] mt-1 font-medium transition-colors"
                                  :class="step >= idx + 1 ? 'text-fg' : 'text-muted'" x-text="label"></span>
                        </div>
                        <div x-show="idx < 2" class="w-8 md:w-16 h-0.5 mx-2 mb-4 rounded-full transition-all duration-500"
                             :class="step > idx + 1 ? 'bg-[#9acb03]' : 'bg-gray-200 dark:bg-gray-800'"></div>
                    </div>
                </template>
            </div>
        </div>

        <div class="bg-card dark:bg-card-dark rounded-3xl border border-theme shadow-xl overflow-hidden flex flex-col md:flex-row min-h-[500px]">
            
            {{-- Left Side Info (Static) --}}
            <div class="hidden md:flex flex-col justify-between w-1/3 bg-[#075749] text-white p-8 relative overflow-hidden">
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-[#9acb03] rounded-full blur-3xl opacity-30 pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-4">Kenapa Memilih Kami?</h3>
                    <ul class="space-y-4 text-sm font-light text-white/90">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#9acb03] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Website langsung online setelah setup.
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#9acb03] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            SEO Optimized, mudah ditemukan Google.
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#9acb03] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Dukungan penuh untuk custom domain & email.
                        </li>
                    </ul>
                </div>
                <div class="relative z-10 text-xs text-white/60">
                    Butuh Bantuan? <a href="#" class="text-[#9acb03] hover:underline">Hubungi CS</a>
                </div>
            </div>

            {{-- Right Side Forms --}}
            <div class="w-full md:w-2/3 p-6 md:p-8 flex flex-col">
                {{-- Alert --}}
                <div x-show="alertMessage" x-transition
                    class="mb-6 p-4 rounded-xl border"
                    :class="alertType === 'error' ? 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800/30 text-red-600 dark:text-red-400' : 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800/30 text-green-600 dark:text-green-400'">
                    <p class="text-sm flex items-center gap-2 font-medium" x-text="alertMessage"></p>
                </div>

                {{-- ===================== STEP 1: Profil Usaha ===================== --}}
                <div x-show="step === 1" class="flex-1 flex flex-col justify-between" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div>
                        <h2 class="text-xl font-bold text-fg mb-1">Informasi Dasar</h2>
                        <p class="text-muted text-sm font-light mb-6">Data ini akan ditampilkan di website Anda.</p>

                        <div class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Nama Usaha --}}
                                <div>
                                    <label class="block text-sm font-medium text-fg mb-1">Nama Usaha <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="form.business_name" @input="generateSlug()" required
                                        class="w-full px-4 py-2.5 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all"
                                        placeholder="Toko Baju Mawar">
                                </div>
                                {{-- Jenis Usaha --}}
                                <div>
                                    <label class="block text-sm font-medium text-fg mb-1">Kategori <span class="text-red-500">*</span></label>
                                    <select x-model="form.business_type"
                                        class="w-full px-4 py-2.5 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all">
                                        <option value="">Pilih kategori...</option>
                                        <option value="fnb">Kuliner (F&B)</option>
                                        <option value="retail">Retail / Toko</option>
                                        <option value="jasa">Jasa & Layanan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Slug URL --}}
                            <div>
                                <label class="block text-sm font-medium text-fg mb-1">Alamat Link Website Gratis (Slug) <span class="text-red-500">*</span></label>
                                <div class="flex items-stretch">
                                    <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-theme bg-gray-50 dark:bg-gray-800 text-muted text-sm select-none">
                                        hvmdigital.id/s/
                                    </span>
                                    <input type="text" x-model="form.slug" required @input="form.slug = form.slug.toLowerCase().replace(/[^a-z0-9\-]/g, '')"
                                        class="flex-1 w-full px-4 py-2.5 rounded-r-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all"
                                        placeholder="toko-mawar">
                                </div>
                                <p class="text-[10px] text-muted mt-1">Hanya huruf kecil, angka, dan strip (-).</p>
                            </div>

                            {{-- Kontak --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-fg mb-1">No. WhatsApp</label>
                                    <input type="tel" x-model="form.whatsapp"
                                        class="w-full px-4 py-2.5 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all"
                                        placeholder="08123456789">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-fg mb-1">Alamat (Kota)</label>
                                    <input type="text" x-model="form.city"
                                        class="w-full px-4 py-2.5 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all"
                                        placeholder="Surabaya">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-theme flex justify-end">
                        <button @click="saveStep1()" :disabled="saving"
                            class="px-8 py-3 rounded-xl font-semibold text-sm text-[#053d33] shadow-md hover:shadow-lg transition-all duration-200 disabled:opacity-50 flex items-center gap-2"
                            style="background: #9acb03;">
                            <span x-show="!saving">Lanjut ke Domain</span>
                            <span x-show="saving">Menyimpan...</span>
                            <svg x-show="!saving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </div>
                </div>

                {{-- ===================== STEP 2: Domain ===================== --}}
                <div x-show="step === 2" style="display:none" class="flex-1 flex flex-col justify-between" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div>
                        <h2 class="text-xl font-bold text-fg mb-1">Pilih Alamat Website</h2>
                        <p class="text-muted text-sm font-light mb-6">Pilih antara domain gratis HVM atau domain profesional (.com, .id).</p>

                        {{-- Type Select --}}
                        <div class="flex gap-4 mb-6">
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" x-model="form.domain_type" value="free" class="sr-only">
                                <div class="p-4 rounded-xl border-2 transition-all duration-200 h-full flex flex-col items-center justify-center text-center"
                                     :class="form.domain_type === 'free' ? 'border-[#9acb03] bg-green-50 dark:bg-green-900/10' : 'border-theme'">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-2 group-hover:bg-[#9acb03]/20 text-muted transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </div>
                                    <span class="font-bold text-sm text-fg">Subdomain Gratis</span>
                                    <span class="text-xs text-[#9acb03] font-bold mt-1">Rp 0</span>
                                </div>
                            </label>
                            
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" x-model="form.domain_type" value="custom" class="sr-only">
                                <div class="p-4 rounded-xl border-2 transition-all duration-200 h-full flex flex-col items-center justify-center text-center"
                                     :class="form.domain_type === 'custom' ? 'border-[#9acb03] bg-green-50 dark:bg-green-900/10' : 'border-theme'">
                                    <div class="absolute -top-2 -right-2 bg-gradient-to-r from-[#075749] to-[#9acb03] text-white text-[9px] font-bold px-2 py-0.5 rounded-full">POPULER</div>
                                    <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-2 group-hover:bg-[#9acb03]/20 text-muted transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                                    </div>
                                    <span class="font-bold text-sm text-fg">Domain Sendiri</span>
                                    <span class="text-xs text-[#9acb03] font-bold mt-1">Premium</span>
                                </div>
                            </label>
                        </div>

                        {{-- Free Details --}}
                        <div x-show="form.domain_type === 'free'" class="p-4 rounded-xl bg-surface border border-theme text-sm">
                            <p class="text-muted font-light mb-2">Alamat website Anda:</p>
                            <div class="font-mono text-fg bg-gray-100 dark:bg-gray-800 p-2 rounded-lg text-center break-all">
                                hvmdigital.id/s/<span class="font-bold text-[#9acb03]" x-text="form.slug || '{{ $tenant->slug ?? 'nama-usaha' }}'"></span>
                            </div>
                        </div>

                        {{-- Custom Domain Search --}}
                        <div x-show="form.domain_type === 'custom'" class="space-y-4">
                            <p class="text-sm text-muted font-light">Ketik nama usaha Anda tanpa ektensi (.com) untuk melihat rekomendasi.</p>
                            <div class="flex gap-2">
                                <input type="text" x-model="domainQuery" @keydown.enter.prevent="searchDomain()"
                                    class="w-full px-4 py-2.5 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03]"
                                    placeholder="contoh: kedaikopi">
                                <button @click="searchDomain()" :disabled="searchingDomain"
                                    class="px-5 py-2.5 rounded-xl font-bold text-sm text-white bg-[#075749] hover:bg-[#053d33] transition-colors shrink-0 flex items-center justify-center min-w-[80px]">
                                    <span x-show="!searchingDomain">Cari</span>
                                    <svg x-show="searchingDomain" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                </button>
                            </div>

                            {{-- Results Grid --}}
                            <div x-show="domainResults.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-48 overflow-y-auto pr-1 custom-scrollbar">
                                <template x-for="(result, idx) in domainResults" :key="idx">
                                    <div class="p-3 rounded-xl border flex items-center justify-between cursor-pointer transition-all"
                                         :class="result.available ? (form.domain_name === result.domain ? 'border-[#9acb03] bg-green-50 dark:bg-green-900/20' : 'border-theme hover:border-[#9acb03]/50') : 'border-theme bg-gray-50 dark:bg-gray-800/50 opacity-60 cursor-not-allowed'"
                                         @click="result.available && (form.domain_name = result.domain)">
                                        <div>
                                            <span class="font-medium text-sm text-fg" x-text="result.domain"></span>
                                            <p class="text-[10px] font-bold" :class="result.available ? 'text-[#9acb03]' : 'text-red-500'" x-text="result.available ? 'Tersedia' : 'Tidak Tersedia'"></p>
                                        </div>
                                        <div x-show="result.available && form.domain_name === result.domain" class="w-5 h-5 rounded-full bg-[#9acb03] text-white flex items-center justify-center shrink-0">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                    <div class="mt-6 pt-4 border-t border-theme flex justify-between gap-3">
                        <button @click="step = 1" class="px-6 py-2.5 rounded-xl text-sm font-semibold text-muted hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            Kembali
                        </button>
                        <button @click="saveStep2()" :disabled="saving"
                            class="px-8 py-2.5 rounded-xl font-bold text-sm text-[#053d33] shadow-md hover:shadow-lg transition-all duration-200 disabled:opacity-50"
                            style="background: #9acb03;">
                            <span x-show="!saving">Konfirmasi</span>
                            <span x-show="saving">Memproses...</span>
                        </button>
                    </div>
                </div>

                {{-- ===================== STEP 3: Loading/Redirecting ===================== --}}
                <div x-show="step === 3" style="display:none" class="flex-1 flex flex-col items-center justify-center text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center text-green-500 mb-4 animate-bounce">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-fg mb-2">Profil Tersimpan!</h2>
                    <p class="text-muted text-sm font-light mb-6">Mengarahkan Anda ke halaman selanjutnya...</p>
                    <svg class="w-6 h-6 animate-spin text-[#9acb03]" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    
                    <a href="{{ route('tenant.dashboard') }}" class="mt-8 text-xs text-[#9acb03] underline">Jika tidak diarahkan otomatis, klik di sini.</a>
                </div>

            </div>
        </div>

        <div class="text-center mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs text-muted hover:text-red-500 transition-colors font-light">Keluar dari akun</button>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<style>
/* Custom Scrollbar for results */
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #075749; border-radius: 4px; }
</style>
<script>
function onboardingWizard() {
    return {
        step: {{ ($tenant->onboarding_step ?? 1) >= 3 ? 3 : ($tenant->onboarding_step ?? 1) }},
        saving: false,
        searchingDomain: false,
        alertMessage: '',
        alertType: 'error',
        domainQuery: '',
        domainResults: [],

        form: {
            business_name:     '{{ $tenant->business_name ?? '' }}',
            slug:              '{{ $tenant->slug ?? '' }}',
            business_type:     '{{ $tenant->business_type ?? '' }}',
            whatsapp:          '{{ $tenant->whatsapp ?? '' }}',
            city:              '{{ $tenant->city ?? '' }}',
            domain_type:       '{{ ($tenant->plan ?? "free") === "pro" ? "custom" : "free" }}',
            domain_name:       '',
        },

        init() {
            if (this.step === 3) {
                setTimeout(() => { window.location.href = '{{ route("tenant.dashboard") }}'; }, 2000);
            }
        },

        generateSlug() {
            if (this.step === 1 && !this.form.slug) {
                this.form.slug = this.form.business_name.toLowerCase().replace(/[^a-z0-9\-]/g, '');
            }
        },

        async saveStep1() {
            if (!this.form.business_name || !this.form.business_type || !this.form.slug) {
                this.showAlert('Nama Usaha, Kategori, dan Slug wajib diisi.', 'error');
                return;
            }
            this.saving = true;
            this.alertMessage = '';

            try {
                const res = await fetch('{{ route("onboarding.profile") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
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
                this.showAlert('Pilih domain yang tersedia terlebih dahulu.', 'error');
                return;
            }
            this.saving = true;

            try {
                const res = await fetch('{{ route("onboarding.domain") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: JSON.stringify(this.form),
                });
                const data = await res.json();
                if (data.success) {
                    this.step = 3;
                    setTimeout(() => { window.location.href = '{{ route("tenant.dashboard") }}'; }, 1500);
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
            this.form.domain_name = '';

            try {
                const res = await fetch('{{ route("api.check-domain") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: JSON.stringify({ domain: this.domainQuery.trim() }),
                });
                const data = await res.json();
                if (data.success) {
                    this.domainResults = data.results;
                }
            } catch (e) {
                this.showAlert('Gagal mengecek domain.', 'error');
            }
            this.searchingDomain = false;
        },

        showAlert(msg, type = 'error') {
            this.alertMessage = msg;
            this.alertType = type;
            setTimeout(() => { this.alertMessage = ''; }, 5000);
        }
    };
}
</script>
@endpush
@endsection
