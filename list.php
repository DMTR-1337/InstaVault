<?php
header('Content-Type: application/json');

$directory = 'uploads/';
$files = [];

if (is_dir($directory)) {
    /*scandir gets everything; array_diff removes the current and parent directory markers*/
    $scanned = scandir($directory);
    if ($scanned !== false) {
        $files = array_diff($scanned, array('.', '..'));
    }
}

/* array_values ensures the JSON list is clean*/
echo json_encode(array_values($files));
?>