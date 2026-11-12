<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $course = trim($_POST['course'] ?? '');

    $fullname_e = mysqli_real_escape_string($mysqli, $fullname);
    $email_e = mysqli_real_escape_string($mysqli, $email);
    $gender_e = mysqli_real_escape_string($mysqli, $gender);
    $course_e = mysqli_real_escape_string($mysqli, $course);

    $check_email_sql = "SELECT id FROM users WHERE email = '$email_e'";
    $check_result = mysqli_query($mysqli, $check_email_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Error: This email is already registered!'); window.history.back();</script>";
        exit();
    }

    $sql = "INSERT INTO users (fullname, email, gender, course) VALUES ('$fullname_e', '$email_e', '$gender_e', '$course_e')";

    if (mysqli_query($mysqli, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
}
?>