<?php session_start(); ?>
<?php 
print( '<?xml version = "1.0" encoding = "utf-8"?>' ) ;
 	session_start();//start the session
// Include database connection
  require_once('global-connect.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>E-bookstore</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
<script type="text/javascript" src="js/get_book.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<div id="header">
		<a href="index.html" class="float"><img src="images/E Book.jpg" alt="" width="373" height="108" /></a>																																																		
	  <div class="topblock1">
			Currency:<br /><select><option>US Dollar</option><option>AU Dollar</option></select>
           
	  </div>
	  <div class="topblock2">
		  <img src="images/shopping.gif" alt="" width="24" height="24" class="shopping" />																																																																									
<p>Shopping cart</p> <p><div id="cart_item"><?php require("cart_item.php"); ?></div></p>
	  </div>
		<ul id="menu">
			<li></li>
			<li><a href="home.php"><img src="images/Home_0.gif" alt="" width="108" height="35" /></a><a href="login.html"><img src="images/My Account_0.gif" alt="" width="128" height="34" /></a>
			
	    <li><a href="contact2.php"><img src="images/Contact_0.gif" alt="" width="117" height="32" /></a></li>
			<li><a href="search.php"><img src="images/search_0.gif" alt="" width="111" height="31" /></a></li>
            <li><a href="Order.php"><img src="images/Order Now_0.gif" alt="" width="136" height="32" /></a><a href="shoppingcart.php"><img src="images/Shopping Cart_0.gif" alt="" width="120" height="33" /></a></li>
			
			<li><a href=""><img src="images/Log Out_0.gif" alt="" width="125" height="33" /></a></li>
            
	  </ul>
</div>
	
	<div id="container">																																																																																																																																																																											
	  <div id="center" class="column">
	  		  	<div id="content">
                
<h2><strong>E Book Store Customer Registration </br>
			    </strong>
		  </h2>
		
                 
</div>
        <br />
	  	<div id="content">
         <?php
         extract( $_POST );
		 
      

          // array of name values for the text input fields
         $inputlist = array( "username" => "Username",
            "password" => "Password", "email" => "Email",
            "phone" => "Phone" , "company" => "Company" , "address" => "Address" );

			
$query_count = "SELECT max(ID) FROM register";
				 /* check the sql statement for errors and if errors report them */
			  $stmt = OCIParse($connect, $query_count); 

			  if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }

			  OCIExecute($stmt);			  

			  if (OCIFetch($stmt))  {
				
				$count = OCIResult($stmt,1);//returns the data for column 1 
				//echo $count."</br>";

			  } else {
				echo "An error occurred in retrieving order id.\n"; 
				exit; 
			  }

			  $count++;
			  
			   // build INSERT query
               
			  $query = "INSERT INTO register ( ID, Username, Password, Email, Phone, Company, Address) " .
                  "VALUES ( $count, '$username', '$password',  '$email', '$phone', '$company',  $address)";	  
				 


 //echo $query;
				  

				/* check the sql statement for errors and if errors report them */
			  $stmt = OCIParse($connect, $query); 
			  //echo "SQL: $query<br>";
			  if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }

