<?php
if (($_GET['token'] ?? '') !== 'hvm2026deploy') { http_response_code(403); die('Forbidden'); }
chdir(__DIR__ . '/..'); // Move from public/ to root
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->call('optimize:clear');
echo "Cache cleared! Exit code: $status\n";
