<!doctype html>
<html lang="en">
<head>
    <title>Spoon+Fork - cart</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
</head>

<body>
<main>
    <?php
    session_start();

    if (isset($_GET['bookId'])) {
        $bookId = $_GET['bookId'];
        unset($_GET["bookId"]);
    }

    // update all the right quantities

    if (isset($_POST['quantityInput'])) {
        $quantity = $_POST['quantityInput'];
    } else {
        $quantity = 1;
    }
    if (isset($_POST['bookId'])) {
        $quantityId = $_POST['bookId'];
    } else {
        $quantityId = "";
    }

    if (isset($bookId)) {
        if (isset($_SESSION['cartItems']) == false) {
            $_SESSION['cartItems'] = array(array('bookId' => $bookId, 'quantity' => $quantity));
        } else {
            $found = false;
            $i = 0;
                foreach ($_SESSION['cartItems'] as $item) {
                    if ($item['bookId'] == $bookId) {
                        $_SESSION['cartItems'][$i]['quantity'] = $_SESSION['cartItems'][$i]['quantity'] + 1;  // if this was already in there
                        $found = true;
                    }
                    $i = $i + 1;
                }
            if ($found == false) {
                $_SESSION['cartItems'][count($_SESSION['cartItems'])] = array('bookId' => $bookId, 'quantity' => $quantity);
            }
        }
    } else {
        if (isset($_SESSION['cartItems'])) {
            $i = 0;
            foreach ($_SESSION['cartItems'] as $item) {
                if ($item['bookId'] == $quantityId) {
                    $_SESSION['cartItems'][$i]['quantity'] = $quantity;  // if I took it from the form
                }
                $i = $i + 1;
            }
        }
    }

    $cartQuantity = 0;
    $cartTotal = 0;
    if (isset($_SESSION['cartItems'])) {
        $i = 0;
        foreach ($_SESSION['cartItems'] as $item) {
            if ($item['quantity'] == 0){
                unset($_SESSION['cartItems'][$i]);
            }
            $cartQuantity = $cartQuantity + $item['quantity'];
            $_SESSION['cartQuantity'] = $cartQuantity;
            $i = $i + 1;
        }
    }

    include('header.php');
    ?>

    <h1>Your Shopping Cart</h1>
    <section id="topSection">

        <a href="clear_cart.php" class="commandButton">Clear Cart</a>

        <a href="checkout.php" class="commandButton">Proceed to Checkout</a>

        <a href='category.php?categoryId=<?php echo $_SESSION['categoryId'] ?>' class="commandButton">Continue
            Shopping</a>
    </section>

    <section id="midSection">
        <div id='cartGrid'>
            <div class='gridHeader gridTitle'>Title</div>
            <div class='gridHeader gridQuantity'>Quantity</div>
            <div class='gridHeader gridPrice'>Price</div>
            <div class='gridHeader gridTotal'>Total Price</div>

            <?php
            // displaying all items in the cart
            if (isset($_SESSION['cartItems'])){
                foreach ($_SESSION['cartItems'] as $item) {
                    $bookDetails = getBookDetails($db, $item['bookId']);
                    $cartTotal = $cartTotal + $bookDetails['price'] * $item['quantity'];
                    $_SESSION['cartTotal'] = $cartTotal;
                    ?>
                    <div class='gridTitle'><?php echo $bookDetails['title'] ?></div>
                    <div class='gridQuantity'>
                        <!-- TODO need to put in form to update quantity-->
                        <form action="cart.php" method="post">
                            <label for="quantityInput"></label>
                            <input type="number" id="quantityInput" name="quantityInput" min="0"
                                   value="<?php echo $item['quantity'] ?>">
                            <input type="hidden" name="bookId" value=<?php echo $item['bookId'] ?>>
                            <a href="cart.php"></a>
                            <input type="submit" value="update" id="updateButton">
                        </form>
                    </div>
                    <div class='gridPrice'>$<?php echo $bookDetails['price'] ?></div>
                    <div class='gridTotal'>$<?php echo $item['quantity'] * $bookDetails['price'] ?></div>
                <?php }}
            ?>

    </section>

    <section id="bottomSection">
        <!--                  Only show totals if something is in the cart-->
        <?php

        echo "<h2>You have $cartQuantity item in the cart</h2>";
        echo "<h2>Cart total: $$cartTotal</h2>";
        ?>

    </section>
    <?php
    include('footer.php')
    ?>

</main>
</body>
