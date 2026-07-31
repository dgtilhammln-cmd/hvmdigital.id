<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$files = glob(resource_path('views/admin/careers/*.blade.php'));
foreach($files as $f) {
    $c = file_get_contents($f);
    $c = str_replace(
        ['internships', 'internship', 'Internships', 'Internship'],
        ['careers', 'career', 'Karir', 'Karir'],
        $c
    );
    file_put_contents($f, $c);
    echo "Updated: " . basename($f) . "\n";
}
