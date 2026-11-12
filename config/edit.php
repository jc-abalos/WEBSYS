<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
    $course = mysqli_real_escape_string($mysqli, $_POST['course']);

    $check_email = "SELECT id FROM users WHERE email = '$email' AND id != $id";
    $check_result = mysqli_query($mysqli, $check_email);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Error: Email already used by another student!'); window.history.back();</script>";
        exit();
    } else {
        $update_sql = "UPDATE users SET fullname='$fullname', email='$email', gender='$gender', course='$course' WHERE id=$id";
        if (mysqli_query($mysqli, $update_sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background-color: #ffffff; padding: 30px 40px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; }
        .form-container h2 { text-align: center; color: #333; margin-bottom: 20px; }
        label { font-weight: 600; color: #555; margin-bottom: 5px; display: block; font-size: 14px; }
        input[type="text"], input[type="email"], select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 14px; transition: border-color 0.3s; }
        input[type="text"]:focus, input[type="email"]:focus, select:focus { border-color: #f0ad4e; outline: none; }
        button[type="submit"] { width: 100%; padding: 12px; background-color: #f0ad4e; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s; margin-top: 10px; }
        button[type="submit"]:hover { background-color: #ec971f; }
        .cancel-link { display: block; text-align: center; margin-top: 15px; font-size: 14px; color: #d9534f; text-decoration: none; font-weight: bold; }
        .cancel-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Student Details</h2>
        <form action="edit.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label>Full Name</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" required>

            <label>Email Address</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

            <label>Gender</label>
            <select name="gender" required>
                <option value="Male" <?php if($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>

            <label>Course</label>
            <select name="course" required>
                <option value="BSIT" <?php if($row['course'] == 'BSIT') echo 'selected'; ?>>BSIT</option>
                <option value="BSMATH" <?php if($row['course'] == 'BSMATH') echo 'selected'; ?>>BSMATH</option>
            </select>

            <button type="submit">Update Student</button>
        </form>
        <a href="index.php" class="cancel-link">Cancel and Go Back</a>
    </div>
</body>
</html>