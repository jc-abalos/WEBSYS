<?php

$maxsize = 300 * 1024 * 1024;

$folder = "uploads/";

$allowed = array("xls", "xlsx", "csv");

if (!file_exists($folder)) {
    mkdir($folder);
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.php?error=Invalid request");
    exit;
}

if (!isset($_FILES['excel_file'])) {
    header("Location: index.php?error=No file selected");
    exit;
}

$file = $_FILES['excel_file'];

if ($file['error'] != 0) {
    header("Location: index.php?error=Upload failed");
    exit;
}

if ($file['size'] > $maxsize) {
    header("Location: index.php?error=File is too big");
    exit;
}

if ($file['size'] == 0) {
    header("Location: index.php?error=File is empty");
    exit;
}

$name = $file['name'];
$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    header("Location: index.php?error=Only xls, xlsx, csv allowed");
    exit;
}

$newname = time() . "_" . $name;
$path = $folder . $newname;

if (move_uploaded_file($file['tmp_name'], $path)) {
    $size = round($file['size'] / 1024 / 1024, 2);
    header("Location: index.php?success=1&file=" . $newname . "&size=" . $size);
    exit;
} else {
    header("Location: index.php?error=Could not save file");
    exit;
}

?>