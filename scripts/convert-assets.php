<?php
/**
 * Jalankan script ini setelah upload gambar ke folder public/images/
 * php scripts/convert-assets.php
 * 
 * Letakkan gambar asli di public/images/ dengan nama:
 *   free-discussion.jpg  ATAU  free-discussion.png
 *   30menit-card.jpg     ATAU  30menit-card.png
 * 
 * Script ini akan otomatis konversi ke .webp
 */

$targets = [
    'free-discussion',
    '30menit-card',
];

$dir = __DIR__ . '/../public/images/';

foreach ($targets as $name) {
    $webp = $dir . $name . '.webp';

    // Cari source file (jpg atau png)
    $src = null;
    foreach (['.jpg', '.jpeg', '.png'] as $ext) {
        if (file_exists($dir . $name . $ext)) {
            $src = $dir . $name . $ext;
            break;
        }
    }

    if (!$src) {
        echo "SKIP: Tidak ada file {$name}.jpg/.jpeg/.png di $dir\n";
        continue;
    }

    $data = file_get_contents($src);
    $img  = @imagecreatefromstring($data);

    if (!$img) {
        echo "ERROR: Gagal baca $src\n";
        continue;
    }

    imagewebp($img, $webp, 88);
    imagedestroy($img);
    echo "OK: $webp (" . round(filesize($webp)/1024) . " KB) — source: $src\n";
}

echo "\nSelesai. Refresh halaman untuk melihat hasilnya.\n";
