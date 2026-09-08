<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$program = trim($_POST['program'] ?? '');
$skills = trim($_POST['skills'] ?? '');
$project_title = trim($_POST['project_title'] ?? '');
$company = trim($_POST['company'] ?? '');
$description = trim($_POST['description'] ?? '');
$tools = trim($_POST['tools'] ?? '');

$errors = [];

if ($fullname == '') {
    $errors['fullname'] = "Full name is required.";
}

if ($email == '') {
    $errors['email'] = "Email address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address.";
}

if ($phone == '') {
    $errors['phone'] = "Phone number is required.";
}

if ($address == '') {
    $errors['address'] = "Address is required.";
}

if ($program == '') {
    $errors['program'] = "Degree / Program is required.";
}

if ($skills == '') {
    $errors['skills'] = "Technical skills are required.";
}

if ($project_title == '') {
    $errors['project_title'] = "Project / Internship title is required.";
}

if ($company == '') {
    $errors['company'] = "Institution / Company is required.";
}

if ($description == '') {
    $errors['description'] = "Project description is required.";
}

if ($tools == '') {
    $errors['tools'] = "Tools used is required.";
}

if (!empty($errors)) {

    $_SESSION['errors'] = $errors;

    $_SESSION['old'] = $_POST;

    header("Location: index.php");
    exit();
}

$fullname = htmlspecialchars($fullname);
$email = htmlspecialchars($email);
$phone = htmlspecialchars($phone);
$address = htmlspecialchars($address);
$program = htmlspecialchars($program);
$skills = htmlspecialchars($skills);
$project_title = htmlspecialchars($project_title);
$company = htmlspecialchars($company);
$description = htmlspecialchars($description);
$tools = htmlspecialchars($tools);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $fullname ?> - Resume</title>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 40px 20px;
            margin: 0;
        }

        .page {
            background-color: #fff;
            width: 100%;
            max-width: 800px;
            min-height: 1050px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 60px 70px;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #1a365d;
            padding-bottom: 25px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            color: #1a365d;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .contact-info {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .contact-info span {
            margin: 0 10px;
        }

        .section {
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 18px;
            color: #1a365d;
            text-transform: uppercase;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 5px;
        }

        .item-title {
            font-size: 16px;
            font-weight: bold;
            color: #222;
        }

        .item-subtitle {
            font-size: 15px;
            font-style: italic;
            color: #555;
        }

        ul {
            margin-top: 5px;
            padding-left: 20px;
            color: #444;
            line-height: 1.6;
            font-size: 15px;
        }

        .skills-content {
            font-size: 15px;
            line-height: 1.6;
            color: #444;
        }
    </style>
</head>

<body>

    <div class="page">

        <div class="header">
            <h1><?= $fullname ?></h1>

            <div class="contact-info">
                <span><?= $email ?></span> |
                <span><?= $phone ?></span> |
                <span><?= $address ?></span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Education</div>

            <div class="item-header">
                <div class="item-title"><?= $program ?></div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Technical Skills</div>

            <div class="skills-content">
                <strong>Core Competencies:</strong>
                <?= $skills ?><br>

                <strong>Development Tools & Technologies:</strong>
                <?= $tools ?>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Projects & Experience</div>

            <div class="item-header">
                <div class="item-title"><?= $project_title ?></div>
                <div class="item-subtitle"><?= $company ?></div>
            </div>

            <ul>
                <li><?= $description ?></li>
                <li>Leveraged modern tools and practices to successfully complete project deliverables.</li>
            </ul>
        </div>

    </div>

</body>
</html>