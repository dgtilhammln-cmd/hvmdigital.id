<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Error') — {{ config('hvm.name', 'HVM Digital') }}</title>
    <meta name="description" content="@yield('description', 'Terjadi kesalahan pada halaman ini.')">

    {{-- Favicon --}}
    @php $faviconUrl = function_exists('setting') && setting('favicon') ? get_image_url(setting('favicon')) : asset('favicon.ico'); @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"></noscript>

    {{-- Dark mode: apply instantly to prevent flash --}}
    <script>
        (function(){
            var t = localStorage.getItem('hvm-theme');
            var d = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (t === 'dark' || (t === null && d)) { document.documentElement.classList.add('dark'); }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-montserrat antialiased bg-surface text-fg" x-data="{ mobileMenu: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)">

    {{-- Navbar --}}
    @include('layouts.partials.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    {{-- WhatsApp Floating Button --}}
    @include('layouts.partials.wa-button')

    {{-- Theme Toggle Script --}}
    <script>
        function toggleTheme() {
            var html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('hvm-theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('hvm-theme', 'dark');
            }
        }
        function trackWaClick(source) {}
    </script>
</body>
</html>