@OCIExecute($stmt); 

               print( "<p>  ! <span class = 'prompt'>
                  <strong>$username</strong></span>.
                  Thank you for Registring at ONLINE BOOK STORE.<br />

                

				  </p>
				  </body></html>" );

				  // Close the connection
				OCILogOff ($connect); 
               die();
			   echo '<a href="shoppingcart.html">Click here to go back to our cart Page  </a>';
	?>		              
        
<br />
			<p><br /></p>
			<img src="images/title3.gif" alt="" width="540" height="26" class="pad25" />
			<div class="stuff">
				<div class="item">
					<img src="images/JFK_book.jpg" alt="" width="124" height="90" />
					<a href="index2.html" class="name">JFK Unspeakable</a>
					<span>$129.99</span>
					<a href="#"><img src="images/zoom.gif" alt="" width="53" height="19" /></a><a href="#"><img src="images/cart.gif" alt="" width="71" height="19" /></a>
				</div>
				<div class="item">
					<img src="images/china.jpg" alt="" width="124" height="111" />
					<a href="index2.html" class="name">China</a>
					<span>$149.99</span>
					<a href="#"><img src="images/zoom.gif" alt="" width="53" height="19" /></a><a href="#"><img src="images/cart.gif" alt="" width="71" height="19" /></a>
				</div>
				<div class="item">
					<img src="images/Churchill-at-War.jpg" alt="" width="124" height="89" />
					<a href="index2.html" class="name">Churchill-at-War</a>
					<span>$248.99</span>
					<a href="#"><img src="images/zoom.gif" alt="" width="53" height="19" /></a><a href="#"><img src="images/cart.gif" alt="" width="71" height="19" /></a>
				</div>
				<div class="item">
					<img src="images/CCNA.jpg" alt="" width="124" height="89" />
					<a href="index2.html" class="name">CISCO</a>
					<span>$74.99</span>
					<a href="#"><img src="images/zoom.gif" alt="" width="53" height="19" /></a><a href="#"><img src="images/cart.gif" alt="" width="71" height="19" /></a>
				</div>
				<div class="item">
					<img src="images/headfirstjava.jpg" alt="" width="124" height="97" />
					<a href="index2.html" class="name">Head First Java</a>
					<span>$134.99</span>
					<a href="#"><img src="images/zoom.gif" alt="" width="53" height="19" /></a><a href="#"><img src="images/cart.gif" alt="" width="71" height="19" /></a>
				</div>
				<div class="item">
					<img src="images/pro-css-html.jpg" alt="" width="124" height="111" />
					<a href="index2.html" class="name">Pro CSS and HTML Design</a>
					<span>$99.99</span>
					<a href="#"><img src="images/zoom.gif" alt="" width="53" height="19" /></a><a href="#"><img src="images/cart.gif" alt="" width="71" height="19" /></a>
				</div>
			</div>
		</div>
	  </div>
	  <div id="left" class="column">
	  	<div class="block">
		<img src="images/title1.gif" alt="" width="168" height="42" /><br />
			<ul id="navigation">
				<li class="color"><a href="#" onclick="getBooks('Fiction')">Fiction</a></li>
				<li><a href="#" onclick="getBooks('Non Fiction')">Non Fiction</a></li>
				<li class="color"><a href="#" onclick="getBooks('Special Intrest')">Special Intrest</a></li>
				<li><a href="#" onclick="getBooks('Young Readers')">Young Readers</a></li>
				<li class="color"><a href="#" onclick="getBooks('Travel')">Travel</a></li>
				<li><a href="#" onclick="getBooks('Cookery')">Cookery</a></li>
				<li class="color"><a href="#" onclick="getBooks('Entertainment')">Entertainment</a></li>
				<li><a href="#" onclick="getBooks('Business')">Business</a></li>
				<li class="color"><a href="#" onclick="getBooks('Sport')">Sport</a></li>
				<li><a href="#" onclick="getBooks('Science & Nature')">Science & Nature</a></li>
				<li class="color"><a href="#" onclick="getBooks('Philosophy')">Philosophy</a></li>
				<li><a href="#" onclick="getBooks('History')">History</a></li>
				<li class="color"><a href="#" onclick="getBooks('Geographic')">Geographic</a></li>
				<li><a href="#" onclick="getBooks('Technology')">Technology</a></li>

			</ul>
		</div>
		<a href="#"><img src="images/sale.jpg" alt="" width="172" height="200" /></a>
	  </div>
	  <div id="right" class="column">
	  	<a href="#"><img src="images/banner2.jpg" alt="" width="237" height="216" /></a><br />
		<div class="rightblock"><br />
			<div class="blocks">
				<img src="images/top_bg.gif" alt="" width="218" height="12" />
			  <div id="news">
					<img src="images/title5.gif" alt="" width="201" height="28" />
					<span class="date">23 november</span>
					<p>Dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor. invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
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
</body>
</html>

