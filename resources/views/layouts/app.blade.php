<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="generator" content="Laravel">

    {{-- Favicon --}}
    @php
        $faviconUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('favicon.ico');
        $faviconExt = pathinfo($faviconUrl, PATHINFO_EXTENSION);
        $faviconType = 'image/x-icon';
        if ($faviconExt === 'png') $faviconType = 'image/png';
        elseif ($faviconExt === 'svg') $faviconType = 'image/svg+xml';
        elseif ($faviconExt === 'webp') $faviconType = 'image/webp';
        elseif (in_array($faviconExt, ['jpg', 'jpeg'])) $faviconType = 'image/jpeg';
    @endphp
<link rel="icon" href="{{ $faviconUrl }}" type="{{ $faviconType }}">
<link rel="apple-touch-icon" href="{{ $faviconUrl }}">
{{-- Tambah ini --}}
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    {{-- Google Fonts Preconnect & Montserrat (PAGESPEED OPTIMIZED: Asynchronous Non-Blocking Style Loading) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    </noscript>

    {{-- Google Tag Manager & Meta Pixel (PAGESPEED OPTIMIZED: Delayed Script Injection / Lazy Loading Tracking) --}}
    @php $gtmId = setting('gtm_id'); $pixelId = setting('meta_pixel_id'); @endphp
    @if($gtmId || $pixelId)
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://connect.facebook.net">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let trackingLoaded = false;
            function initTracking() {
                if (trackingLoaded) return;
                trackingLoaded = true;
 
                // --- Google Tag Manager ---
                @if($gtmId)
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $gtmId }}');
                @endif

                // --- Meta Pixel ---
                @if($pixelId)
                !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
                fbq('init','{{ $pixelId }}');
                fbq('track','PageView');
                @endif

                // Clean up event listeners
                ['scroll','mousemove','touchstart','keydown'].forEach(event => {
                    window.removeEventListener(event, initTracking, { passive: true });
                });
            }

            // Trigger tracking on first user interaction or after 3.5 seconds fallback
            ['scroll','mousemove','touchstart','keydown'].forEach(event => {
                window.addEventListener(event, initTracking, { passive: true, once: true });
            });
            setTimeout(initTracking, 3500);
        });
    </script>
    @if($pixelId)
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $pixelId }}&ev=PageView&noscript=1"/></noscript>
    @endif
    @endif
    
    {{-- Dark mode: apply class instantly to prevent flash --}}
    <script>
        (function(){
            var t=localStorage.getItem('hvm-theme');
            var d=window.matchMedia('(prefers-color-scheme: dark)').matches;
            if(t==='dark'||(t===null&&d)){document.documentElement.classList.add('dark');}
        })();
    </script>

    @include('layouts.partials.seo-meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="font-montserrat antialiased bg-surface text-fg" x-data="{ mobileMenu: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)">
    {{-- GTM noscript --}}
    @if($gtmId ?? null)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

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

    {{-- Lead Popup CRM --}}
    @include('layouts.partials.lead-popup')

    {{-- Tracking Script --}}
    <script>
        // Auto-track pageview (PAGESPEED OPTIMIZED: Delay & idleCallback execution to unlock main thread)
        window.addEventListener('load', function () {
            setTimeout(function() {
                if (typeof window.requestIdleCallback === 'function') {
                    window.requestIdleCallback(sendTrackingData);
                } else {
                    sendTrackingData();
                }
            }, 2000);

            function sendTrackingData() {
                fetch('/track/visitor', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        page_url: window.location.href,
                        page_title: document.title,
                        referer: document.referrer
                    })
                }).catch(() => {});
            }
        });

        // Track WA Click — attach to all .wa-btn elements
        function trackWaClick(source) {
            fetch('/track/wa-click', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    page_url: window.location.href,
                    page_title: document.title,
                    source: source || 'unknown'
                })
            }).catch(() => {});
        }
    </script>

    @stack('scripts')
</body>
</html>
