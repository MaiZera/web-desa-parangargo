<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
echo 'Log path: ' . storage_path('logs/laravel.log') . PHP_EOL;
echo 'Config log channel: ' . config('logging.default') . PHP_EOL;
