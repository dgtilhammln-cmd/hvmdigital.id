{{-- Hidden SEO: kecamatan & keyword turunan (screen-reader accessible, not visible) --}}
<div class="sr-only" aria-hidden="true">
    @php
    $kota = $cityConfig['name'];
    $kecamatanList = implode(', ', $cityConfig['nearby'] ?? []);
    @endphp
    <p>Jasa pembuatan website {{ $kota }} termurah dan terpercaya. Website {{ $kota }} profesional terbaik. Jasa website {{ $kota }} terbaik berkualitas. HVM Digital melayani seluruh wilayah {{ $kota }} termasuk {{ $kecamatanList }}.</p>
    <p>Buat website {{ $kota }} murah berkualitas. Jasa web design {{ $kota }}. Pembuatan website toko online {{ $kota }}. Website company profile {{ $kota }}. Jasa SEO {{ $kota }}. Digital marketing {{ $kota }} terpercaya. Konsultan IT {{ $kota }}.</p>
</div>
