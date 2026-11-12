<!DOCTYPE html>
<html>
<head>
    <title>Number Classifier</title>
</head>
<body>

    <h2>Number Classifier</h2>

    <form method="post">
        <label>Enter an integer:</label>
        <input type="number" name="number" required>
        <button type="submit">Check</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $number = $_POST["number"];

        if ($number > 0) {
            echo "<p>The number is positive.</p>";

            if ($number % 2 == 0) {
                echo "<p>The number is even.</p>";
            } else {
                echo "<p>The number is odd.</p>";
            }

        } elseif ($number < 0) {
            echo "<p>The number is negative.</p>";

        } else {
            echo "<p>The number is zero.</p>";
        }
    }
    ?>

</body>
</html>