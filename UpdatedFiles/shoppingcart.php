<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>E-Shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/dictionary.js"></script>
<script type="text/javascript" src="js/cart.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel='stylesheet' type='text/css' href='menustyles.css' />
</head>
<body onLoad="getBooks()">
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
   
   <?php $myvar = "";
   if($_SESSION['username'] != ''){
		$myvar = "<li class='has-sub'><a href='user_priv.php'><span>My Account</span></a></li>";
   }
   echo $myvar ?>
   <li class='has-sub'><a href='offer.php'><span>Offer</span></a></li>
 		    <li class='last'><a href='shoppingcart.php'><span>Shopping Cart</span></a></li>			
			         <li class='last'><a href='search.php'><span>Search</span></a></li>
					  <li class='last'><a href='contact.php'><span>Contact</span></a></li>
			    
	<?php $myvar = "<li class='last'><a href='login_new.php'><span>Log in</span></a></li>";
   if($_SESSION['username'] != ''){
		$myvar = "";
   }
   echo $myvar;?>
				 
	<?php $myvar1 = "";
   if($_SESSION['username'] != ''){
		$myvar1 = "<li class='last'><a href='log_off.php'><span>Log out</span></a></li>";
   }
   echo $myvar1 ?>
				  
			 <!-- <li class='last'><a href='log_off.php'><span>Logout</span></a></li>-->
</ul>

			</div>

</div>
	
	<div id="container">																																																																																																									
	  <div id="center" class="column">
	  	<div id="content">
	<div id="container">																																																																																																									
	  	<div id="content">
		    <p>Shopping cart is loading</p>
	  </div>
	</div>
	
	<div id="footer">
		<a href="home.php">Home</a>  |  <a href="index2.html">New Products</a>  |  <a href="index2.html">Special Offers</a>  |  <a href="index2.html">My Account</a>  |  <a href="index2.html">Shopping Chart</a>  |  <a href="index2.html">Locations</a>  |  <a href="index2.html">FAQ</a>  |  <a href="index2.html">Contact Us</a>  |  <a href="index2.html" class="terms">Privacy Policy</a>  |  <a href="index2.html" class="terms">Terms of Use</a>
		<p>Copyright &copy;. All rights reserved. Design by <a href="http://www.bestfreetemplates.info" target="_blank" id="bft" title="Best Free Templates">BFT</a>     </p>																																																																																																																																									
	</div>
</body>
</html>
