<!doctype html>
<html lang="en">
<head>
    <title>Spoon+Fork - Confirmation</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/confirmation.css"/>
</head>
<body>

<?php
session_start();
if (isset($_SESSION['cartQuantity'])) {
                $cartQuantity = $_SESSION['cartQuantity'];
                $displayMessage = "Thank you for shopping with us";
                $notification = "You'll receive an email from us soon for your order details";
            } else {
                $cartQuantity=0;
                $displayMessage = "There is no item in cart";
                $notification = "";
            }

include('header.php');
?>

<main>

    <h1><?php echo $displayMessage?></h1>
    <h4><?php echo $notification?></h4>
    <p><a href='index.php' class='commandButton'>Return to Home</a></p>
    <?php session_destroy() ?>


</main>
</body>
</html>
