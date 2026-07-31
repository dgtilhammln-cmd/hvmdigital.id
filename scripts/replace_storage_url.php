<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$files = array_merge(
    glob(resource_path('views/*.blade.php')),
    glob(resource_path('views/**/*.blade.php')),
    glob(resource_path('views/**/**/*.blade.php')),
    glob(resource_path('views/**/**/**/*.blade.php'))
);

foreach($files as $f) {
    if (!$f) continue;
    $content = file_get_contents($f);
    if (strpos($content, 'Storage::url(') !== false) {
        $content = str_replace('Storage::url(', 'get_image_url(', $content);
        file_put_contents($f, $content);
        echo "Updated: " . basename($f) . "\n";
    }
}
