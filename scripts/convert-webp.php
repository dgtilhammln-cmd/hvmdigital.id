<?php
// Robust image conversion using imagecreatefromstring
$files = [
    'C:/Users/dgtil/.gemini/antigravity/brain/895139d9-a9d4-44d9-ade1-113bd96cf2bf/hvm_free_discussion_1778870904705.png'
        => __DIR__ . '/../public/images/free-discussion.webp',
    'C:/Users/dgtil/.gemini/antigravity/brain/895139d9-a9d4-44d9-ade1-113bd96cf2bf/hvm_30menit_card_1778871174024.png'
        => __DIR__ . '/../public/images/30menit-card.webp',
];

foreach ($files as $src => $dst) {
    if (!file_exists($src)) { echo "NOT FOUND: $src\n"; continue; }
    $data = file_get_contents($src);
    $img  = @imagecreatefromstring($data);
    if (!$img) {
        // Try as JPEG
        $img = @imagecreatefromjpeg($src);
    }
    if (!$img) {
        echo "FAIL: could not decode $src (size=".strlen($data).")\n";
        // Copy as-is fallback
        copy($src, str_replace('.webp', '.png', $dst));
        echo "Copied as PNG fallback\n";
        continue;
    }
    imagewebp($img, $dst, 85);
    imagedestroy($img);
    echo "OK: $dst (".filesize($dst)." bytes)\n";
}
