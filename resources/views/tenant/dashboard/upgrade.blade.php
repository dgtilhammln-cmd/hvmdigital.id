@extends('layouts.tenant')
@section('title', 'Upgrade Website')
@section('page-title', 'Upgrade Website')

@section('content')

<div x-data="upgradeWizard()" style="max-width: 860px;">
    
    {{-- Wizard Steps --}}
    <div class="panel" style="margin-bottom: 24px; padding: 20px 28px;">
        <div style="display: flex; align-items: center; gap: 0; position: relative;">
            {{-- Progress line --}}
            <div style="position: absolute; top: 20px; left: 0; right: 0; height: 2px; background: #e5e7eb; z-index: 0;"></div>
            <div :style="'position: absolute; top: 20px; left: 0; height: 2px; background: #9acb03; z-index: 1; transition: width 0.5s; width: ' + ((step - 1) / 2 * 100) + '%'"></div>
            
            <template x-for="(label, i) in ['Pilih Domain', 'Pilih Fitur', 'Pembayaran']" :key="i">
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center; position: relative; z-index: 2;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; transition: all 0.3s; border: 3px solid;"
                         :style="step > i + 1 ? 'background: #9acb03; color: #0d1f15; border-color: #9acb03;' : (step === i + 1 ? 'background: #075749; color: #fff; border-color: #075749;' : 'background: #fff; color: #9ca3af; border-color: #e5e7eb;')">
                        <svg x-show="step > i + 1" style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span x-show="step <= i + 1" x-text="i + 1"></span>
                    </div>
                    <span style="font-size: 11px; font-weight: 500; margin-top: 8px; white-space: nowrap;"
                          :style="step >= i + 1 ? 'color: #111827;' : 'color: #9ca3af;'"
                          x-text="label"></span>
                </div>
            </template>
        </div>
    </div>

    {{-- Content Card --}}
    <div class="panel" style="min-height: 420px; display: flex; flex-direction: column; position: relative;">
        
        {{-- Loading Overlay --}}
        <div x-show="loading" style="display:none; position:absolute; inset:0; background:rgba(255,255,255,0.8); z-index:50; display:none; flex-direction:column; align-items:center; justify-content:center; border-radius: 16px;" :style="loading ? 'display: flex' : 'display: none'">
            <svg style="width:36px;height:36px;animation:spin 1s linear infinite;color:#075749;" fill="none" viewBox="0 0 24 24"><circle style="opacity:.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path style="opacity:.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
            <span style="margin-top:12px;font-size:13px;color:#374151;font-weight:500;">Mengecek ketersediaan domain...</span>
        </div>
        <style>@keyframes spin { to { transform: rotate(360deg); } }</style>

        {{-- Step 1: Pilih Domain --}}
        <div x-show="step === 1" style="flex: 1; display: flex; flex-direction: column;">
            <h2 style="font-size:18px;font-weight:700;color:#111827;margin:0 0 6px;">Cari Nama Domain Profesional</h2>
            <p style="font-size:13px;color:#6b7280;margin:0 0 24px;">Pilih alamat website (.com, .id, dll) yang mudah diingat pelanggan. Harga sudah termasuk pajak & biaya setup.</p>
            
            <div style="display:flex;gap:12px;margin-bottom:20px;">
                <input type="text" x-model="domainQuery" @keydown.enter="checkDomain"
                       style="flex:1;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:10px;font-size:14px;color:#111827;outline:none;transition:border-color 0.2s;"
                       @focus="$el.style.borderColor='#075749'" @blur="$el.style.borderColor='#d1d5db'"
                       placeholder="Contoh: kedaikopi atau namadomain.com">
                <button @click="checkDomain" class="btn-primary" style="padding: 10px 22px; white-space: nowrap;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cari Domain
                </button>
            </div>

            {{-- Domain Results --}}
            <div x-show="domainResults.length > 0" style="flex:1;overflow-y:auto;max-height:320px;">
                <template x-for="(result, idx) in domainResults" :key="idx">
                    <label style="display:block;cursor:pointer;margin-bottom:10px;" :style="!result.available ? 'opacity:0.5;cursor:not-allowed;' : ''">
                        <input type="radio" x-model="selectedDomain" :value="result" :disabled="!result.available" style="display:none;">
                        <div style="padding:14px 18px;border-radius:12px;border:2px solid;display:flex;align-items:center;justify-content:space-between;transition:all 0.2s;"
                             :style="(selectedDomain && selectedDomain.domain === result.domain) ? 'border-color:#9acb03;background:#f0fdf4;' : 'border-color:#e5e7eb;background:#fff;'"
                             @click="result.available && (selectedDomain = result)">
                            <div>
                                <span style="font-weight:700;font-size:16px;color:#111827;" x-text="result.domain"></span>
                                <div style="margin-top:4px;">
                                    <span style="font-size:10px;font-weight:700;padding:2px 10px;border-radius:20px;"
                                          :style="result.available ? 'background:#dcfce7;color:#15803d;' : 'background:#fee2e2;color:#dc2626;'"
                                          x-text="result.available ? 'Tersedia' : 'Sudah Digunakan'"></span>
                                </div>
                            </div>
                            <div style="text-align:right;" x-show="result.available">
                                <span style="font-weight:700;color:#075749;font-size:15px;" x-text="result.price.total_formatted"></span><br>
                                <span style="font-size:11px;color:#9ca3af;">per tahun</span>
                            </div>
                        </div>
                    </label>
                </template>
            </div>
            
            <div x-show="!domainResults.length && !loading" style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;color:#9ca3af;padding:40px 0;">
                <svg style="width:56px;height:56px;margin-bottom:16px;opacity:0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                <p style="font-size:14px;margin:0;">Masukkan nama usaha Anda untuk melihat ketersediaan domain.</p>
            </div>
        </div>

        {{-- Step 2: Pilih Fitur --}}
        <div x-show="step === 2" style="display:none;flex:1;flex-direction:column;">
            <h2 style="font-size:18px;font-weight:700;color:#111827;margin:0 0 6px;">Pilih Fitur Tambahan</h2>
            <p style="font-size:13px;color:#6b7280;margin:0 0 24px;">Opsional — sesuaikan layanan dengan kebutuhan bisnis Anda. Bisa dilewati jika belum diperlukan.</p>
            
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:14px;overflow-y:auto;max-height:360px;">
                <template x-for="(feature, idx) in availableFeatures" :key="idx">
                    <div style="padding:16px;border-radius:12px;border:2px solid;cursor:pointer;transition:all 0.2s;height:100%;box-sizing:border-box;"
                         :style="selectedFeatures.includes(feature.id) ? 'border-color:#9acb03;background:#f0fdf4;' : 'border-color:#e5e7eb;background:#fff;'"
                         @click="toggleFeature(feature.id)">
                        <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:8px;">
                            <h4 style="font-size:13px;font-weight:600;color:#111827;margin:0;" x-text="feature.name"></h4>
                            <div style="width:20px;height:20px;border-radius:5px;border:2px solid;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s;"
                                 :style="selectedFeatures.includes(feature.id) ? 'background:#9acb03;border-color:#9acb03;' : 'border-color:#d1d5db;'">
                                <svg x-show="selectedFeatures.includes(feature.id)" style="width:12px;height:12px;" fill="none" stroke="#0d1f15" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <p style="font-size:12px;color:#6b7280;margin:0 0 10px;line-height:1.5;" x-text="feature.desc"></p>
                        <span style="font-weight:700;color:#075749;font-size:13px;" x-text="'+ Rp ' + feature.price.toLocaleString('id-ID')"></span>
                    </div>
                </template>
            </div>
        </div>

        {{-- Step 3: Pembayaran --}}
        <div x-show="step === 3" style="display:none;flex:1;flex-direction:column;">
            <h2 style="font-size:18px;font-weight:700;color:#111827;margin:0 0 24px;">Ringkasan Pesanan</h2>
            
            <div style="background:#f9fafb;border-radius:12px;border:1px solid #e5e7eb;padding:20px;flex:1;">
                <div style="display:flex;justify-content:space-between;padding-bottom:16px;margin-bottom:16px;border-bottom:1px solid #e5e7eb;">
                    <div>
                        <h4 style="font-size:15px;font-weight:700;color:#111827;margin:0 0 4px;">Domain <span style="color:#075749;text-transform:uppercase;" x-text="selectedDomain?.domain"></span></h4>
                        <p style="font-size:12px;color:#9ca3af;margin:0;">Perpanjangan setiap 1 Tahun</p>
                    </div>
                    <span style="font-size:15px;font-weight:700;color:#111827;" x-text="selectedDomain?.price.total_formatted"></span>
                </div>

                <h5 style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 12px;">Fitur Tambahan:</h5>
                <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid #e5e7eb;">
                    <template x-for="featId in selectedFeatures" :key="featId">
                        <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:13px;">
                            <span style="color:#374151;" x-text="getFeature(featId).name"></span>
                            <span style="color:#111827;font-weight:500;" x-text="'Rp ' + getFeature(featId).price.toLocaleString('id-ID')"></span>
                        </div>
                    </template>
                    <p x-show="selectedFeatures.length === 0" style="font-size:12px;color:#9ca3af;font-style:italic;margin:0;">Tidak ada fitur tambahan dipilih.</p>
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;">Total Pembayaran</span>
                    <span style="font-size:26px;font-weight:800;color:#075749;" x-text="'Rp ' + calculateTotal().toLocaleString('id-ID')"></span>
                </div>
            </div>
        </div>

        {{-- Footer Nav --}}
        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:24px;padding-top:20px;border-top:1px solid #f0f0f0;">
            <button @click="step--" x-show="step > 1" class="btn-secondary">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>
            <div x-show="step === 1"></div>

            <button @click="nextStep()" :disabled="!canProceed()" class="btn-primary"
                    style="padding:10px 28px;font-size:14px;"
                    :style="!canProceed() ? 'opacity:0.5;cursor:not-allowed;' : ''">
                <span x-text="step === 3 ? 'Bayar Sekarang' : 'Lanjutkan'"></span>
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
            { id: 'premium_theme', name: 'Tema Premium (Eksklusif)', desc: 'Tema profesional dengan animasi halus dan konversi tinggi.', price: 250000 },
            { id: 'seo_copywriting', name: 'Copywriting & SEO Basic', desc: 'Kami tuliskan teks halaman depan Anda agar menarik dan ramah mesin pencari.', price: 150000 },
            { id: 'custom_logo', name: 'Desain Logo Profesional', desc: 'Belum punya logo? Desainer kami akan buatkan 2 opsi logo elegan.', price: 100000 },
            { id: 'ecommerce', name: 'Katalog / Toko Online', desc: 'Tombol beli via WhatsApp, dan galeri produk tak terbatas.', price: 300000 },
        ],
        selectedFeatures: [],

        async checkDomain() {
            if(this.domainQuery.length < 3) return;
            this.loading = true;
            this.domainResults = [];
            this.selectedDomain = null;

            try {
                const res = await fetch('{{ route("tenant.upgrade.check") }}', {
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
                alert('Gagal mengecek domain. Silakan coba lagi.');
            } finally {
                this.loading = false;
            }
        },

        toggleFeature(id) {
            const idx = this.selectedFeatures.indexOf(id);
            if(idx === -1) this.selectedFeatures.push(id);
            else this.selectedFeatures.splice(idx, 1);
        },

        canProceed() {
            if(this.step === 1) return this.selectedDomain !== null;
            return true;
        },

        nextStep() {
            if(this.step < 3) this.step++;
            else this.submitOrder();
        },

        getFeature(id) {
            return this.availableFeatures.find(f => f.id === id);
        },

        calculateTotal() {
            let total = this.selectedDomain ? this.selectedDomain.price.total : 0;
            this.selectedFeatures.forEach(id => {
                total += this.getFeature(id).price;
            });
            return total;
        },

        submitOrder() {
            this.loading = true;
            setTimeout(() => {
                this.loading = false;
                alert('Fitur Pembayaran Midtrans sedang dalam proses integrasi. Terima kasih!');
            }, 1000);
        }
    }));
});
</script>
@endpush
