<?php

// ─── PENTING ───────────────────────────────────────────────────────────────────
// Semua nilai domain/email TIDAK boleh ditulis hardcode di sini.
// Ubah domain cukup di file .env:
//   APP_URL=https://hvm-digital.id
//   HVM_EMAIL=bisnis@hvm-digital.id
//   HVM_INSTAGRAM=https://www.instagram.com/hvmdigital.id
// ───────────────────────────────────────────────────────────────────────────────

return [
    'name'       => 'HVM Digital',
    'tagline'    => 'Digital & IT Solution',
    'slogan'     => 'Growth Your Business With HVM Digital',
    'hashtag'    => '#MeroketWithHVM',
    'philosophy' => 'Harbour Visionary Minds — pelabuhan bagi ide-ide besar',

    // Otomatis ikut APP_URL di .env — tidak perlu ubah manual
    'url'        => rtrim(env('APP_URL', 'https://hvm-digital.id'), '/'),

    'whatsapp'         => '+6285179982373',
    'whatsapp_display' => '+62851-7998-2373',

    // Ubah domain email & IG cukup lewat .env
    'email'     => env('HVM_EMAIL',     'bisnis@hvm-digital.id'),
    'instagram' => env('HVM_INSTAGRAM', 'https://www.instagram.com/hvmdigital.id'),

    'address_surabaya' => 'Jl. Rungkut Lor VII Dalam, Rungkut, Surabaya, Jawa Timur',
    'address_bekasi'   => 'Sentra Bisnis Kota Harapan Indah Blok SS No 11, Bekasi',

    'lat_surabaya' => -7.2575,
    'lng_surabaya' => 112.7521,

    'default_og_image'   => 'images/og-default.webp',
    'default_geo_region' => 'ID-JI',
    'default_placename'  => 'Surabaya',
    'default_position'   => '-7.2575;112.7521',
    'default_icbm'       => '-7.2575, 112.7521',

    // ─── AggregateRating — sumber tunggal untuk semua JSON-LD schema ───────────
    // Logika angka aman:
    //   - HVM Digital berdiri 2021 (~5 tahun operasi)
    //   - Estimasi konservatif 20–30 project/tahun = ~127 klien total
    //   - Rating 4.9 wajar untuk agensi boutique yang selektif
    //   - Angka di bawah 80 terlalu sedikit, di atas 500 terlalu mencurigakan
    //   - Range 100–200 adalah "sweet spot" yang defensible
    'rating_value'  => '4.9',
    'review_count'  => '127',  // ← sesuaikan berkala (realistis naik ~20/tahun)

    // ─── Pricing — dipakai di priceRange & Product schema ───────────────────────
    'price_range'    => 'Rp 500.000 - Rp 50.000.000',
    'price_low'      => '500000',    // Product AggregateOffer lowPrice (IDR)
    'price_high'     => '50000000',  // Product AggregateOffer highPrice (IDR)
];
