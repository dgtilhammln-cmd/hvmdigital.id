@extends('layouts.auth')

@section('content')
<section class="min-h-screen flex w-full">
    {{-- Left Side (Branding) --}}
    <div class="hidden lg:flex w-1/2 flex-col justify-between p-12 lg:p-16 relative">
        {{-- Logo (Just the image, no white box) --}}
        <div>
            <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-105">
                @php
                    $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
                @endphp
                <img src="{{ $logoUrl }}" alt="{{ setting('site_name', 'HVM Digital') }}" class="h-10 w-auto">
            </a>
        </div>

        {{-- Center Text --}}
        <div class="my-auto pt-16">
            <h1 class="text-5xl lg:text-6xl font-bold text-fg tracking-tight mb-6 leading-tight">
                Mulai<br>
                <span class="text-[#9acb03]">Sekarang.</span>
            </h1>
            <p class="text-muted text-lg font-light max-w-md leading-relaxed">
                Bergabunglah dengan ratusan UMKM lainnya untuk mendigitalkan bisnis Anda dengan HVM Digital.
            </p>
        </div>

        {{-- Footer Left --}}
        <div class="text-muted text-xs font-light tracking-wide">
            &copy; {{ date('Y') }} PT HVM Digital Solusindo
        </div>
    </div>

    {{-- Right Side (Form) --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 sm:p-12 lg:p-16 relative bg-white/5 dark:bg-black/20 backdrop-blur-xl border-l border-white/5 shadow-2xl overflow-y-auto max-h-screen custom-scrollbar">
        
        {{-- Mobile Logo --}}
        <div class="lg:hidden mb-8 text-center shrink-0">
            <a href="{{ route('home') }}" class="inline-block">
                @php
                    $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : asset('images/logohvm.png');
                @endphp
                <img src="{{ $logoUrl }}" alt="HVM Digital" class="h-8 w-auto mx-auto">
            </a>
        </div>

        <div class="w-full max-w-md mx-auto shrink-0">
            <div class="mb-8 text-center lg:text-left">
                <h2 class="text-3xl font-bold text-fg mb-2">Buat akun baru.</h2>
                <p class="text-muted text-sm font-light">Lengkapi data untuk membuat website Anda.</p>
            </div>

            @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 text-red-500 text-sm font-medium border border-red-500/20">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>&bull; {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4 lg:space-y-5">
                @csrf

                {{-- Name --}}
                <div class="relative group">
                    <label for="name" class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-transparent border-0 border-b-2 border-theme focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-fg font-medium text-base transition-colors"
                        placeholder="Contoh: Budi Santoso">
                </div>

                {{-- Email --}}
                <div class="relative group">
                    <label for="email" class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full bg-transparent border-0 border-b-2 border-theme focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-fg font-medium text-base transition-colors"
                        placeholder="nama@email.com">
                </div>

                {{-- Phone --}}
                <div class="relative group">
                    <label for="phone" class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wider">No. WhatsApp</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="w-full bg-transparent border-0 border-b-2 border-theme focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-fg font-medium text-base transition-colors"
                        placeholder="08123456789">
                </div>

                {{-- Password (Side by Side on desktop) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6 pt-2">
                    <div class="relative group">
                        <label for="password" class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wider">Password</label>
                        <div class="relative w-full flex items-center" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" name="password" id="password" required
                                class="w-full bg-transparent border-0 border-b-2 border-theme focus:border-[#9acb03] focus:ring-0 px-0 py-2 pr-10 text-fg font-medium text-base transition-colors"
                                placeholder="Min. 8 karakter">
                            
                            <button type="button" @click="show = !show" class="absolute right-0 p-2 text-muted hover:text-[#9acb03] focus:outline-none transition-colors">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display:none" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative group">
                        <label for="password_confirmation" class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wider">Konfirmasi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full bg-transparent border-0 border-b-2 border-theme focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-fg font-medium text-base transition-colors"
                            placeholder="Ulangi password">
                    </div>
                </div>

                {{-- Submit Button (Premium Lime) --}}
                <div class="pt-6">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-[#9acb03] text-[#053d33] text-sm font-bold shadow-[0_4px_20px_rgba(154,203,3,0.3)] hover:shadow-[0_4px_25px_rgba(154,203,3,0.5)] hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                        Buat Akun
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-muted font-light">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-fg hover:text-[#9acb03] transition-colors">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<style>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
</style>
@endpush
@endsection
