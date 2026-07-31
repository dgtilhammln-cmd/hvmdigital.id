{{-- Pop-up form untuk Leads WA --}}
<div x-data="leadPopup()" 
     x-show="isOpen" 
     class="fixed inset-0 flex items-center justify-center p-4 sm:p-6"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 backdrop-blur-none"
     x-transition:enter-end="opacity-100 backdrop-blur-sm"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 backdrop-blur-sm"
     x-transition:leave-end="opacity-0 backdrop-blur-none"
     style="display: none; background: rgba(5, 61, 51, 0.6); z-index: 99999;">

    <div class="bg-white dark:bg-[#0d1f15] rounded-3xl w-full max-w-md shadow-2xl overflow-hidden relative border border-gray-100 dark:border-white/10"
         @click.away="closePopup()"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-8 scale-95">

        {{-- Header Modal --}}
        <div class="relative bg-gradient-to-br from-[#053d33] to-[#075749] p-6 text-center">
            <button @click="closePopup()" type="button" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-colors" aria-label="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="w-16 h-16 mx-auto bg-white/10 rounded-2xl flex items-center justify-center mb-3 backdrop-blur-md border border-white/20">
                <svg class="w-8 h-8 text-[#9acb03]" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-1">Mulai Konsultasi</h3>
            <p class="text-white/60 text-sm font-light">Isi form singkat ini untuk terhubung dengan spesialis kami di WhatsApp.</p>
        </div>

        {{-- Form Body --}}
        <div class="p-6">
            <form @submit.prevent="submitForm" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" x-model="formData.name" required placeholder="Budi Santoso" 
                           class="w-full bg-gray-50 dark:bg-[#061009] border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-[#0a1f12] dark:text-white focus:outline-none focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all">
                </div>
                
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="tel" x-model="formData.phone" required placeholder="081234567890" 
                           class="w-full bg-gray-50 dark:bg-[#061009] border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-[#0a1f12] dark:text-white focus:outline-none focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Nama Perusahaan/Bisnis <span class="text-gray-400 font-light">(Opsional)</span></label>
                    <input type="text" x-model="formData.company" placeholder="PT Maju Bersama" 
                           class="w-full bg-gray-50 dark:bg-[#061009] border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-[#0a1f12] dark:text-white focus:outline-none focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Kebutuhan Layanan <span class="text-red-500">*</span></label>
                    <textarea x-model="formData.needs" required placeholder="Saya butuh jasa pembuatan website untuk bisnis saya..." rows="2"
                              class="w-full bg-gray-50 dark:bg-[#061009] border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-[#0a1f12] dark:text-white focus:outline-none focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all resize-none"></textarea>
                </div>

                <div x-show="error" style="display: none;" class="bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 p-3 rounded-lg text-sm mb-4" x-text="errorMsg"></div>

                <button type="submit" :disabled="isLoading" 
                        class="w-full mt-2 flex items-center justify-center gap-2 font-bold px-6 py-4 rounded-xl text-white transition-all shadow-lg hover:shadow-xl disabled:opacity-70 disabled:cursor-not-allowed"
                        style="background:linear-gradient(135deg,#25d366,#128c7e);">
                    <span x-show="!isLoading">Lanjut ke WhatsApp</span>
                    <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    
                    {{-- Spinner --}}
                    <svg x-show="isLoading" style="display: none;" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-show="isLoading" style="display: none;">Memproses...</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('leadPopup', () => ({
            isOpen: false,
            isLoading: false,
            error: false,
            errorMsg: '',
            formData: {
                name: '',
                phone: '',
                company: '',
                needs: '',
                source_url: window.location.href
            },

            init() {
                // Listen for custom event to open popup
                window.addEventListener('open-lead-popup', (e) => {
                    if(e.detail && e.detail.needs) {
                        this.formData.needs = e.detail.needs;
                    }
                    this.isOpen = true;
                });
            },

            closePopup() {
                this.isOpen = false;
                this.error = false;
            },

            submitForm() {
                this.isLoading = true;
                this.error = false;

                fetch('{{ route("track.lead") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.formData)
                })
                .then(response => response.json())
                .then(data => {
                    this.isLoading = false;
                    if(data.status === 'success') {
                        this.closePopup();
                        // Redirect to WA
                        window.open(data.redirect_url, '_blank');
                    } else {
                        this.error = true;
                        this.errorMsg = data.message || 'Terjadi kesalahan, silakan coba lagi.';
                    }
                })
                .catch(error => {
                    this.isLoading = false;
                    this.error = true;
                    this.errorMsg = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                });
            }
        }));
    });

    // Helper to intercept regular WA links
    function triggerLeadPopup(needsText) {
        window.dispatchEvent(new CustomEvent('open-lead-popup', { detail: { needs: needsText } }));
    }

    // Intercept clicks on links that use javascript:triggerLeadPopup to prevent target="_blank" opening new tabs
    document.addEventListener('click', function(e) {
        let link = e.target.closest('a');
        if (link && link.getAttribute('href') && link.getAttribute('href').startsWith('javascript:triggerLeadPopup')) {
            e.preventDefault();
            // The function is either called by the browser or we call it here. 
            // To prevent double calling, we extract the message and call it manually if we prevented default.
            let href = link.getAttribute('href');
            let match = href.match(/triggerLeadPopup\(['"](.*)['"]\)/);
            let msg = match ? match[1] : '';
            triggerLeadPopup(msg);
        }
    });
</script>
