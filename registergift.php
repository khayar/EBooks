<?php 
session_start();
//print_r("Session=".$_SESSION['username']);
error_reporting(1);
// Include database connection
require_once('global-connect.inc.php');
	$nameuser = $_SESSION['username'];

	$username    = $_POST['username'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$company = $_POST['company'];
	$address = $_POST['address'];
	$plans = $_POST['plans'];
	$card_name = $_POST['card_name'];
	$cardno = $_POST['cardno'];
	
	
$current_date = date('d-M-Y',strtotime('+1 years')); //add one year in current date 

$sql = "select userid from users where username = '$nameuser'";
//print_r($sql);
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
	$user_ID = "";
	while($row = oci_fetch_array($stmt))
	{
		$user_ID = $row[0];
	}
	//print_r("user id" . $user_ID);
	$id = mt_rand(10000000,99999999);
$sql_gift_insert = "INSERT INTO GIFT_ORDER VALUES($id ,'$plans',$plans,'$current_date',1,$cardno,$user_ID)";
//print_r($sql_gift_insert);
$stmt_insert_gift = oci_parse($conn, $sql_gift_insert);
oci_execute($stmt_insert_gift);


$sql_gift = "SELECT gift_card_id,plan,blance,expire_date,status 
FROM GIFT_ORDER  INNER JOIN USERS  ON USERS.USERID = GIFT_ORDER.USERID  AND USERS.USERID = '".$user_ID."'";
//print_R($sql_gift);
$stid = oci_parse($conn, $sql_gift);
oci_execute($stid);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
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
<h2><strong>Gift Card Detail</br> </strong> </h2>
<p>&nbsp;</p>
		 <form name="register">          
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
  </form>    
 </div>
        <br />
	  	<div id="content">
<br />
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