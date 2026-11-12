<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Record</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .form-container { background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h2 { text-align: center; color: #2c3e50; margin-top: 0; margin-bottom: 20px;}
        .row { display: flex; gap: 10px; }
        .col { flex: 1; }
        label { font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px; display: block; }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 10px;}
        button:hover { background-color: #0056b3; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #6c757d; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Record</h2>
        <form action="create.php" method="post" autocomplete="off">
            <div class="row">
                <div class="col">
                    <label>First Name</label>
                    <input type="text" name="firstname" required>
                </div>
                <div class="col">
                    <label>Last Name</label>
                    <input type="text" name="lastname" required>
                </div>
            </div>
            
            <label>Middle Name</label>
            <input type="text" name="middlename" required>

            <div class="row">
                <div class="col">
                    <label>Birthdate</label>
                    <input type="date" name="birthdate" required>
                </div>
                <div class="col">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="" disabled selected>Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <label>Email (Must be unique)</label>
            <input type="email" name="email" required>

            <label>Select Course</label>
            <select name="course_id" required>
                <option value="" disabled selected>Select Course</option>
                <?php
                require 'config.php';
                $courses = mysqli_query($mysqli, "SELECT * FROM Course WHERE status = 'on'");
                while($c = mysqli_fetch_assoc($courses)) {
                    echo "<option value='{$c['Course_ID']}'>{$c['course_code']} - {$c['name']}</option>";
                }
                ?>
            </select>

            <button type="submit">Save Record</button>
        </form>
        <a href="index.php" class="back-link">&larr; Back to Dashboard</a>
    </div>
</body>
</html>
