<?php
$target_dir = "uploads/";
$upload_ok = true;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

echo "<html><body style='background:#0f172a;color:#f1f5f9;font-family:sans-serif;padding:50px;text-align:center;'>";

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES["fileToUpload"]["tmp_name"]);
finfo_close($finfo);

if($mime !== "image/jpeg" && $mime !== "image/png") {
    echo "<h1>Security Alert</h1><p>File content does not match image/jpeg or image/png headers.</p>";
    $upload_ok = false;
}

if($image_type == "php") {
    echo "<h1>Forbidden</h1><p>.php files are not allowed.</p>";
    $upload_ok = false;
}

if ($upload_ok) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<h1>Success</h1><p>Image vaulted at: <a href='$target_file' style='color:#38bdf8'>$target_file</a></p>";
    }
}
echo "<br><a href='index.html' style='color:#94a3b8;'>Return</a></body></html>";
?>