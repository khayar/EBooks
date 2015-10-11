<?php
//session_start();
error_reporting(1);

// Include database connection
require_once('global-connect.inc.php');
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

                        <?php
                        $myvar = "";
                        if ($_SESSION['username'] != '') {
                            $myvar = "<li class='has-sub'><a href='user_priv.php'><span>My Account</span></a></li>";
                        }
                        echo $myvar
                        ?>
                        <li class='has-sub'><a href='offer.php'><span>Offer</span></a></li>
                        <li class='last'><a href='shoppingcart.php'><span>Shopping Cart</span></a></li>			
                        <li class='last'><a href='search.php'><span>Search</span></a></li>
                        <li class='last'><a href='#'><span>Contact</span></a></li>
                        <li class='last'><a href='login_new.php'><span>Log in</span></a></li>
                        <?php
                        $myvar1 = "";
                        if ($_SESSION['username'] != '') {
                            $myvar1 = "<li class='last'><a href='log_off.php'><span>Log out</span></a></li>";
                        }
                        echo $myvar1
                        ?>

<!-- <li class='last'><a href='log_off.php'><span>Logout</span></a></li>-->
                    </ul>
                </div>

        </div>

        <div id="container">																																																																																																																																																																											
            <div id="center" class="column">
                <div id="content">

                    <h2><strong>Create New Account</br>
                        </strong>
                    </h2>
                    <p>&nbsp;</p>
                    <form name="register" action="registerForm.php" method="post">          
                        <table width="269" height="127" border="0">
                            <tr>
                                <td width="128" height="35"><strong>First Name:</strong></td>
                                <td width="131"> <input type="text" name="firstname" id="firstname" onblur="checkBlur()"/></td>
                            <script type="text/javascript">
                                var username = new LiveValidation('firstname');
                                username.add(Validate.Presence);
                                username.add(Validate.Length, {minimum: 6});

                            </script>
                            </tr>
                            <tr>
                                <td width="128" height="35"><strong>Last Name:</strong></td>
                                <td width="131"> <input type="text" name="lastname" id="lastname" onblur="checkBlur()" /></td>
                            <script type="text/javascript">
                                var username = new LiveValidation('lastname');
                                username.add(Validate.Presence);
                                username.add(Validate.Length, {minimum: 6});

                            </script>
                            </tr>
                            <tr>
                                <td width="128" height="35"><strong>User Name:</strong></td>
                                <td width="131"> <input type="text" name="username" id="username" onblur="checkBlur()" /></td>
                            <script type="text/javascript">
                                var username = new LiveValidation('username');
                                username.add(Validate.Presence);
                                username.add(Validate.Length, {minimum: 6});

                            </script>
                            </tr>
                            <tr>
                                <td height="30"><strong>Password:</strong></td>
                                <td><input type="password" name ="password" id="password" onblur="checkBlur()" /></td><script type="text/javascript">
                                    var password = new LiveValidation('password');
                                    password.add(Validate.Presence);
                                    password.add(Validate.Length, {minimum: 8});
                                    password.add(Validate.Length, {maximum: 20});
                            </script>

                            </tr>

                            <tr>
                                <td width="128" height="34"><strong>Email:</strong></td>
                                <td width="131"><input type="text" name="email" id="email" onblur="checkBlur()" /></td>
                            <script type="text/javascript">
                                var email = new LiveValidation('email');

                                email.add(Validate.Presence);
                                email.add(Validate.Email);
                            </script>
                            </tr>
                            <tr>
                                <td width="128" height="35"><strong>Phone:</strong></td>
                                <td width="131"><input type="text" name="phone" id="phone" onblur="checkBlur()" /></td>

                            <script type="text/javascript">
                                var phone = new LiveValidation('phone');

                                phone.add(Validate.Presence);
                                phone.add(Validate.Numericality);
                                phone.add(Validate.Length, {minimum: 10});

                            </script>
                            </tr>
                            <tr>
                                <td height="30"><strong>Company:</strong></td>
                                <td><input type="text" name="company" id="company" onblur="checkBlur()" /></td> 

                            <script type="text/javascript">
                                var company = new LiveValidation('company');

                                company.add(Validate.Presence);
                                company.add(Validate.Format, {pattern: /^[a-zA-Z]/});
                            </script>


                            </tr>
                            <tr>
                                <td height="30"><strong>City</strong></td>
                                <td><input type="text" name="city" id="city" /></td> 
                            </tr>


                            <tr>
                                <td width="128" height="34"><strong>Address:</strong></td>
                                <td width="131"><input type="text"  name="address" id="address" onblur="checkBlur()" /></td>
                            <script type="text/javascript">
                                var address = new LiveValidation('address');

                                address.add(Validate.Presence);
                                username.add(Validate.Format, {pattern: /^[0-9a-zA-Z]/});
                            </script>
                            </tr>
                            <tr>
                                <td width="128" height="34"><strong>Post Code</strong></td>
                                <td width="131"><input type="text"  name="pcode" id="pcode" onblur="checkBlur()"/></td>
                            </tr>
                            <tr>
                                <td width="128" height="34"><strong>State</strong></td>
                                <td width="131">
                                    <select name="state">
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
                                <td><input type="submit" class="register" value="Register" /></td>
                                <td><input type="reset" class="register" value="Reset" /></td>
                            </tr>
                        </table>                
                    </form>     

                </div>
                <br />
                <div id="content">
                    <!--
                    <img src="images/title2.gif" alt="" width="540" height="29" /><br />
                    <p>Our store is dedicated to providing a vast range of mobile for a wide audience. We offer insightful mobile reviews to assist you in your selection and are committed to a fast, efficient, secure payment and delivery service<br /></p>
                    <img src="images/title3.gif" alt="" width="540" height="26" class="pad25" />
                    -->
<?php //include('content.php');  ?>
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
                <a href="#"><object type="application/x-shockwave-flash" data="images/books/Banner3.swf" class="flash3"/></a>
            </div>
    </body>
</html>
