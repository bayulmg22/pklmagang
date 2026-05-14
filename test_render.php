<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Run controller method directly
    $controller = new \App\Http\Controllers\AdminController();
    echo "Rendering Attendances...\n";
    $controller->attendances()->render();
    echo "Attendances OK\n";
    
    echo "Rendering Journals...\n";
    $controller->journals()->render();
    echo "Journals OK\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
