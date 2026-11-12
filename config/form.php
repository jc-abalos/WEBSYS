<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background-color: white; padding: 30px; border: 2px solid #333; border-radius: 8px; width: 350px; }
        h2 { text-align: center; margin-top: 0; margin-bottom: 20px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px; }
        input[type="text"], input[type="email"], select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; margin-top: 25px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #555; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Student</h2>
        <form action="create.php" method="post" autocomplete="off">
            <label>Full Name</label>
            <input type="text" name="fullname" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Gender</label>
            <select name="gender" required>
                <option value="" disabled selected>-- Select --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <label>Course</label>
            <select name="course" required>
                <option value="" disabled selected>-- Select --</option>
                <option value="BSIT">BSIT</option>
                <option value="BSMATH">BSMATH</option>
            </select>

            <button type="submit">Submit</button>
        </form>
        <a href="index.php" class="back-link">&larr; Back to Dashboard</a>
    </div>
</body>
</html>