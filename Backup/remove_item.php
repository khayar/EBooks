<?php

session_start();

$isbn = $_GET['isbn'];

$cart = $_SESSION['cart'];

if(isset($cart,$isbn)) {
	$items = explode(',', $cart);
	$newcart = '';
	foreach ($items as $item) {
        if ($isbn != $item) {
          if ($newcart) {
            $newcart .= ','.$item;
          } else {
            $newcart = $item;
          }
        } //end of if
    } //end of foreach
    $cart = $newcart;
	if($cart != '')
		$_SESSION['cart'] = $cart;
	else
		unset($_SESSION['cart']);
}

header("Location:shoppingcart.php");

?>