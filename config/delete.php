<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($mysqli, "DELETE FROM User_Course WHERE user_ID = $id");

    $sql = "DELETE FROM User WHERE user_ID = $id";

    if (mysqli_query($mysqli, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
} else {
    header("Location: index.php");
    exit();
}
?>
