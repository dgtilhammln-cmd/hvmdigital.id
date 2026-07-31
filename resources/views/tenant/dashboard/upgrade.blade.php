@extends('layouts.tenant')
@section('title', 'Upgrade Website')
@section('page-title', 'Upgrade Website')

@section('content')

<div x-data="upgradeWizard()" class="max-w-4xl mx-auto">
    
    {{-- Wizard Header --}}
    <div class="mb-8 flex items-center justify-between relative">
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-white/10 z-0 rounded-full"></div>
        <div class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-[#9acb03] z-0 rounded-full transition-all duration-500" :style="'width: ' + ((step - 1) / 2 * 100) + '%'"></div>
        
        <template x-for="i in 3" :key="i">
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors shadow-lg border-2"
                     :class="step >= i ? 'bg-[#9acb03] text-[#053d33] border-[#9acb03]' : 'bg-[#0d1f15] text-muted border-white/10'">
                    <span x-show="step <= i" x-text="i"></span>
                    <svg x-show="step > i" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="absolute -bottom-6 text-xs font-medium whitespace-nowrap"
                      :class="step >= i ? 'text-fg' : 'text-muted'"
                      x-text="['Pilih Domain', 'Pilih Fitur', 'Pembayaran'][i-1]"></span>
            </div>
        </template>
    </div>

    {{-- Main Card --}}
    <div class="bg-white/5 backdrop-blur-xl rounded-3xl border border-white/5 shadow-2xl overflow-hidden min-h-[500px] flex flex-col relative mt-12">
        
        {{-- Loading Overlay --}}
        <div x-show="loading" style="display:none" class="absolute inset-0 z-50 bg-[#0d1f15]/80 backdrop-blur-sm flex flex-col items-center justify-center">
            <svg class="w-10 h-10 animate-spin text-[#9acb03]" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
            <span class="mt-4 text-sm text-fg font-medium">Memproses...</span>
        </div>

        {{-- Step 1: Pilih Domain --}}
        <div x-show="step === 1" class="p-8 flex-1 flex flex-col" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
            <h2 class="text-2xl font-bold text-fg mb-2">Cari Nama Domain Profesional</h2>
            <p class="text-muted text-sm mb-6">Pilih alamat website (.com, .id, dll) yang mudah diingat pelanggan. Harga sudah termasuk pajak & biaya setup.</p>
            
            <div class="flex gap-3 mb-6">
                <input type="text" x-model="domainQuery" @keydown.enter="checkDomain"
                       class="flex-1 px-4 py-3 rounded-xl border border-white/10 bg-black/20 text-fg focus:outline-none focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all"
                       placeholder="Contoh: kedaikopi">
                <button @click="checkDomain" class="px-6 py-3 rounded-xl bg-[#075749] text-white font-bold hover:bg-[#053d33] transition-colors shrink-0">
                    Cari Domain
                </button>
            </div>

            {{-- Domain Results --}}
            <div x-show="domainResults.length > 0" class="flex-1 overflow-y-auto custom-scrollbar space-y-3 pr-2">
                <template x-for="(result, idx) in domainResults" :key="idx">
                    <label class="block cursor-pointer relative" :class="!result.available ? 'opacity-50' : ''">
                        <input type="radio" x-model="selectedDomain" :value="result" :disabled="!result.available" class="sr-only">
                        <div class="p-4 rounded-xl border-2 transition-all flex items-center justify-between"
                             :class="(selectedDomain && selectedDomain.domain === result.domain) ? 'border-[#9acb03] bg-green-900/10' : 'border-white/5 hover:border-white/20 bg-black/10'">
                            <div>
                                <span class="font-bold text-lg text-fg" x-text="result.domain"></span>
                                <div class="flex gap-2 items-center mt-1">
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full uppercase"
                                          :class="result.available ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400'"
                                          x-text="result.available ? 'Tersedia' : 'Sudah Digunakan'"></span>
                                </div>
                            </div>
                            <div class="text-right" x-show="result.available">
                                <span class="block font-bold text-[#9acb03]" x-text="result.price.total_formatted"></span>
                                <span class="text-xs text-muted">/ tahun</span>
                            </div>
                        </div>
                    </label>
                </template>
            </div>
            
            <div x-show="!domainResults.length && !loading" class="flex-1 flex flex-col items-center justify-center text-center text-muted">
                <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                <p>Masukkan nama usaha Anda untuk melihat ketersediaan domain.</p>
            </div>
        </div>

        {{-- Step 2: Pilih Fitur --}}
        <div x-show="step === 2" style="display:none" class="p-8 flex-1 flex flex-col" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
            <h2 class="text-2xl font-bold text-fg mb-2">Pilih Kebutuhan Fitur</h2>
            <p class="text-muted text-sm mb-6">Sesuaikan fitur dengan budget Anda. Hanya bayar apa yang Anda butuhkan.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1 overflow-y-auto custom-scrollbar pr-2 pb-4">
                <template x-for="(feature, idx) in availableFeatures" :key="idx">
                    <label class="cursor-pointer relative group">
                        <input type="checkbox" x-model="selectedFeatures" :value="feature.id" class="sr-only">
                        <div class="h-full p-4 rounded-xl border-2 transition-all flex flex-col justify-between"
                             :class="selectedFeatures.includes(feature.id) ? 'border-[#9acb03] bg-green-900/10' : 'border-white/5 hover:border-white/20 bg-black/10'">
                            <div>
                                <div class="flex items-start justify-between mb-2">
                                    <h4 class="font-bold text-sm text-fg" x-text="feature.name"></h4>
                                    <div class="w-5 h-5 rounded flex items-center justify-center shrink-0 border transition-colors"
                                         :class="selectedFeatures.includes(feature.id) ? 'bg-[#9acb03] border-[#9acb03] text-[#053d33]' : 'border-white/20 text-transparent group-hover:border-white/40'">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    </div>
                                </div>
                                <p class="text-xs text-muted mb-4 line-clamp-2" x-text="feature.desc"></p>
                            </div>
                            <span class="font-bold text-[#9acb03] text-sm" x-text="'Rp ' + feature.price.toLocaleString('id-ID')"></span>
                        </div>
                    </label>
                </template>
            </div>
        </div>

        {{-- Step 3: Pembayaran --}}
        <div x-show="step === 3" style="display:none" class="p-8 flex-1 flex flex-col" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
            <h2 class="text-2xl font-bold text-fg mb-6">Ringkasan Pesanan</h2>
            
            <div class="bg-black/20 rounded-xl border border-white/5 p-6 flex-1 mb-6">
                <div class="flex justify-between border-b border-white/10 pb-4 mb-4">
                    <div>
                        <h4 class="font-bold text-fg text-lg">Domain <span class="uppercase text-[#9acb03]" x-text="selectedDomain?.domain"></span></h4>
                        <p class="text-xs text-muted">Perpanjangan setiap 1 Tahun</p>
                    </div>
                    <div class="text-right font-bold text-fg" x-text="selectedDomain?.price.total_formatted"></div>
                </div>

                <h4 class="font-semibold text-sm text-fg mb-3">Fitur Tambahan:</h4>
                <ul class="space-y-3 mb-6 border-b border-white/10 pb-6">
                    <template x-for="featId in selectedFeatures" :key="featId">
                        <li class="flex justify-between text-sm">
                            <span class="text-muted" x-text="getFeature(featId).name"></span>
                            <span class="text-fg font-medium" x-text="'Rp ' + getFeature(featId).price.toLocaleString('id-ID')"></span>
                        </li>
                    </template>
                    <li x-show="selectedFeatures.length === 0" class="text-xs text-muted italic">Tidak ada fitur tambahan.</li>
                </ul>

                <div class="flex justify-between items-end">
                    <span class="text-sm text-muted uppercase tracking-wider font-bold">Total Pembayaran</span>
                    <span class="text-3xl font-bold text-[#9acb03]" x-text="'Rp ' + calculateTotal().toLocaleString('id-ID')"></span>
                </div>
            </div>
        </div>

        {{-- Wizard Footer (Navigasi) --}}
        <div class="p-6 border-t border-white/5 flex items-center justify-between bg-black/20 shrink-0">
            <button @click="step--" x-show="step > 1" class="px-6 py-2.5 rounded-xl border border-white/10 text-muted hover:text-fg hover:bg-white/5 font-semibold text-sm transition-colors">
                Kembali
            </button>
            <div x-show="step === 1" class="w-1"></div> {{-- Spacer --}}

            <button @click="nextStep()" :disabled="!canProceed()"
                    class="px-8 py-2.5 rounded-xl font-bold text-[#053d33] text-sm shadow-[0_0_20px_rgba(154,203,3,0.3)] hover:shadow-[0_0_30px_rgba(154,203,3,0.5)] transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                    style="background: #9acb03;">
                <span x-text="step === 3 ? 'Bayar Sekarang' : 'Lanjutkan'"></span>
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('upgradeWizard', () => ({
        step: 1,
        loading: false,
        domainQuery: '',
        domainResults: [],
        selectedDomain: null,
        
        availableFeatures: [
            { id: 'premium_theme', name: 'Tema Premium (Eksklusif)', desc: 'Pilihan tema dengan desain profesional, animasi halus, dan konversi tinggi.', price: 250000 },
            { id: 'seo_copywriting', name: 'Copywriting & SEO Basic', desc: 'Kami tuliskan teks halaman depan Anda agar menarik dan ramah mesin pencari.', price: 150000 },
            { id: 'custom_logo', name: 'Desain Logo Profesional', desc: 'Belum punya logo? Desainer kami akan buatkan 2 opsi logo elegan.', price: 100000 },
            { id: 'ecommerce', name: 'Fitur Katalog / Toko Online', desc: 'Tombol beli, keranjang belanja via WhatsApp, dan galeri produk tak terbatas.', price: 300000 },
        ],
        selectedFeatures: [],

        async checkDomain() {
            if(this.domainQuery.length < 3) return;
            this.loading = true;
            this.domainResults = [];
            this.selectedDomain = null;

            try {
                const res = await fetch('{{ route('tenant.upgrade.check') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ query: this.domainQuery })
                });
                const data = await res.json();
                if(data.success) {
                    this.domainResults = data.results;
                }
            } catch(e) {
                console.error(e);
                alert('Gagal mengecek domain. Silakan coba lagi.');
            } finally {
                this.loading = false;
            }
        },

        canProceed() {
            if(this.step === 1) return this.selectedDomain !== null;
            return true;
        },

        nextStep() {
            if(this.step < 3) {
                this.step++;
            } else {
                this.submitOrder();
            }
        },

        getFeature(id) {
            return this.availableFeatures.find(f => f.id === id);
        },

        calculateTotal() {
            let total = 0;
            if(this.selectedDomain) {
                total += this.selectedDomain.price.total;
            }
            this.selectedFeatures.forEach(id => {
                total += this.getFeature(id).price;
            });
            return total;
        },

        submitOrder() {
            this.loading = true;
            // Here we would call backend to generate Invoice & Snap Token
            setTimeout(() => {
                this.loading = false;
                alert('Fitur Midtrans Checkout sedang diintegrasikan. Terima Kasih!');
            }, 1000);
        }
    }));
});
</script>
@endpush
