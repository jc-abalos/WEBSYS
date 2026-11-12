<!DOCTYPE html>
<html>
<head>
    <title>Excel Upload</title>
</head>
<body>

<h1>Upload Excel File</h1>
<p>Max size: 300 MB</p>
<p>Allowed: .xls, .xlsx, .csv</p>

<?php
// show success or error message if there is one
if (isset($_GET['success'])) {
    echo "<p>File uploaded successfully!</p>";
    echo "<p>Saved as: " . $_GET['file'] . "</p>";
    echo "<p>Size: " . $_GET['size'] . " MB</p>";
}

if (isset($_GET['error'])) {
    echo "<p>Error: " . $_GET['error'] . "</p>";
}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <p>
        <input type="file" name="excel_file" accept=".xls,.xlsx,.csv">
    </p>
    <p>
        <input type="submit" value="Upload">
    </p>
</form>

</body>
</html>