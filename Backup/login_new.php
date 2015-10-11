<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>E-bookstore</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
<script type="text/javascript" src="js/get_book.js"></script>
<script type="text/javascript" src="livevalidation_standalone.compressed.js"></script>
<script type="text/javascript" src="validation.js"></script>
<script type="text/javascript" src="shoppingcart.js"></script>
<script type="text/javascript" src="loadcart.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel='stylesheet' type='text/css' href='menustyles.css' />
</head>
<body onload="writeCartTitle()">
	<div id="header">
<a href="home.php" class="float"><img src="images/about.gif" alt="" class="titleImage" /></a>
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
		$myvar = "<li class='has-sub'><a href='login_new.php'><span>My Account</span></a></li>";
   } else {
   echo $myvar;} ?>
   <li class='has-sub'><a href='offer.php'><span>Offer</span></a></li>
 		    <li class='last'><a href='shoppingcart.php'><span>Shopping Cart</span></a></li>
			         <li class='last'><a href='search.php'><span>Search</span></a></li>

				  <li class='last'><a href='login_new.php'><span>Log in</span></a></li>
	<?php $myvar1 = "";
   if($_SESSION['username'] != ''){
		$myvar1 = "<li class='last'><a href='log_off.php'><span>Log out</span></a></li>";
   }else {
   echo $myvar1; } ?>

			 <!-- <li class='last'><a href='log_off.php'><span>Logout</span></a></li>-->
</ul>
</div>

</div>
<br /><br /><br /><br /><br />

	<div id="container">
	  <div id="center" class="column">
	  	<div id="content">

				<h2><strong>User Login:
			    </strong>
		  </h2>
<p>&nbsp;</p>
<p>&nbsp;</p>
		   <form name="register" method="POST" action="authentication.php" onsubmit="return loginServerValidation();">
<table width="269" height="127" border="0">

<tr>
<td width="128" height="35"><strong>User Name:</strong></td>
<td width="131"><input type="text"  name="username" id="username" /></td>
</tr>
<tr>
<td height="30"><strong>Password:</strong></td>
<td><input type="password"  name="password" id="password" /></td>
</tr>

<tr>
<td width="128" height="34"><input type="reset" class="register" value="Reset" /></td>
<td width="131"><input type="submit" class="register" value="Login" /><span id="error_login" style="color:red;"></span></td>
</tr>
<tr>
<td></td>
<td><a href="register.php">Create New Registration </a></td>
</tr>

</table>
</form>



        <br />
<br />

	<?php //include('content.php'); ?>
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
