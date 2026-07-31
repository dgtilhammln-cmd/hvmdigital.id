<?php
/**
 * Generate placeholder city icons as SVG-based PNG files
 * Run: php scripts/generate-city-icons.php
 */

$cities = [
    'surabaya'   => ['label' => 'Surabaya',   'icon' => 'SBY', 'color' => '#075749'],
    'jakarta'    => ['label' => 'Jakarta',    'icon' => 'JKT', 'color' => '#0d6efd'],
    'malang'     => ['label' => 'Malang',     'icon' => 'MLG', 'color' => '#075749'],
    'bandung'    => ['label' => 'Bandung',    'icon' => 'BDG', 'color' => '#6610f2'],
    'semarang'   => ['label' => 'Semarang',   'icon' => 'SMG', 'color' => '#075749'],
    'yogyakarta' => ['label' => 'Yogyakarta', 'icon' => 'YGY', 'color' => '#9acb03'],
    'solo'       => ['label' => 'Solo',       'icon' => 'SLO', 'color' => '#075749'],
    'bekasi'     => ['label' => 'Bekasi',     'icon' => 'BKS', 'color' => '#075749'],
    'palembang'  => ['label' => 'Palembang',  'icon' => 'PLG', 'color' => '#dc3545'],
    'denpasar'   => ['label' => 'Bali',       'icon' => 'BAL', 'color' => '#fd7e14'],
    'banyuwangi' => ['label' => 'Banyuwangi', 'icon' => 'BWI', 'color' => '#075749'],
    'gresik'     => ['label' => 'Gresik',     'icon' => 'GRS', 'color' => '#075749'],
    'sidoarjo'   => ['label' => 'Sidoarjo',   'icon' => 'SDJ', 'color' => '#075749'],
    'lamongan'   => ['label' => 'Lamongan',   'icon' => 'LMG', 'color' => '#075749'],
    'ngawi'      => ['label' => 'Ngawi',      'icon' => 'NGW', 'color' => '#075749'],
    'purwokerto' => ['label' => 'Purwokerto', 'icon' => 'PWK', 'color' => '#075749'],
    'medan'      => ['label' => 'Medan',      'icon' => 'MDN', 'color' => '#198754'],
    'samarinda'  => ['label' => 'Samarinda',  'icon' => 'SMD', 'color' => '#0dcaf0'],
    'makassar'   => ['label' => 'Makassar',   'icon' => 'MKS', 'color' => '#dc3545'],
    'balikpapan' => ['label' => 'Balikpapan', 'icon' => 'BPN', 'color' => '#0dcaf0'],
    'pekanbaru'  => ['label' => 'Pekanbaru',  'icon' => 'PKU', 'color' => '#198754'],
    'batam'      => ['label' => 'Batam',      'icon' => 'BTM', 'color' => '#0d6efd'],
    'padang'     => ['label' => 'Padang',     'icon' => 'PDG', 'color' => '#198754'],
    'manado'     => ['label' => 'Manado',     'icon' => 'MDO', 'color' => '#fd7e14'],
    'banjarmasin'=> ['label' => 'Banjarmasin','icon' => 'BJM', 'color' => '#6f42c1'],
    'pontianak'  => ['label' => 'Pontianak',  'icon' => 'PNK', 'color' => '#6f42c1'],
    'mataram'    => ['label' => 'Mataram',    'icon' => 'MTR', 'color' => '#fd7e14'],
    'bogor'      => ['label' => 'Bogor',      'icon' => 'BGR', 'color' => '#198754'],
    'depok'      => ['label' => 'Depok',      'icon' => 'DPK', 'color' => '#0d6efd'],
    'tangerang'  => ['label' => 'Tangerang',  'icon' => 'TNG', 'color' => '#0d6efd'],
    'cirebon'    => ['label' => 'Cirebon',    'icon' => 'CBN', 'color' => '#6f42c1'],
    'kediri'     => ['label' => 'Kediri',     'icon' => 'KDR', 'color' => '#075749'],
    'madiun'     => ['label' => 'Madiun',     'icon' => 'MDN', 'color' => '#075749'],
    'jember'     => ['label' => 'Jember',     'icon' => 'JBR', 'color' => '#075749'],
    'kupang'     => ['label' => 'Kupang',     'icon' => 'KPG', 'color' => '#fd7e14'],
    'jayapura'   => ['label' => 'Jayapura',   'icon' => 'JYP', 'color' => '#dc3545'],
];

$dir = __DIR__ . '/../public/images/cities/';

foreach ($cities as $key => $data) {
    $file = $dir . $key . '.png';
    if (file_exists($file)) { echo "EXISTS: $key.png\n"; continue; }

    // Create 200x200 placeholder PNG
    $img = imagecreatetruecolor(200, 200);
    $hex = ltrim($data['color'], '#');
    $r   = hexdec(substr($hex,0,2));
    $g   = hexdec(substr($hex,2,2));
    $b   = hexdec(substr($hex,4,2));
    $bg  = imagecolorallocate($img, $r, $g, $b);
    $white = imagecolorallocate($img, 255, 255, 255);
    imagefill($img, 0, 0, $bg);
    imagestring($img, 5, 65, 85, $data['icon'], $white);
    imagepng($img, $file);
    imagedestroy($img);
    echo "CREATED: $key.png\n";
}
echo "\nDone! Upload your real city icons to public/images/cities/ with the same filenames.\n";
