<?php
session_start();
$isbn = $_GET['isbn'];

if(isset($isbn)) {
	$cart = $_SESSION['cart'];
	if(isset($cart)) {
		$cart .= ',' . $isbn;
	} else {
		$cart = $isbn;
	}
	$_SESSION['cart'] = $cart;
}

$cart = $_SESSION['cart'];

require("cart_item.php");

?>