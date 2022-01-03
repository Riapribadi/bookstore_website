<!doctype html>
<html lang="en">
<head>
    <title>Spoon+Fork - Checkout</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/checkout.css"/>

</head>
<body>

<?php
session_start();
include('header.php');
?>
<main>
    <?php

    $name = $address = $phone = $email = $creditCard = $month = $year = "";
    $nameErr = $addressErr = $phoneErr = $emailErr = $creditCardErr = $monthErr = $yearErr = $errors = "";


    if (!isset($_SESSION['cartQuantity']) && (!isset($_SESSION['cartTotal']))) {
        echo "<h2>There is nothing to checkout</h2>";
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = false;
            if (empty($_POST['name'])) {
                $nameErr = 'Name field required';
                $errors = true;
            } else {
                $name = ($_POST['name']);
            }

            if (empty($_POST['address'])) {
                $addressErr = 'Address field required';
                $errors = true;
            } else {
                $address = ($_POST['address']);
            }

            if (empty($_POST['phone'])) {
                $phoneErr = 'Phone is required';
                $errors = true;
            } else {
                $phone = ($_POST['phone']);
                $phoneRegex = "^\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})$^";
                if (!preg_match($phoneRegex, $_POST['phone'])) {
                    $phoneErr = 'Invalid phone number';
                    $errors = true;
                }
            }

            if (empty($_POST['email'])) {
                $emailErr = 'Email is required';
                $errors = true;
            } else {
                $email = $_POST['email'];
            }

            if (empty($_POST['creditCard'])) {
                $creditCardErr = 'Credit card required';
                $errors = true;
            } else {
                $creditCard = ($_POST['creditCard']);
                $creditCardRegex = "^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|6(?:011|5[0-9]{2})[0-9]{12}|(?:2131|1800|35\d{3})\d{11})$^";
                if (!preg_match($creditCardRegex, $_POST['creditCard'])) {
                    $creditCardErr = 'Invalid credit card';
                    $errors = true;
                }
            }

            if (empty($_POST['month'])) {
                $monthErr = 'Enter month';
                $errors = true;
            } else {
                $month = ($_POST['month']);
            }

            if (empty($_POST['year'])) {
                $yearErr = 'Enter year';
                $errors = true;
            } else {
                $year = ($_POST['year']);
            }

            if (!$errors) {
                header("Location: confirmation.php");
            }

            /* setting variables for session */

            if (isset($_POST['name'])) {
                $name = $_POST['name'];
            }
            $_SESSION['name'] = $name;

            if (isset($_POST['address'])) {
                $address = $_POST['address'];
            }
            $_SESSION['address'] = $address;

            if (isset($_POST['phone'])) {
                $phone = $_POST['phone'];
            }
            $_SESSION['phone'] = $phone;

            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }
            $_SESSION['email'] = $email;

            if (isset($_POST['creditCard'])) {
                $creditCard = $_POST['creditCard'];
            }
            $_SESSION['creditCard'] = $creditCard;

            if (isset($_POST['month'])) {
                $month = $_POST['month'];
            }
            $_SESSION['month'] = $month;

            if (isset($_POST['year'])) {
                $year = $_POST['year'];
            }
            $_SESSION['year'] = $year;

        }
    }
    ?>

    <section id="topSection">
        <h1>Checkout</h1>
    </section>

    <section id="bottomSection">
        <section id="dataForm">
            <p id="formTitleText">In order to purchase the items in your shopping cart, please provide the
                following information:</p>
            <!-- TODO Create a form for customer information -->

            <form id="checkoutForm" method="post" action="">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name ?>"
                       placeholder="Enter your name">
                <span class="error">* <?php echo $nameErr ?></span>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $address ?>"
                       placeholder="Enter your address">
                <span class="error">* <?php echo $addressErr ?></span>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $phone ?>"
                       placeholder="Enter your phone number">
                <span class="error">* <?php echo $phoneErr ?></span>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>"
                       placeholder="Enter your email">
                <span class="error">* <?php echo $emailErr ?></span>
                <label for="creditCard">Credit Card Number:</label>
                <input type="text" id="creditCard" name="creditCard" value="<?php echo $creditCard ?>"
                       placeholder="Enter credit card number">
                <span class="error">* <?php echo $creditCardErr ?></span>
                <label for="expiryDate">Expiry Date:</label>
                <select name="month" id="month">
                    <option value="">Select Month</option>
                    <?php
                    for ($i = 0; $i <= 11; $i++) {
                        $month = date('F', strtotime(2021 - 01 - $i));
                        echo "<option value='" . date('F', strtotime("+$i month")) . "'>" . date('F', strtotime("+$i month")) . "</option>";
                    }
                    ?>
                </select>
                <span class="error">* <?php echo $monthErr ?></span>
                <label for="expiryDate"></label>
                <select name="year" id="year">
                    <option value="">Select Year</option>
                    <?php
                    for ($i = 0; $i <= 10; $i++) {
                        $year = date('Y', strtotime($i - 01 - 15));
                        echo "<option value='" . date('Y', strtotime("+$i years")) . "'>" . date('Y', strtotime("+$i years")) . "</option>";
                    }
                    ?>

                </select>
                <span class="error">* <?php echo $yearErr ?></span>
                <label for="submit"></label>
                <a href=confirmation.php></a>
                <input type="submit" name="submit" id="submitButton">

        </section>

        <section id="checkoutSummary">
            <ul>
                <li>Next day delivery is guaranteed.</li>
                <li>A $5.00 shipping fee is applied to all orders</li>
            </ul>
            <div id="checkoutTotals">
                <div>Cart Subtotal</div>
                <div>$
                    <?php
                    if (isset($_SESSION['cartTotal'])) {
                        $cartTotal = $_SESSION['cartTotal'];
                    } else {
                        $cartTotal = 0;
                    }
                    echo $cartTotal;
                    ?>
                </div>

                <div>Shipping Fee</div>
                <div>$5.00</div>

                <div class="total">Total</div>
                <div class="total">$
                    <?php
                    if (isset($_SESSION['cartTotal'])) {
                        $cartTotal = $_SESSION['cartTotal'] + 5;
                    } else {
                        $cartTotal = 0;
                    }
                    echo $cartTotal;
                    ?>
                </div>
            </div>
        </section>
    </section>
</main>
<?php
include('footer.php')
?>
</body>
</html>


