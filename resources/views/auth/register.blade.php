@extends('layouts.auth')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-[#f0fdf4] dark:bg-[#0a1510] relative overflow-hidden p-4 sm:p-8">
    {{-- Decorative glows (from homepage) --}}
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#9acb03]/20 dark:bg-[#9acb03]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-[#075749]/10 dark:bg-[#075749]/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Modern Centered Card --}}
    <div class="w-full max-w-5xl bg-white dark:bg-[#0d1f15] rounded-3xl shadow-2xl overflow-hidden flex z-10 border border-[#075749]/5 dark:border-[#9acb03]/10">
        
        {{-- Left Side: Branding (Hidden on Mobile) --}}
        <div class="hidden lg:flex w-5/12 bg-[#0a1f12] p-12 flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-[#075749]/50 to-transparent"></div>
            
            {{-- Decorative pattern overlay --}}
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent bg-[length:20px_20px]"></div>

            <div class="relative z-10">
                <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-105">
                    @php
                        $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
                    @endphp
                    <img src="{{ $logoUrl }}" alt="{{ setting('site_name', 'HVM Digital') }}" class="h-10 w-auto">
                </a>
            </div>
            
            <div class="relative z-10 mt-16 mb-auto">
                <h1 class="text-4xl xl:text-5xl font-bold text-white leading-tight mb-6 tracking-tight">
                    Mulai <br>
                    <span class="text-[#9acb03]">Sekarang.</span>
                </h1>
                <p class="text-white/80 text-sm leading-relaxed font-light">
                    Bergabunglah dengan ratusan UMKM lainnya untuk mendigitalkan bisnis Anda. Buat akun gratis dan eksplorasi dashboard inovatif HVM Digital.
                </p>
            </div>
            
            <div class="relative z-10 text-white/50 text-xs font-light tracking-wide">
                &copy; {{ date('Y') }} PT HVM Orbit Studios
            </div>
        </div>

        {{-- Right Side: Register Form --}}
        <div class="w-full lg:w-7/12 p-8 sm:p-12 xl:p-16 flex flex-col justify-center relative overflow-y-auto max-h-[90vh] custom-scrollbar">
            <div class="text-center lg:text-left mb-8">
                {{-- Mobile Logo --}}
                <div class="lg:hidden mb-8 text-center flex justify-center">
                    <a href="{{ route('home') }}" class="inline-block">
                        @php
                            // Force dark logo on light bg if available
                            $mobileLogo = setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png');
                        @endphp
                        <img src="{{ $mobileLogo }}" alt="HVM Digital" class="h-10 w-auto">
                    </a>
                </div>

                <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-2">Buat Akun Baru</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light">Lengkapi data untuk memulai transformasi digital Anda.</p>
            </div>

            @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-600 dark:bg-red-500/10 dark:text-red-400 text-sm font-medium border border-red-200 dark:border-red-500/20">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>&bull; {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4 lg:space-y-5"
                x-data="{ 
                    password: '',
                    get hasLower() { return /[a-z]/.test(this.password) },
                    get hasNumber() { return /[0-9]/.test(this.password) },
                    get hasLength() { return this.password.length >= 8 },
                    get isValid() { return this.hasLower && this.hasNumber && this.hasLength }
                }">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-xs font-semibold text-[#075749] dark:text-[#9acb03] mb-1.5 uppercase tracking-widest">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-transparent border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 text-[#0a1f12] dark:text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-colors outline-none text-sm"
                        placeholder="Contoh: Budi Santoso">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold text-[#075749] dark:text-[#9acb03] mb-1.5 uppercase tracking-widest">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full bg-transparent border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 text-[#0a1f12] dark:text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-colors outline-none text-sm"
                        placeholder="nama@email.com">
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="block text-xs font-semibold text-[#075749] dark:text-[#9acb03] mb-1.5 uppercase tracking-widest">No. WhatsApp</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="w-full bg-transparent border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 text-[#0a1f12] dark:text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-colors outline-none text-sm"
                        placeholder="08123456789">
                </div>

                {{-- Password Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-5 pt-1">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-[#075749] dark:text-[#9acb03] mb-1.5 uppercase tracking-widest">Password</label>
                        <div class="relative w-full" x-data="{ show: false }">
                            <input x-model="password" x-bind:type="show ? 'text' : 'password'" type="password" name="password" id="password" required
                                class="w-full bg-transparent border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 pr-12 text-[#0a1f12] dark:text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-colors outline-none text-sm"
                                placeholder="Kombinasi huruf & angka">
                            
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-[#9acb03] focus:outline-none transition-colors">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display:none" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        
                        {{-- Password Validation Indicators --}}
                        <div class="mt-4 text-xs font-medium space-y-1">
                            <div :class="hasLength ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500'" class="flex items-center gap-1.5 transition-colors">
                                <svg x-show="hasLength" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <svg x-show="!hasLength" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"></circle></svg>
                                Minimal 8 karakter
                            </div>
                            <div :class="hasLower ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500'" class="flex items-center gap-1.5 transition-colors">
                                <svg x-show="hasLower" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <svg x-show="!hasLower" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"></circle></svg>
                                Minimal 1 huruf kecil
                            </div>
                            <div :class="hasNumber ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500'" class="flex items-center gap-1.5 transition-colors">
                                <svg x-show="hasNumber" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <svg x-show="!hasNumber" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"></circle></svg>
                                Minimal 1 angka
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-[#075749] dark:text-[#9acb03] mb-1.5 uppercase tracking-widest">Konfirmasi</label>
                        <div class="relative w-full" x-data="{ showConf: false }">
                            <input x-bind:type="showConf ? 'text' : 'password'" type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full bg-transparent border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 pr-12 text-[#0a1f12] dark:text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-colors outline-none text-sm"
                                placeholder="Ulangi password">
                            
                            <button type="button" @click="showConf = !showConf" class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-[#9acb03] focus:outline-none transition-colors">
                                <svg x-show="!showConf" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showConf" style="display:none" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        x-bind:disabled="!isValid"
                        x-bind:class="!isValid ? 'opacity-50 cursor-not-allowed grayscale' : 'hover:shadow-[0_8px_25px_rgba(154,203,3,0.4)] hover:-translate-y-0.5 active:translate-y-0'"
                        class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-[#9acb03] text-[#053d33] text-sm font-bold shadow-[0_8px_20px_rgba(154,203,3,0.25)] transition-all duration-200">
                        Buat Akun
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400 font-light">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-[#075749] dark:text-[#9acb03] hover:underline transition-all">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<style>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(7, 87, 73, 0.1); border-radius: 4px; }
@media (prefers-color-scheme: dark) {
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(154, 203, 3, 0.2); }
}
/* Hide default Edge/IE password reveal icon */
input[type="password"]::-ms-reveal,
input[type="password"]::-ms-clear {
    display: none;
}
</style>
@endpush
@endsection
