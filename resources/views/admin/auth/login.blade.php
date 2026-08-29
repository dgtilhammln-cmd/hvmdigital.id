<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — HVM Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .glass-panel { background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border-top: 1px solid rgba(255,255,255,0.1); }
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: black !important;
        }
    </style>
</head>
<body class="antialiased bg-white min-h-screen flex text-gray-900">

    {{-- KIRI: Banner / Brand Area (Gradasi Hitam Murni) --}}
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 bg-gradient-to-br from-black via-zinc-900 to-black relative flex-col justify-between p-12 xl:p-20 overflow-hidden shadow-2xl z-10">
        {{-- Background Pattern/Glow (Tanpa kotak-kotak) --}}
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-zinc-800 rounded-full blur-[120px] opacity-30"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-zinc-700 rounded-full blur-[100px] opacity-20"></div>
        
        <div class="relative z-10">
            {{-- Logo Utama --}}
            <div class="mb-20">
                @php
                    $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
                @endphp
                <img src="{{ $logoUrl }}" alt="HVM Digital" class="h-10 object-contain">
            </div>

            <h1 class="text-white text-5xl xl:text-6xl font-black leading-tight tracking-tight mb-6">
                Welcome<br>
                Back!
            </h1>

            <p class="text-gray-300 text-lg font-light leading-relaxed max-w-md">
                Akses eksklusif untuk Admin dan Tim internal HVM Digital. Kelola seluruh aset digital, layanan, portofolio, hingga event dengan cepat dan efisien.
            </p>
        </div>

        <div class="relative z-10 text-gray-500 text-sm font-light tracking-wide">
            &copy; {{ date('Y') }} HVM Digital. All rights reserved.
        </div>
    </div>

    {{-- KANAN: Login Form --}}
    <div class="w-full lg:w-7/12 xl:w-1/2 flex flex-col justify-center px-8 sm:px-16 md:px-24 lg:px-20 xl:px-32 relative bg-white">
        {{-- Mobile Logo (Hanya tampil di mobile) --}}
        <div class="lg:hidden flex items-center mb-12 bg-black p-3 rounded-xl w-max">
            @php
                $logoDark = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
            @endphp
            <img src="{{ $logoDark }}" alt="HVM Digital" class="h-8 object-contain">
        </div>

        <div class="w-full max-w-md mx-auto lg:mx-0">
            <h2 class="text-3xl font-extrabold text-black mb-3 tracking-tight">Log in to your account</h2>
            <p class="text-gray-500 font-medium text-sm mb-10 leading-relaxed">
                Akses panel admin dibatasi hanya untuk staf internal.<br>
                <a href="{{ route('home') }}" class="text-black font-bold hover:underline underline-offset-4">Kembali ke website utama.</a>
            </p>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg mb-6 flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <div class="font-medium">{{ session('success') }}</div>
            </div>
            @endif
            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-lg mb-6 flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                <div class="font-medium">{{ session('error') }}</div>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-8">
                @csrf
                
                {{-- Username Field --}}
                <div class="relative group">
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus
                           class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-2.5 px-0 text-gray-900 text-base font-medium focus:outline-none focus:ring-0 focus:border-black peer transition-colors"
                           placeholder=" ">
                    <label class="absolute text-sm font-semibold text-gray-400 duration-300 transform -translate-y-6 scale-90 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-6">
                        Username
                    </label>
                    @error('username')<p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- Password Field --}}
                <div class="relative group pt-2">
                    <input type="password" name="password" required
                           class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-2.5 px-0 text-gray-900 text-base font-medium focus:outline-none focus:ring-0 focus:border-black peer transition-colors"
                           placeholder=" ">
                    <label class="absolute text-sm font-semibold text-gray-400 duration-300 transform -translate-y-6 scale-90 top-5 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-6">
                        Password
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit"
                            class="w-full bg-black text-white font-bold text-sm tracking-wide uppercase py-4 px-6 rounded-lg hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 transition-all duration-200 shadow-xl shadow-black/20">
                        Login Now
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
