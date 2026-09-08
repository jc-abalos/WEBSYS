<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['old']);

function oldValue($field)
{
    global $old;
    return htmlspecialchars($old[$field] ?? '');
}

function errorMessage($field)
{
    global $errors;

    if (isset($errors[$field])) {
        return '<span style="color:red;">' . htmlspecialchars($errors[$field]) . '</span>';
    }

    return '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Resume Builder</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
        }

        .form-card {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 550px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border-top: 4px solid #007acc;
        }

        h2 {
            text-align: center;
            margin-top: 0;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            color: #888;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%;
            padding: 12px 15px;
            background-color: #2d2d2d;
            border: 1px solid #3d3d3d;
            border-radius: 6px;
            color: #fff;
            font-size: 15px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #007acc;
            box-shadow: 0 0 0 3px rgba(0, 122, 204, 0.2);
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .row .form-group {
            flex: 1;
        }

        .submit-btn {
            background-color: #007acc;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #005f9e;
        }
    </style>
</head>

<body>

    <div class="form-card">
        <h2>Resume Generator</h2>
        
        <form action="resume.php" method="POST">
            
            <div class="row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname"
                        value="<?= oldValue('fullname') ?>">
                    <?= errorMessage('fullname') ?>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email"
                        value="<?= oldValue('email') ?>">
                    <?= errorMessage('email') ?>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone"
                        value="<?= oldValue('phone') ?>">
                    <?= errorMessage('phone') ?>
                </div>

                <div class="form-group">
                    <label>City, Province</label>
                    <input type="text" name="address"
                        value="<?= oldValue('address') ?>"
                        placeholder="e.g., Binalonan, Pangasinan">
                    <?= errorMessage('address') ?>
                </div>
            </div>

            <div class="form-group">
                <label>Degree / Program</label>
                <input type="text" name="program"
                    value="<?= oldValue('program') ?>"
                    placeholder="e.g., BS Information Technology">
                <?= errorMessage('program') ?>
            </div>

            <div class="form-group">
                <label>Technical Skills</label>
                <input type="text" name="skills"
                    value="<?= oldValue('skills') ?>"
                    placeholder="e.g., Java, PHP, CSS, HTML, MySQL">
                <?= errorMessage('skills') ?>
            </div>

            <div class="form-group">
                <label>Project / Internship Title</label>
                <input type="text" name="project_title"
                    value="<?= oldValue('project_title') ?>">
                <?= errorMessage('project_title') ?>
            </div>

            <div class="form-group">
                <label>Institution / Company</label>
                <input type="text" name="company"
                    value="<?= oldValue('company') ?>"
                    placeholder="e.g., Pangasinan State University">
                <?= errorMessage('company') ?>
            </div>

            <div class="form-group">
                <label>Project Description</label>
                <input type="text" name="description"
                    value="<?= oldValue('description') ?>"
                    placeholder="Briefly describe what you built or did...">
                <?= errorMessage('description') ?>
            </div>

            <div class="form-group">
                <label>Tools Used</label>
                <input type="text" name="tools"
                    value="<?= oldValue('tools') ?>"
                    placeholder="e.g., XAMPP, phpMyAdmin, VS Code">
                <?= errorMessage('tools') ?>
            </div>

            <button type="submit" class="submit-btn">Compile Resume</button>
        </form>
    </div>

</body>
</html>