<?php
require 'config.php';

$search_name = $_GET['search_name'] ?? '';
$search_gender = $_GET['search_gender'] ?? '';
$search_course = $_GET['search_course'] ?? '';
$search_date_from = $_GET['date_from'] ?? '';
$search_date_to = $_GET['date_to'] ?? '';

$sql = "SELECT * FROM users WHERE 1=1";

if (!empty($search_name)) {
    $name_e = mysqli_real_escape_string($mysqli, $search_name);
    $sql .= " AND fullname LIKE '%$name_e%'";
}
if (!empty($search_gender)) {
    $gender_e = mysqli_real_escape_string($mysqli, $search_gender);
    $sql .= " AND gender = '$gender_e'";
}
if (!empty($search_course)) {
    $course_e = mysqli_real_escape_string($mysqli, $search_course);
    $sql .= " AND course = '$course_e'";
}
if (!empty($search_date_from)) {
    $date_from_e = mysqli_real_escape_string($mysqli, $search_date_from);
    $sql .= " AND DATE(date_created) >= '$date_from_e'";
}
if (!empty($search_date_to)) {
    $date_to_e = mysqli_real_escape_string($mysqli, $search_date_to);
    $sql .= " AND DATE(date_created) <= '$date_to_e'";
}

$sql .= " ORDER BY id DESC";
$result = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; border: 1px solid #ddd; }
        h2 { margin-top: 0; }
        .filter-box { background: #eee; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .filter-box input, .filter-box select { padding: 8px; margin-right: 5px; margin-bottom: 5px; border: 1px solid #ccc; border-radius: 3px; }
        .btn { padding: 8px 12px; border: none; border-radius: 3px; cursor: pointer; text-decoration: none; color: white; font-size: 14px; display: inline-block; }
        .btn-add { background-color: #007bff; margin-bottom: 15px; }
        .btn-search { background-color: #28a745; }
        .btn-clear { background-color: #6c757d; }
        .btn-edit { background-color: #ffc107; color: #333; }
        .btn-delete { background-color: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registered Students</h2>
        <a href="form.php" class="btn btn-add">+ Add New Student</a>

        <div class="filter-box">
            <form method="GET" action="index.php">
                <input type="text" name="search_name" placeholder="Search full name..." value="<?php echo htmlspecialchars($search_name); ?>">
                
                <select name="search_gender">
                    <option value="">Gender (All)</option>
                    <option value="Male" <?php if($search_gender == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($search_gender == 'Female') echo 'selected'; ?>>Female</option>
                </select>
                
                <select name="search_course">
                    <option value="">Course (All)</option>
                    <option value="BSIT" <?php if($search_course == 'BSIT') echo 'selected'; ?>>BSIT</option>
                    <option value="BSMATH" <?php if($search_course == 'BSMATH') echo 'selected'; ?>>BSMATH</option>
                </select>
                
                <input type="date" name="date_from" value="<?php echo htmlspecialchars($search_date_from); ?>">
                <input type="date" name="date_to" value="<?php echo htmlspecialchars($search_date_to); ?>">
                
                <button type="submit" class="btn btn-search">Search</button>
                <a href="index.php" class="btn btn-clear">Clear</a>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row['date_created'])) . "</td>"; 
                        echo "<td>
                                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a> 
                                <a href='delete.php?id=" . $row['id'] . "' class='btn btn-delete' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center;'>No students found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>