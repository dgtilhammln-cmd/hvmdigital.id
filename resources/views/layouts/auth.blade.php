<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HVM Digital') }} - Auth</title>

    @php
        $faviconUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('favicon.ico');
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}">
    
    {{-- Direct Google Fonts for guaranteed loading without JS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        (function(){
            var t=localStorage.getItem('hvm-theme');
            var d=window.matchMedia('(prefers-color-scheme: dark)').matches;
            if(t==='dark'||(t===null&&d)){document.documentElement.classList.add('dark');}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-montserrat antialiased bg-surface text-fg min-h-screen relative overflow-x-hidden">
    {{-- Global Background Gradient/Glow identical to Homepage --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-[#9acb03]/10 dark:bg-[#9acb03]/15 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 rounded-full bg-[#075749]/20 dark:bg-[#075749]/30 blur-3xl"></div>
    </div>

    <main class="relative z-10">
        @yield('content')
    </main>
    
    @stack('scripts')
</body>
</html>
