@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center py-20 px-4 relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/10 blur-3xl dark:from-[#075749]/20 dark:to-[#9acb03]/5"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-gradient-to-tr from-[#9acb03]/10 to-[#075749]/10 blur-3xl dark:from-[#9acb03]/5 dark:to-[#075749]/20"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        {{-- Logo & Header --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-6 group">
                @php $logoUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('images/logohvm.png'); @endphp
                <img src="{{ $logoUrl }}" alt="HVM Digital" class="w-10 h-10 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                <span class="font-bold text-xl text-fg">HVM<span class="text-lime">Digital</span></span>
            </a>
            <h1 class="text-2xl md:text-3xl font-bold text-fg mb-2">Buat Website Usaha Anda</h1>
            <p class="text-muted text-sm font-light">Daftar gratis, buat website UMKM Anda dalam hitungan menit.</p>
        </div>

        {{-- Register Card --}}
        <div class="bg-card dark:bg-card-dark rounded-3xl border border-theme shadow-xl p-8">
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
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                            placeholder="Masukkan nama Anda">
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-fg mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                            placeholder="email@anda.com">
                    </div>
                </div>

                {{-- No. WhatsApp --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-fg mb-1.5">No. WhatsApp</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </div>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                            placeholder="08123456789">
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-fg mb-1.5">Password</label>
                    <div class="relative" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        </div>
                        <input :type="show ? 'text' : 'password'" name="password" id="password" required
                            class="w-full pl-10 pr-12 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                            placeholder="Minimal 8 karakter">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-muted hover:text-lime transition-colors">
                            <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-fg mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-theme bg-surface dark:bg-[#0d1f15] text-fg placeholder-muted/50 text-sm focus:outline-none focus:ring-2 focus:ring-lime/50 focus:border-lime transition-all"
                            placeholder="Ulangi password Anda">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full py-3.5 rounded-xl font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all duration-200"
                    style="background: linear-gradient(135deg, #075749, #9acb03);">
                    Daftar Sekarang — Gratis
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-theme"></div></div>
                <div class="relative flex justify-center text-xs"><span class="px-3 bg-card dark:bg-card-dark text-muted">Sudah punya akun?</span></div>
            </div>

            {{-- Login Link --}}
            <a href="{{ route('login') }}"
                class="block w-full py-3 rounded-xl text-center font-semibold text-sm border-2 border-[#075749] dark:border-[#9acb03] text-[#075749] dark:text-[#9acb03] hover:bg-[#075749]/5 dark:hover:bg-[#9acb03]/5 transition-all">
                Masuk ke Akun
            </a>
        </div>

        {{-- Footer --}}
        <p class="text-center text-muted text-xs mt-6 font-light">
            Dengan mendaftar, Anda menyetujui
            <a href="#" class="text-lime hover:underline">Syarat & Ketentuan</a> serta
            <a href="#" class="text-lime hover:underline">Kebijakan Privasi</a> HVM Digital.
        </p>
    </div>
</section>
@endsection
