@extends('layouts.app')

@section('content')
<section class="min-h-screen flex bg-surface dark:bg-[#061009]">
    {{-- Left Side (Branding) --}}
    <div class="hidden lg:flex w-1/2 relative overflow-hidden flex-col justify-between p-12" style="background: linear-gradient(135deg, #075749, #053d33);">
        {{-- Background Pattern/Glow --}}
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-[#9acb03]/20 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 rounded-full bg-[#075749]/40 blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-16">
                @php $logoUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('images/logohvm.png'); @endphp
                <img src="{{ $logoUrl }}" alt="HVM Digital" class="w-10 h-10 rounded-xl shadow-lg bg-white p-1">
                <span class="font-bold text-2xl text-white">HVM<span class="text-[#9acb03]">Digital</span></span>
            </a>

            <h1 class="text-5xl font-bold text-white leading-tight mb-6">Mulai Transformasi <br><span class="text-[#9acb03]">Digital Anda!</span></h1>
            <p class="text-white/80 text-lg font-light max-w-md leading-relaxed mb-8">
                Bergabunglah dengan ratusan UMKM lainnya. Kami menyediakan platform dan dukungan terbaik untuk menyederhanakan bisnis Anda di era digital.
            </p>

            <div class="flex items-center gap-4 text-sm text-white/70 font-light">
                <div class="flex -space-x-3">
                    <img class="w-10 h-10 rounded-full border-2 border-[#075749]" src="https://i.pravatar.cc/100?img=1" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-[#075749]" src="https://i.pravatar.cc/100?img=2" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-[#075749]" src="https://i.pravatar.cc/100?img=3" alt="User">
                    <div class="w-10 h-10 rounded-full border-2 border-[#075749] bg-[#9acb03] flex items-center justify-center text-[#053d33] font-bold text-xs">+1k</div>
                </div>
                <span>Telah bergabung bersama kami</span>
            </div>
        </div>

        <div class="relative z-10 text-white/50 text-sm font-light">
            &copy; {{ date('Y') }} HVM Digital. All rights reserved.
        </div>
    </div>

    {{-- Right Side (Form) --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md">
            {{-- Mobile Logo --}}
            <div class="lg:hidden text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4 group">
                    @php $logoUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('images/logohvm.png'); @endphp
                    <img src="{{ $logoUrl }}" alt="HVM Digital" class="w-10 h-10 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                    <span class="font-bold text-xl text-fg">HVM<span class="text-lime">Digital</span></span>
                </a>
            </div>

            <div class="text-center lg:text-left mb-10">
                <h2 class="text-3xl font-bold text-fg mb-2">Buat Akun Baru</h2>
                <p class="text-muted text-sm font-light">Lengkapi data di bawah ini untuk memulai.</p>
            </div>

            @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30">
                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-fg mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3.5 rounded-xl border border-theme bg-card dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all shadow-sm"
                        placeholder="Contoh: Budi Santoso">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-fg mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3.5 rounded-xl border border-theme bg-card dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all shadow-sm"
                        placeholder="email@anda.com">
                </div>

                {{-- No. WhatsApp --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-fg mb-1.5">No. WhatsApp</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="w-full px-4 py-3.5 rounded-xl border border-theme bg-card dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all shadow-sm"
                        placeholder="08123456789">
                </div>

                {{-- Password --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="block text-sm font-medium text-fg mb-1.5">Password</label>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" name="password" id="password" required
                                class="w-full pl-4 pr-10 py-3.5 rounded-xl border border-theme bg-card dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all shadow-sm"
                                placeholder="Min. 8 karakter">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-muted hover:text-[#9acb03] transition-colors">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-fg mb-1.5">Konfirmasi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3.5 rounded-xl border border-theme bg-card dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-[#9acb03]/50 focus:border-[#9acb03] transition-all shadow-sm"
                            placeholder="Ulangi password">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full mt-2 py-4 rounded-xl font-bold text-sm text-[#053d33] shadow-lg hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-200"
                    style="background: #9acb03;">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-8 text-center text-sm font-light text-muted">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-[#075749] dark:text-[#9acb03] hover:underline">Masuk di sini</a>
            </div>
        </div>
    </div>
</section>
@endsection
