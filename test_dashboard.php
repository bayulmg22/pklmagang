<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Rendering admin dashboard...\n";
    echo view('admin.dashboard', ['stats' => ['total_interns' => 0, 'pending' => 0, 'active' => 0, 'alumni' => 0]])->render();
    echo "\nDashboard OK\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
