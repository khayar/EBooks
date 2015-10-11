<?php session_start(); 
require_once('global-connect.inc.php');

$nameuser = $_SESSION['username'];

$sql = "select * from users where username = '$nameuser'";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
	$user_ID = "";
	while($row = oci_fetch_array($stmt))
	{
		$user_ID = $row[0];
		$username = $row[1];
		$email = $row[3];
		$phone = $row[4];
		$company = $row[5];
		$address = $row[6];
		$city = $row[7];
		$postalcode = $row[8];
		$fname = $row[9];
		$lname = $row[10];
	}

$sql_gift = "SELECT gift_card_id,plan,blance,expire_date,status 
FROM GIFT_ORDER  INNER JOIN USERS  ON USERS.USERID = GIFT_ORDER.USERID  AND USERS.USERID = '".$user_ID."'";
$stid = oci_parse($conn, $sql_gift);
oci_execute($stid);


$sql_history = "SELECT *  FROM order_payment where userid = $user_ID";
$history = oci_parse($conn, $sql_history);
oci_execute($history);



//order_payment

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>E Book Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
<script type="text/javascript" src="js/get_book.js"></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel='stylesheet' type='text/css' href='menustyles.css' />
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
<br /><br /><br /><br /><br /> 
<span id="welcome"> Welcome <?php echo $_SESSION['username'] == '' ? 'Guest' : $_SESSION['username'];  ?> </span>
	
	<div id="container">																																																																																																																																																																							
	  <div id="center" class="column">
	  	<!--<a href="#" class="banner"><img src="images/about1.gif" alt="" width="570" height="236" align="center" /></a>-->
		<br />
        
	  	<div id="content">
<h2><strong>Customer Detail</br></strong></h2>
<p>&nbsp;</p>
		 <form name="register" action="update_user.php" method="post">          
<table width="269" height="127" border="0">
<tr>
<td width="128" height="35"><strong>First Name:</strong></td>
<td><input type="text" name="firstname" id="firstname" value="<?php echo $fname; ?>" onblur="checkBlur()" /></td>
 <script type="text/javascript">
		            var username = new LiveValidation('firstname');
					username.add( Validate.Presence );
					username.add( Validate.Length, { minimum: 6 } );

		         	 </script>
</tr>
<tr>
<td width="128" height="35"><strong>Last Name:</strong></td>
<td><input type="text" name="lastname" id="lastname" value="<?php echo $lname; ?>" onblur="checkBlur()" /></td>
  <script type="text/javascript">
		            var username = new LiveValidation('lastname');
					username.add( Validate.Presence );
					username.add( Validate.Length, { minimum: 6 } );

		         	 </script>
</tr>
<tr>
<td width="128" height="35"><strong>User Name:</strong></td>
<td width="131"> <input type="text" name="username" id="username" value="<?php echo $username; ?>" onblur="checkBlur()" /></td>
</tr>
<tr>
<td width="128" height="34"><strong>Email:</strong></td>
<td width="131"><input type="text" name="email" id="email" value="<?php echo $email; ?>"  onblur="checkBlur()" /></td>
<script type="text/javascript">
		            var email = new LiveValidation('email');
					
						email.add( Validate.Presence );
						email.add( Validate.Email );
		         	 </script>
</tr>
<tr>
<td width="128" height="35"><strong>Phone:</strong></td>
<td width="131"><input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" onblur="checkBlur()" /></td>
<script type="text/javascript">
		            var phone = new LiveValidation('phone');
					
						phone.add( Validate.Presence );
						phone.add( Validate.Numericality );
						phone.add( Validate.Length, { minimum: 10 } );

		         	 </script>
</tr>
<tr>
<td height="30"><strong>Company:</strong></td>
<td><input type="text" name="company" id="company" value="<?php echo $company; ?>" onblur="checkBlur()" /></td> 

<script type="text/javascript">
		            var company = new LiveValidation('company');
					
					company.add( Validate.Presence );
					company.add( Validate.Format, { pattern:/^[a-zA-Z]/} );
		         	 </script>


</tr>
<tr>
<td height="30"><strong>City</strong></td>
<td><input type="text" name="city" id="city" value="<?php echo $city; ?>" /></td> 
</tr>


<tr>
<td width="128" height="34"><strong>Address:</strong></td>
<td width="131"><input type="text"  name="address" id="address" value="<?php echo $address; ?>" onblur="checkBlur()" /></td>
<script type="text/javascript">
		            var address = new LiveValidation('address');
					
					address.add( Validate.Presence );
					username.add( Validate.Format, { pattern:/^[0-9a-zA-Z]/} );
		         	 </script>
</tr>
<tr>
<td width="128" height="34"><strong>Post Code</strong></td>
<td width="131"><input type="text"  name="pcode" id="pcode" value="<?php echo $postalcode; ?>" onblur="checkBlur()"/></td>
</tr>
<tr>
<td width="128" height="34"><strong>State</strong></td>
<td width="131">
<select name="state" value="<?php echo $state; ?>">
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
<td><input type="submit" class="register" value="Update Details" /></td>
<td><input type="reset" class="register" value="Reset" /></td>
</tr>
</table>
</form>
<h1><strong>Last 3 Months Transactions</strong></h1>

<table width="269" height="127" border="1px">
<tr>
<th align="center">
S.No.
</th>
<th align="center">
Order.No.
</th>
<th align="center">
Address</th>
<th align="center">
Amount
</th>
<th align="center">
Order Date
</th>
</tr>
<?php
$i = 1;
while(($row_history = oci_fetch_array($history)))	{
		
?>
<tr >
<td >
<?php print $i; ?>
</td>

<td align="center">
<?php print   $row_history[0];  ?>
</td>


<td align="center">
<?php print  $row_history[3] ; ?>
</td>
<td align="center">
<?php print  $row_history[7] ; ?>
</td>
<td align="center">
<?php print  $row_history[10] ; ?>
</td>


</tr>
<?php $i++; } ?>
</table>




<h1><strong>Gift Card Details</strong></h1>
<table width="269" height="127" border="1px">
<tr>
<th align="center">
S.No.
</th>
<th align="center">
Gift Card No</th>
<th align="center">
Plan</th>
<th align="center">
Balance
</th>
<th align="center">
Expiry Date
</th>
<th align="center">
Status
</th>
</tr>
<?php
$i = 1;
while(($row = oci_fetch_array($stid)))	{
		
?>
<tr >
<td >
<?php print $i; ?>
</td>

<td align="center">
<?php print   $row[0];  ?>
</td>

<td align="center">
<?php print  $row[1] ; ?>
</td>

<td align="center">
<?php print  $row[2] ; ?>
</td>
<td align="center">
<?php print  $row[3] ; ?>
</td>
<td align="center">
<?php print  $row[4] ; ?>
</td>

</tr>
<?php $i++; } ?>
</table>

</div>
	  
	  
	</div>
	
	<?php include('menu.php'); ?>
	  <div id="right" class="column">
	  	<a href="#"><object type="application/x-shockwave-flash" data="images/books/Banner3.swf" width="223" height="216"/></a><br />
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



</body>
</html>
