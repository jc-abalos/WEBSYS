<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit(); }

$sql = "SELECT u.*, uc.course_ID FROM User u 
        JOIN User_Course uc ON u.user_ID = uc.user_ID 
        WHERE u.user_ID = $id";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
    $middlename = mysqli_real_escape_string($mysqli, $_POST['middlename']);
    $birthdate = mysqli_real_escape_string($mysqli, $_POST['birthdate']);
    $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $course_id = mysqli_real_escape_string($mysqli, $_POST['course_id']);

    $check = mysqli_query($mysqli, "SELECT * FROM User WHERE Email = '$email' AND user_ID != $id");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Error: Email is already used!'); window.history.back();</script>";
        exit();
    }

    $sql_update = "UPDATE User SET Firstname='$firstname', Lastname='$lastname', Middlename='$middlename', 
                   Birthdate='$birthdate', Gender='$gender', Email='$email' WHERE user_ID=$id";
    mysqli_query($mysqli, $sql_update);

    mysqli_query($mysqli, "DELETE FROM User_Course WHERE user_ID=$id");
    mysqli_query($mysqli, "INSERT INTO User_Course (user_ID, course_ID) VALUES ('$id', '$course_id')");

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .form-container { background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h2 { text-align: center; color: #2c3e50; margin-top: 0; margin-bottom: 20px;}
        .row { display: flex; gap: 10px; }
        .col { flex: 1; }
        label { font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px; display: block; }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #f0ad4e; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 10px;}
        button:hover { background-color: #ec971f; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #6c757d; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Record</h2>
        <form action="edit.php?id=<?php echo $id; ?>" method="post" autocomplete="off">
            <div class="row">
                <div class="col">
                    <label>First Name</label>
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($row['Firstname']); ?>" required>
                </div>
                <div class="col">
                    <label>Last Name</label>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($row['Lastname']); ?>" required>
                </div>
            </div>
            
            <label>Middle Name</label>
            <input type="text" name="middlename" value="<?php echo htmlspecialchars($row['Middlename']); ?>" required>

            <div class="row">
                <div class="col">
                    <label>Birthdate</label>
                    <input type="date" name="birthdate" value="<?php echo $row['Birthdate']; ?>" required>
                </div>
                <div class="col">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="Male" <?php if($row['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if($row['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>
            </div>

            <label>Email (Must be unique)</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>

            <label>Select Course</label>
            <select name="course_id" required>
                <?php
                $courses = mysqli_query($mysqli, "SELECT * FROM Course WHERE status = 'on'");
                while($c = mysqli_fetch_assoc($courses)) {
                    $selected = ($c['Course_ID'] == $row['course_ID']) ? 'selected' : '';
                    echo "<option value='{$c['Course_ID']}' $selected>{$c['course_code']} - {$c['name']}</option>";
                }
                ?>
            </select>

            <button type="submit">Update Record</button>
        </form>
        <a href="index.php" class="back-link">&larr; Back to Dashboard</a>
    </div>
</body>
</html>
