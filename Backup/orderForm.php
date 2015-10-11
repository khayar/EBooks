<?php
session_start();//start the session
// Include database connection
  require_once('global-connect.inc.php');
  $isbn = $_SESSION['cart'];
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>E-bookstore</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel='stylesheet' type='text/css' href='menustyles.css' />
<script type="text/javascript" src="js/get_book.js"></script>
</head>

<body>
	<div id="header">
<a href="home.php" class="float"><img src="images/about.gif" alt="" class="titleImage"  /></a>
	  <div class="topblock1" style="align:right;">
			Currency:<br /><select><option>US Dollar</option><option>AU Dollar</option></select>

	  </div>
	  <div class="topblock2">
		  <img src="images/shopping.gif" alt="" width="24" height="24" class="shopping" />
 	    <p>Shopping cart</p> <p><div id="cart_item"><?php require("cart_item.php"); ?></div></p>
	  </div>
		<ul id="menu">
			<div id='cssmenu'>
<ul>
   <li class='active'><a href='home.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='user_priv.php'><span>My Account</span></a></li>
   	     <li class='last'><a href='#'><span>Order Now</span></a></li>
		    <li class='last'><a href='shoppingcart.php'><span>Shopping Cart</span></a></li>
			         <li class='last'><a href='search.php'><span>Search</span></a></li>
			      <li class='last'><a href='#'><span>Contact</span></a></li>
			 <!-- <li class='last'><a href='log_off.php'><span>Logout</span></a></li>-->
</ul>
</div>

</div>

	<div id="container">
	  <div id="center" class="column">
	  		  	<div id="content">


	  	</div>
	  	<div id="content">
        <?php
				$userId = $_SESSION['userid'] ;

 				$cn=$_POST['cname'];

				//address
				$cp =$_POST['cphone'];
				$cemail =$_POST['cemail'];
				$cadd = $_POST['sadd'];
				$city=$_POST['city'];
				$pc= $_POST['pcode'];

				//Card
				$CNum= $_POST['ccard'];
				//$date= $_POST['edate'];
				$HN= $_POST['chname'];
				$total= $_POST['amount'];
				$bookname= $_POST['bookname'];

				$curr_date = date('d-M-Y');
			   // build INSERT query
				//$query = "INSERT into order_payment values(order_sequence.nextval,'$cn','$cp','$cadd','$city','$pc','$CNum',$total)";

				$query = "INSERT into order_payment values(order_sequence.nextval,'$cn','$cp','$cadd','$city','$pc','$CNum',$total,'$bookname','$userId','$curr_date')";

				$registerSQL= oci_parse($conn,$query);
				oci_execute($registerSQL);

				$queryupdate = "UPDATE GIFT_ORDER SET BLANCE = (BLANCE - $total) where GIFT_CARD_ID = '$CNum'";
				//print_r($queryupdate);
				$registerSQL= oci_parse($conn,$queryupdate);
				oci_execute($registerSQL);

				unset($_SESSION['cart']);




               print( "<p>Thank you! <span class = 'prompt'></span>.Thank you for ordering at ONLINE BOOK STORE.<br />
                  Your order have been added to our list.!!!!!!!!!!!!
				  </p>" );
				  //echo $stmtin;

				  // Close the connection
				//OCILogOff ($db);


	?>
  <br />
			<p><br /></p>
			<!--<img src="images/title3.gif" alt="" width="540" height="26" class="pad25" />-->
			<div class="stuff">

			</div>
		</div>
	  </div>
	  <?php include('menu.php'); ?>
	  <div id="right" class="column">

		<div class="rightblock"><br />
			<div class="blocks">
				<img src="images/top_bg.gif" alt="" width="218" height="12" />
			  <div id="news">
					<img src="images/title5.gif" alt="" width="201" height="28" />
					<p>BookStore is a 100% Australian-owned online retail store selling books Australia wide. Based in Geelong, Australia we offer handreds books from our database which have been categorised into a variety of subjects to make it easier for you to browse and shop.</p>
					<a href="#" class="more">read more</a>
				</div>
				<img src="images/bot_bg.gif" alt="" width="218" height="10" /><br />
			</div>
		</div>
	  </div>
	<div id="footer">
		<a href="home.php">Home</a>  |About Us| Gallery |  <a href="Gallery.html">My Account</a>  |  <a href="index2.html">Shopping Chart</a>  |Search|  <a href="index2.html">FAQ</a>  |  <a href="index2.html">Contact Us</a>  |  <a href="index2.html" class="terms">Privacy Policy</a>  |  <a href="index2.html" class="terms">Terms of Use</a>
		<p>Copyright &copy;. All rights reserved. </p>
	</div>
	<div class="flashdiv">
		<a href="#"><object type="application/x-shockwave-flash" data="images/books/Banner3.swf" class="flash"/></a>
	</div>
</body>
</html>
