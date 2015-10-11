<?php session_start(); ?>
<?php
print( '<?xml version = "1.0" encoding = "utf-8"?>');
session_start(); //start the session
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
        <link rel='stylesheet' type='text/css' href='menustyles.css' />
    </head>

    <body>

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

                        <?php
                        $myvar = "<li class='last'><a href='login_new.php'><span>Log in</span></a></li>";
                        if ($_SESSION['username'] != '') {
                            $myvar = "";
                        }
                        echo $myvar;
                        ?>

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
        <br /><br /><br /><br /><br />



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
                $uname = htmlentities($_POST['username']);
                $pass = htmlentities($_POST['password']);
                $email = htmlentities($_POST['email']);
                $phone = htmlentities($_POST['phone']);
                $company = htmlentities($_POST['company']);
                $address = htmlentities($_POST['address']);
                $firstname = htmlentities($_POST['firstname']);
                $lastname = htmlentities($_POST['lastname']);
                $pcode = htmlentities($_POST['pcode']);
                $state = htmlentities($_POST['state']);
                $city = htmlentities($_POST['city']);

                $passmd5 = md5($pass);

				$salt = substr($uname, 0, 2);
                //$salt = substr($passmd5, 0, 2);
                $salt = '$1$' . $salt . '$';

                $passmd5 = md5($pass.$salt);

				
				//$computedEncryptedPassword = crypt($pass, $salt);


                if ($uname != '' && $pass != '' && $email != '') {
                    $query = "INSERT into users values(user_seq.nextval,'$uname','$passmd5','$email','$phone','$company','$address','$city','$pcode','$firstname','$lastname','$state')";
                    //print_r($query);
                    $registerSQL = oci_parse($conn, $query);
                    oci_execute($registerSQL);

                    print( "<p> Thank you! <span class = 'prompt'></span>.You are successfully registered </p>");
                } else {
                    print( "<p><span class = 'prompt'></span>Please enter all manadatory fields. </p>");
                }
                ?>		              
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

