<?php 
session_start();
error_reporting(1);
// Include database connection
 require_once('global-connect.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Gift Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel='stylesheet' type='text/css' href='menustyles.css' />
<script type="text/javascript" src="js/get_book.js"></script>
<script type="text/javascript" src="livevalidation_standalone.compressed.js"></script>
<script type="text/javascript" src="shoppingcart.js"></script>
<script type="text/javascript" src="loadcart.js"></script>
</head>
<body onload="writeCartTitle()">
<div id="header">
<a href="home.php" class="float"><img src="images/about.gif" alt="" class="titleImage" /></a>	  <div class="topblock1" style="align:right;">
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
<br /><br /><br /><br /><br />
<span id="welcome"> Welcome <?php echo $_SESSION['username'] == '' ? 'Guest' : $_SESSION['username'];  ?> </span>
	<div id="container">
	<div id="center" class="column">
	  		  	<div id="content">
               <?php 
			if ($_SESSION['username'] == '')  {
			  
			  echo "You are authenticated.Please Login.";
			  echo "<br/>";
			  echo '<a href="login_new.php">Click here to continue with Online Book Store  </a>';
			 

			  } else {
		
?> 
<h2><strong>Customer Detail</br> </strong> </h2>
<p>&nbsp;</p>
		 <form name="register" action="registergift.php" method="post">          
  <table width="269" height="127" border="0">

<tr>
<td width="128" height="35"><strong>First Name:</strong></td>
<td width="131"> <input type="text" name="firstname" id="firstname" onblur="checkBlur()" disabled value="<?php echo $_SESSION['firstname']; ?>"/></td>
                   
</tr>
<tr>
<td width="128" height="35"><strong>Last Name:</strong></td>
<td width="131"> <input type="text" name="lastname" id="lastname" onblur="checkBlur()" disabled value="<?php echo $_SESSION['lastname']; ?>"/></td>
                   
</tr>
<tr>
<td width="128" height="34"><strong>Email:</strong></td>
<td width="131"><input type="text" name="email" id="email" onblur="checkBlur()" disabled value="<?php echo $_SESSION['email']; ?>"/></td>
 
</tr>
<tr>
<td width="128" height="35"><strong>Phone:</strong></td>
<td width="131"><input type="text" name="phone" id="phone" onblur="checkBlur()" disabled value="<?php echo $_SESSION['phone']; ?>"/></td>

  
</tr>
<tr>
<td height="30"><strong>Company:</strong></td>
<td><input type="text" name="company" id="company" onblur="checkBlur()" disabled value="<?php echo $_SESSION['company']; ?>"/></td> 




</tr>

<tr>
<td width="128" height="34"><strong>Address:</strong></td>
<td width="131"><input type="text"  name="address" id="address" onblur="checkBlur()" disabled value="<?php echo $_SESSION['address']; ?>"/></td>

</tr>
<tr>
<td width="128" height="34"><strong>Post Code</strong></td>
<td width="131"><input type="text"  name="pcode" id="pcode" onblur="checkBlur()" disabled value="<?php echo $_SESSION['postcode']; ?>"/></td>
</tr>
<tr>
<td width="128" height="34"><strong>State</strong></td>
<td width="131">
<select name="state" value="<?php echo $_SESSION['state']; ?>">
  <option value="Australian Capital Territory">Australian Capital Territory</option>
  <option value="New South Wales">New South Wales</option>
  <option value="Northern Territory">Northern Territory</option>
  <option value="Queensland">Queensland</option>
  <option value="South Australia">South Australia</option>
  <option value="Tasmania">Tasmania</option>
  <option value="Victoria">Victoria</option>
   <option value="Western Australia">Western Australia</option>
 </select>
</td>
</tr>

<tr>
<td><strong></strong></td>
<td></td>
</tr>
<tr>
<td>
<h2><strong>Payment Detail</br> </strong> </h2>
</td>
</tr>
<tr>
<td width="128" height="35"><strong>Gift Certificate</strong></td>
<td width="131"> 
<select name="plans">
  <option value="100">Red Gift(100$)</option>
  <option value="200">Green Gift(200$)</option>
  <option value="300">Yellow Gift(300$)</option>
</select>
</tr>
<tr>
<td height="30"><strong>Payment Method:</strong></td>
<td>
<select name="card_name">
  <option value="Debit">Debit</option>
  <option value="Visa">Visa</option>
  <option value="Master">Master</option>
 </select>
</td>
</tr>
<tr>
<td height="30"><strong>Card No.</strong></td>
<td width="131"><input type="text" name="cardno" id="cardno" /></td>
<script type="text/javascript">
		          		 var phone = new LiveValidation('cardno');
					
						phone.add( Validate.Presence );
						phone.add( Validate.Numericality );
						phone.add( Validate.Length, { is: 16 } );					

		         	 </script>
</tr>
<tr>
<td><input type="reset" class="register" value="Reset" /></td>
<td><input type="submit" class="register" value="Submit" /></td>
</tr>
</table>
</form>    
<?php } ?>
 </div>
        <br />
	  	<div id="content">
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
		<a href="#"><object type="application/x-shockwave-flash" data="images/books/Banner3.swf" class="flash2"/></a>
	</div>

	 </body>
</html>
