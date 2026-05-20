<?php
$url = 'https://github.com/google/fonts/raw/main/ofl/orbitron/Orbitron%5Bwght%5D.ttf';
$content = file_get_contents($url);
if ($content !== false) {
    file_put_contents(__DIR__ . '/public/fonts/Orbitron-Bold.ttf', $content);
    echo "Successfully downloaded Orbitron-Bold.ttf\n";
} else {
    echo "Failed to download Orbitron-Bold.ttf\n";
}
