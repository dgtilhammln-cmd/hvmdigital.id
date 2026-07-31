@php
// ─── FAQ Priority: profile-specific ALWAYS first, DB generic only supplementary ───
$kota        = $cityConfig['name'];
$province    = $cityConfig['province'];
$profileFaqs = config("city-profiles.{$city}.faqs", []);
$dbFaqs      = $faqs ?? collect();

// Convert profile array FAQs to objects
$profileObjs = collect($profileFaqs)->map(fn($f) => (object)['question'=>$f['q'],'answer'=>$f['a']]);

// Build final list: profile FAQs first (city-specific), then DB if profile has <3
if ($profileObjs->count() >= 2) {
    // Good: enough city-specific FAQs, skip generic DB ones
    $allFaqs = $profileObjs->values()->toArray();
} elseif ($dbFaqs->count() > 0) {
    // Supplement profile with DB FAQs
    $allFaqs = $profileObjs->concat($dbFaqs)->values()->toArray();
} else {
    // Full generic fallback — at least uses $kota for differentiation
    $allFaqs = [
        (object)['question'=>"Berapa biaya jasa pembuatan website di {$kota}?",
                 'answer'=>"Harga website di {$kota} mulai dari Rp 2,5 juta (landing page) hingga Rp 15 juta (toko online lengkap). Kami sesuaikan paket dengan kebutuhan dan skala bisnis Anda — konsultasi gratis tanpa komitmen."],
        (object)['question'=>"Berapa lama pengerjaan website untuk bisnis di {$kota}?",
                 'answer'=>"Company profile: 7–14 hari kerja. Toko online: 14–21 hari. Website custom: 30–60 hari. Semua pengerjaan untuk klien {$kota} dilakukan dengan timeline transparan dan milestone yang jelas."],
        (object)['question'=>"Saya sudah aktif di Instagram dan TikTok. Kenapa masih butuh website?",
                 'answer'=>"Sosmed bagus untuk awareness, tapi tidak menjawab kebutuhan B2B. Mitra korporat, distributor, dan tim seleksi tender butuh dokumen yang bisa diverifikasi: alamat, legalitas, katalog terstruktur, halaman tentang perusahaan. Algoritma sosmed juga bisa berubah kapan saja. Website adalah aset digital yang Anda miliki sepenuhnya — tidak akan tiba-tiba shadow ban atau hilang reach."],
        (object)['question'=>"Apakah HVM Digital melayani klien {$kota} secara online?",
                 'answer'=>"Ya! Seluruh proses — konsultasi, desain, revisi, serah terima — dilakukan via WhatsApp, Zoom, dan Google Meet. Klien kami di {$kota} tidak perlu datang ke Surabaya."],
        (object)['question'=>"Apakah website bisa muncul di Google untuk pencarian di {$kota}?",
                 'answer'=>"Ya. Setiap website dilengkapi SEO on-page: meta title & description spesifik {$kota}, schema LocalBusiness, heading terstruktur, dan konten yang mengandung keyword relevan untuk pasar {$kota} dan {$province}."],
        (object)['question'=>"Apa yang termasuk dalam paket website HVM Digital untuk {$kota}?",
                 'answer'=>"Setiap paket termasuk: domain .com 1 tahun, hosting cepat 1 tahun, SSL gratis, desain responsif mobile-first, SEO dasar, integrasi WhatsApp, dan support teknis 1 tahun. Tidak ada biaya tersembunyi."],
    ];
}
@endphp

@if(count($allFaqs) > 0)
<section class="py-16 md:py-20 bg-[#f0fdf4] dark:bg-[#061009]" x-data="{ open: null }" id="faq">
    <div class="container mx-auto px-4 lg:px-8 max-w-3xl">
        <div class="text-center mb-10">
            <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Pertanyaan Umum</span>
            <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-3">
                FAQ — Jasa Website {{ $kota }}
            </h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-light">Pertanyaan yang sering ditanyakan calon klien kami di {{ $kota }} dan {{ $province }}</p>
        </div>
        <div class="space-y-3">
            @foreach($allFaqs as $idx => $faq)
            <div class="bg-white dark:bg-[#0d1f15] rounded-2xl border border-[#075749]/10 dark:border-[#9acb03]/10 overflow-hidden hover:border-[#9acb03]/30 transition-colors">
                <button @click="open==={{ $idx }}?open=null:open={{ $idx }}"
                        class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left hover:bg-[#f0fdf4] dark:hover:bg-[#111d16] transition-colors">
                    <span class="font-medium text-[#0a1f12] dark:text-white text-sm leading-snug">
                        {{ is_array($faq) ? $faq['question'] : $faq->question }}
                    </span>
                    <svg class="w-5 h-5 text-[#075749] dark:text-[#9acb03] shrink-0 transition-transform duration-200"
                         :class="open==={{ $idx }}?'rotate-45':''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
                <div x-show="open==={{ $idx }}" x-transition class="px-6 pb-5">
                    <p class="text-gray-500 dark:text-gray-400 font-light text-sm leading-relaxed">
                        {{ is_array($faq) ? $faq['answer'] : $faq->answer }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
