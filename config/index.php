<?php
require 'config.php';

$search_keyword = $_GET['keyword'] ?? '';
$search_gender = $_GET['gender'] ?? '';
$search_date = $_GET['date_created'] ?? '';

$sql = "SELECT u.user_ID, u.Firstname, u.Lastname, u.Middlename, u.Birthdate, u.Gender, u.Email, u.Date_Created, 
               c.name AS course_name, c.course_code 
        FROM User u
        JOIN User_Course uc ON u.user_ID = uc.user_ID
        JOIN Course c ON uc.course_ID = c.Course_ID
        WHERE 1=1";

if (!empty($search_keyword)) {
    $kw = mysqli_real_escape_string($mysqli, $search_keyword);
    $sql .= " AND (u.Firstname LIKE '%$kw%' 
                OR u.Lastname LIKE '%$kw%' 
                OR u.Middlename LIKE '%$kw%' 
                OR c.description LIKE '%$kw%' 
                OR c.course_code LIKE '%$kw%')";
}

if (!empty($search_gender)) {
    $gen = mysqli_real_escape_string($mysqli, $search_gender);
    $sql .= " AND u.Gender = '$gen'";
}

if (!empty($search_date)) {
    $date = mysqli_real_escape_string($mysqli, $search_date);
    $sql .= " AND DATE(u.Date_Created) = '$date'";
}

$sql .= " ORDER BY u.user_ID DESC";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD System</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; padding: 20px; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h2 { margin-top: 0; color: #2c3e50; }
        .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .filter-box { background: #f8f9fa; padding: 15px; border-radius: 5px; border: 1px solid #e9ecef; margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; align-items: center;}
        .filter-box input, .filter-box select { padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; color: white; font-size: 14px; font-weight: 500; display: inline-block; transition: 0.2s;}
        .btn-add { background-color: #007bff; }
        .btn-search { background-color: #28a745; }
        .btn-clear { background-color: #6c757d; }
        .btn-edit { background-color: #ffc107; color: #212529; }
        .btn-delete { background-color: #dc3545; }
        .btn:hover { opacity: 0.85; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }
        th { background-color: #e9ecef; color: #495057; font-weight: 600; }
        tr:hover { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-actions">
            <h2>Student Records</h2>
            <a href="form.php" class="btn btn-add">+ Add New Record</a>
        </div>
        
        <form method="GET" action="index.php" class="filter-box">
            <input type="text" name="keyword" placeholder="Search name, desc, or code..." value="<?php echo htmlspecialchars($search_keyword); ?>" style="flex: 1; min-width: 250px;">
            <select name="gender">
                <option value="">All Genders</option>
                <option value="Male" <?php if($search_gender == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if($search_gender == 'Female') echo 'selected'; ?>>Female</option>
            </select>
            <label style="font-size: 14px; margin-right: 5px;">Date Created:</label>
            <input type="date" name="date_created" value="<?php echo htmlspecialchars($search_date); ?>">
            <button type="submit" class="btn btn-search">Search</button>
            <a href="index.php" class="btn btn-clear">Clear</a>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Course Details</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $fullname = htmlspecialchars($row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Lastname']);
                        echo "<tr>";
                        echo "<td>" . $row['user_ID'] . "</td>";
                        echo "<td><strong>" . $fullname . "</strong></td>";
                        echo "<td>" . date('M d, Y', strtotime($row['Birthdate'])) . "</td>";
                        echo "<td>" . $row['Gender'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['course_code']) . "</strong> - " . htmlspecialchars($row['course_name']) . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row['Date_Created'])) . "</td>"; 
                        echo "<td>
                                <a href='edit.php?id=" . $row['user_ID'] . "' class='btn btn-edit'>Edit</a> 
                                <a href='delete.php?id=" . $row['user_ID'] . "' class='btn btn-delete' onclick='return confirm(\"Delete this record?\");'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center;'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
