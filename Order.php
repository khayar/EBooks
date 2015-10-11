<?php 
session_start();//start the session
require_once('global-connect.inc.php');
// Include database connection
//print_r($_SESSION['cart']);
//echo "<br />";
$xml=simplexml_load_file("booklist2.xml");

$num_of_items = "" . $_SESSION['cart'];
$items_array = explode(",", $num_of_items);  //array return
//print_r($items_array);
$total_count_items = count($items_array);  // total count of items
//print_r("count = ".count($items_array));
$amount = "";

for($i=0; $i<$total_count_items; $i++)
  {
		$id=$items_array[$i]-1;
		
		$amount= $amount + $xml->book[$id]->price;
	//}
  // echo "<br />";
   
}
$user_ID = "";
$email="";
$phone="";
$address="";
$city="";
$postalcode="";

$sql = "SELECT * FROM USERS WHERE USERNAME = '".$_SESSION['username']."'";
$stmt = OCIParse($conn, $sql);
OCIExecute($stmt);

	while(OCIFetch($stmt))
	{
		$user_ID = OCIResult($stmt, 'USERID');
		$email= OCIResult($stmt, 'EMAIL');
		$phone= OCIResult($stmt, 'PHONE');
		$address= OCIResult($stmt, 'ADDRESS');
		$city= OCIResult($stmt, 'CITY');
		$postalcode= OCIResult($stmt, 'POSTAL_CODE');
	}
	
	$_SESSION['userid'] = $user_ID ;
//print_r("Total amount" . $amount);

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
<script type="text/javascript" src="livevalidation_standalone.compressed.js"></script>
<script type="text/javascript" src="shoppingcart.js"></script>
<script type="text/javascript" src="loadcart.js"></script>
<script type="text/javascript">
					function validate_gift_order(card,giftid){
						 if(giftid == 'Gift Card No'){
							if(card.length != 8){
								alert("Gift Card No should be 8 digits");
								document.getElementById('sub').disabled  = true;
								return false;
							}
							else{
								document.getElementById('sub').disabled  = false;
							}
							
						}
						else{
							if(card.length != 12){
								alert("Debit ,Visa and Master Card must be 12 digits");
								document.getElementById('sub').disabled  = true;
								return false;
							}
							else{
								document.getElementById('sub').disabled  = false;
							}
						
							
						}
						
					}

				

</script>

</head>
<body onload="writeCartTitle()">
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
			      <li class='last'><a href='#'><span>Contact</span></a></li>
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
                 <?php 
			if ($_SESSION['username'] == '')  {
			  
			  echo "You are authenticated.Please Login.";
			  echo "<br/>";
			  echo '<a href="login_new.php">Click here to continue with Online Book Store  </a>';
			 

			  } else { ?>
		

<h2><strong>Customer  Details: 
			    </strong>
		  </h2>
<p>&nbsp;</p>
<p>&nbsp;</p>
		  <form name="order" method="post" action="orderForm.php"> 
<table width="269" height="127" border="0">

<tr>
<td width="128" height="35"><strong>Full Name:</strong></td>
<td width="131"><input type="text"  value="<?php echo $_SESSION['username']?>" readonly='true' class="contact_input" name="cname" id="cname"/></td>

</tr>
<tr>
<td height="30"><strong>Phone:</strong></td>
<td><input type="text" value="<?php echo $phone?>" readonly='true' class="contact_input" name="cphone" id="cphone" /></td>
</tr>

<tr>
<td width="128" height="34"><strong>Email:</strong></td>
<td width="131"><input type="text"  value="<?php echo $email; ?>" readonly='true' class="contact_input" name="cemail" id="cemail"/></td>

</tr>      
<tr>
<td><strong></strong></td>
<td></td>
</tr>
</table>
<h2>Delivery Address:</h2>
<p>&nbsp;</p>

<table width="272">
<tr>
<td width="128"><strong>Address:</strong></td>
<td width="132"><input type="text" value="<?php echo $address?>" class="contact_input" name="sadd" id="sadd"/></td>
  <script type="text/javascript">
		            var email = new LiveValidation('sadd');
					
						email.add( Validate.Presence );
					

		         	 </script>
</tr>
<tr>
<td width="128" height="36"><strong>City:</strong></td>
<td width="132"><input type="text" value="<?php echo $city; ?>" class="contact_input" name="city" id="city"/></td>
<script type="text/javascript">
		            var email = new LiveValidation('city');
					
						email.add( Validate.Presence );
					

		         	 </script>
</tr>
<tr>
<td width="128"><strong>Post Code</strong></td>
<td width="132"><input type="text"  value="<?php echo $postalcode?>" class="contact_input" name="pcode" id="pcode"/></td>

</tr>
</table> <script type="text/javascript">
		           		 var email = new LiveValidation('pcode');
					
						 email.add( Validate.Presence );					
						//email.add( Validate.Numericality, { onlyInteger: true } );
						//email.add( Validate.Length, { is: 4 } );


						
		         		 </script>
                        
<h2>&nbsp;</h2>
<h2>Payment Method:</h2>
<p>&nbsp;</p>
<table width="273">
<td height="30"><strong>Payment Method:</strong></td>
<td>
<select name="card_name">
  <option value="Debit">Debit</option>
  <option value="Visa">Visa</option>
  <option value="Master">Master</option>
  <option value="Gift Card No">Gift Card No</option>
 </select>
</td>
</tr>
<tr>
<td width="117" height="30"><strong>Card No :</strong></td>
<td width="144"><input type="text" class="contact_input" name="ccard" id="ccard" onchange="validate_gift_order(this.value,order.card_name.value);"/></td>
<script type="text/javascript">
		          		 /*
						 var phone = new LiveValidation('ccard');
						var cardno = 'Gift Card No';
						phone.add( Validate.Presence );
						phone.add( Validate.Numericality );
						if(cardno === 'Gift Card No'){
							phone.add( Validate.Length, { is: 8 } );
						}
						else{
						phone.add( Validate.Length, { is: 12 } );					
						}*/
		         	 </script>
</tr>
<!--
<tr>
<td width="117" height="33"><strong>Card Exp Date</strong></td>
<td width="144"><input type="text" class="contact_input" name="edate" id="edate"/></td> <script type="text/javascript">
		            var edate = new LiveValidation('edate');
					edate.add( Validate.Format, { pattern:/^([0-9]{2}),([0-9]{4})/i} );
					 edate.add( Validate.Presence );
					

		         	 </script>

</tr>
<tr>
<td width="117"><strong>Holder Name</strong></td>
<td width="144"><input type="text" class="contact_input" name="chname" id="chname"/></td>
<script type="text/javascript">
		            var username = new LiveValidation('chname');
					username.add( Validate.Presence );
					username.add( Validate.Length, { minimum: 6 } );

		         	 </script>

</tr> 
-->
<tr>
<td width="117"><strong>Total Amount</strong></td>
<td width="144"><input type="text" value="<?php echo $amount?>" readonly='true' class="contact_input" name="amount" id="amount"/></td>
</tr> 
<tr>
<td width="117"><strong></strong></td>
<td width="144"></td>
</tr>
<tr>
<td width="117"><input type="reset" value="Reset"/></td>
<td width="144"><input type="submit" id="sub"  value="Submit"/></td>
</tr><tr>
<td width="117"><strong></strong></td>
<td width="144"></td>
</tr>
<tr>
<td width="117"><strong></strong></td>
<td width="144"></td>
</tr>

</table>
		  </form>
  <?php } ?>


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
