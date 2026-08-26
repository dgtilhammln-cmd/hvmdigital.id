{{-- resources/views/layouts/partials/seo-meta.blade.php --}}

@php
    // Force canonical ke domain produksi agar Google tidak melihat URL localhost
    $_currentUrl = $seo['canonical'] ?? url()->current();
    if (str_contains($_currentUrl, 'localhost') || str_contains($_currentUrl, '127.0.0.1')) {
        $_currentUrl = preg_replace('#https?://[^/]+(/public_html/public)?#', 'https://hvm-digital.id', $_currentUrl);
    }
    $_canonicalUrl = rtrim($_currentUrl, '/');
@endphp

{{-- === BASIC META === --}}
<title>{{ $seo['title'] ?? config('hvm.name') }}</title>
<meta name="description" content="{{ $seo['description'] ?? '' }}">
@if(!empty($seo['keywords']))<meta name="keywords" content="{{ $seo['keywords'] }}">@endif
<meta name="author" content="{{ $seo['author'] ?? config('hvm.name') }}">
<meta name="robots" content="{{ $seo['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
<meta name="language" content="Indonesian">
<meta name="revisit-after" content="7 days">
<meta name="rating" content="general">
<link rel="canonical" href="{{ $_canonicalUrl }}">

{{-- === GEO META (Local SEO) === --}}
<meta name="geo.region" content="{{ $seo['geo_region'] ?? 'ID' }}">
<meta name="geo.placename" content="{{ $seo['geo_placename'] ?? 'Indonesia' }}">
<meta name="geo.position" content="{{ $seo['geo_position'] ?? '-0.7893;113.9213' }}">
<meta name="ICBM" content="{{ $seo['icbm'] ?? '-0.7893, 113.9213' }}">

{{-- === OPEN GRAPH (Facebook, WhatsApp, LinkedIn, Telegram, etc.) === --}}
<meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
<meta property="og:url" content="{{ $_canonicalUrl }}">
<meta property="og:title" content="{{ $seo['og_title'] ?? ($seo['title'] ?? config('hvm.name')) }}">
<meta property="og:description" content="{{ $seo['og_description'] ?? ($seo['description'] ?? '') }}">
<meta property="og:image" content="{{ $seo['og_image'] ?? asset('images/logohvm.png') }}">
<meta property="og:image:secure_url" content="{{ $seo['og_image'] ?? asset('images/logohvm.png') }}">
@php
$_ogImg = $seo['og_image'] ?? asset('images/logohvm.png');
$_ogExt = strtolower(pathinfo(parse_url($_ogImg, PHP_URL_PATH), PATHINFO_EXTENSION));
$_ogMime = match($_ogExt) { 'png' => 'image/png', 'jpg','jpeg' => 'image/jpeg', default => 'image/webp' };
@endphp
<meta property="og:image:type" content="{{ $_ogMime }}">
<meta property="og:image:width" content="{{ $seo['og_image_width'] ?? '1200' }}">
<meta property="og:image:height" content="{{ $seo['og_image_height'] ?? '630' }}">
<meta property="og:image:alt" content="{{ $seo['og_title'] ?? ($seo['title'] ?? config('hvm.name')) }}">
<meta property="og:site_name" content="{{ $seo['og_site_name'] ?? config('hvm.name') }}">
<meta property="og:locale" content="{{ $seo['og_locale'] ?? 'id_ID' }}">
<meta property="og:locale:alternate" content="en_US">
@if(!empty($seo['og_updated_time']))<meta property="og:updated_time" content="{{ $seo['og_updated_time'] }}">@endif
@if(!empty($seo['article_published_time']))<meta property="article:published_time" content="{{ $seo['article_published_time'] }}">@endif
@if(!empty($seo['article_modified_time']))<meta property="article:modified_time" content="{{ $seo['article_modified_time'] }}">@endif

{{-- === TWITTER / X CARD === --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ setting('twitter_handle','@hvmdigital') }}">
<meta name="twitter:creator" content="{{ setting('twitter_handle','@hvmdigital') }}">
<meta name="twitter:title" content="{{ $seo['twitter_title'] ?? ($seo['title'] ?? config('hvm.name')) }}">
<meta name="twitter:description" content="{{ $seo['twitter_description'] ?? ($seo['description'] ?? '') }}">
<meta name="twitter:image" content="{{ $seo['twitter_image'] ?? ($seo['og_image'] ?? asset('images/logohvm.png')) }}">
<meta name="twitter:image:alt" content="{{ $seo['og_title'] ?? ($seo['title'] ?? config('hvm.name')) }}">
<meta name="twitter:domain" content="{{ parse_url(config('app.url'), PHP_URL_HOST) === 'localhost' ? 'hvm-digital.id' : parse_url(config('app.url'), PHP_URL_HOST) }}">

{{-- === JSON-LD SCHEMAS === --}}
@if(!empty($seo['schemas']))
    @foreach($seo['schemas'] as $schema)
    <script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endforeach
@endif
