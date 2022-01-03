<?php
session_start();

unset($_SESSION['cartItems']);
unset($_SESSION['cartQuantity']);
unset($_SESSION['cartTotal']);

header("Location: cart.php");

?>