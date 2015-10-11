<?php
//session_start();

$cart = $_SESSION['cart'];

$msg = '';
if(isset($cart)) {
	$items = explode(',', $cart);
	$s = (count($items) > 1) ? 's':'';
	$msg = '<strong>' . count($items) . '</strong>' . ' item' . $s;
} else {
	$msg = '<strong>0</strong> item';
}

$msg .= '<div style="visibility:hidden" id="isbn_a">' . $cart . '</div>';

echo $msg;

?>