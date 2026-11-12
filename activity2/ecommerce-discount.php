<?php


$total = isset($_GET['total']) ? floatval($_GET['total']) : 0;


if ($total < 50) {
    $discountRate = 0;
} elseif ($total < 100) {
    $discountRate = 0.10;
} elseif ($total < 200) {
    $discountRate = 0.15;
} else {
    $discountRate = 0.20;
}

$discountAmount = $total * $discountRate;
$finalPrice = $total - $discountAmount;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Store Discount Calculator</title>
</head>
<body>

    <h2>Store Discount Calculator</h2>

    <p>Original Price: P<?php echo number_format($total, 2); ?></p>
    <p>Discount Amount: P<?php echo number_format($discountAmount, 2); ?></p>
    <p>Final Price: P<?php echo number_format($finalPrice, 2); ?></p>

</body>
</html>