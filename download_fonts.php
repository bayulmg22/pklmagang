<?php
$fonts = [
    'Rajdhani-Bold.ttf' => 'https://github.com/google/fonts/raw/main/ofl/rajdhani/Rajdhani-Bold.ttf',
    'Orbitron-Bold.ttf' => 'https://github.com/google/fonts/raw/main/ofl/orbitron/static/Orbitron-Bold.ttf',
];

if (!is_dir(__DIR__ . '/public/fonts')) {
    mkdir(__DIR__ . '/public/fonts', 0777, true);
}

foreach ($fonts as $name => $url) {
    $content = file_get_contents($url);
    if ($content !== false) {
        file_put_contents(__DIR__ . '/public/fonts/' . $name, $content);
        echo "Successfully downloaded $name\n";
    } else {
        echo "Failed to download $name\n";
    }
}
echo "Done.\n";
