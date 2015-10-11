<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>E-bookstore</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="javascript.js" ></script>
<script type="text/javascript" src="shoppingcart.js"></script>
<script type="text/javascript" src="loadcart.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel='stylesheet' type='text/css' href='menustyles.css' />
</head>
<body onload="writeCartTitle()">

<div id="header">
<a href="home.php" class="float"><img src="images/about.gif" alt="" class="titleImage"/></a>
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


<h2><strong>E Store</br>
			    </strong>
		  </h2>
<p>&nbsp;</p>







			 <!-- XML live search -->
			    <h3 class="head1">Live Search</h3>
			    <form>
                        <table>
                        <tr>
                        <td></td>
                        <td><input type="text" size="30" onkeyup="showResultXml(this.value)" /></td>
                        <td></td>
                        </tr>
                        </table>
				  <div id="livesearch_xml"></div>




				</form>

        <br />
	  	<div id="content">
<br />
			<p><br /></p>
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
	</div>

	<div id="footer">
		<a href="home.html">Home</a>  |About Us| Gallery |  <a href="Gallery.html">My Account</a>  |  <a href="index2.html">Shopping Chart</a>  |Search|  <a href="index2.html">FAQ</a>  |  <a href="index2.html">Contact Us</a>  |  <a href="index2.html" class="terms">Privacy Policy</a>  |  <a href="index2.html" class="terms">Terms of Use</a>
		<p>Copyright &copy;. All rights reserved. Design by <a href="http://www.bestfreetemplates.info" target="_blank" id="bft" title="Best Free Templates">BFT</a>     </p>
	</div>
	<div class="flashdiv">
		<a href="#"><object type="application/x-shockwave-flash" data="images/books/Banner3.swf" class="flash4"/></a>
	</div>
</body>
</html>

