<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$f = resource_path('views/pages/careers/index.blade.php');
$c = file_get_contents($f);
$c = str_replace(
    ['internships', 'internship', 'Internships', 'Internship', 'intern', 'Intern'],
    ['careers', 'career', 'Karir', 'Karir', 'career', 'Career'],
    $c
);
file_put_contents($f, $c);
echo "Updated: " . basename($f) . "\n";
