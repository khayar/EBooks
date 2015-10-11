<?php
error_reporting(1);
// Include database connection
require_once('global-connect.inc.php');
if (isset($_POST['Submit'])) {
    // code for check server side validation
    if (empty($_SESSION['captcha_code']) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0) {
        $msg = "<span style='color:red'>The Validation code does not match!</span>"; // Captcha verification is incorrect.		
    } else {// Captcha verification is Correct. Final Code Execute here!		
        $msg = "<span style='color:green'>The Validation code has been matched.</span>";
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>E-bookstore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel='stylesheet' type='text/css' href='menustyles.css' />
        <link href="capctha/css/style.css" rel="stylesheet">
        <script type="text/javascript">

            function createRequestObject() {
                var ro;
                if (navigator.appName == "Microsoft Internet Explorer") {
                    ro = new ActiveXObject("Microsoft.XMLHTTP");
                } else {
                    ro = new XMLHttpRequest();
                }
                return ro;
            }

            var http = createRequestObject();

            function sendRequest() {
                //alert("aya");
                var name1 = document.getElementById('name').value;
                var email1 = document.getElementById('email').value;
                var messge1 = document.getElementById('message').value;

                http.open('get', 'contact_redirect.php?name=' + name1 + '&email=' + email1 + '&message=' + messge1, true);
                http.onreadystatechange = handleResponse;
                http.send(null);
            }


            function handleResponse() {
                if (http.readyState == 4)
                {
                    document.getElementById('output').innerHTML = http.responseText;

                }
            }

            function refreshCaptcha() {
                var img = document.images['captchaimg'];
                img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
            }
        </script>
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

                    <h2><strong>Contact Form <br /></strong>
                    </h2>
                    <p>&nbsp;</p>
                    <form name="contactform" id="contactform">          
                        <table width="269" height="127" border="0">
                            <tr>
                                <td width="128" height="35"><strong>Name</strong></td>
                                <td width="131"> <input type="text" name="name" id="name" onblur="checkBlur()"/></td>

                            </tr>
                            <tr>
                                <td width="128" height="35"><strong>Email</strong></td>
                                <td width="131"> <input type="text" name="email" id="email" onblur="checkBlur()" /></td>
                            </tr>
                            <tr>
                                <td width="128" height="35"><strong>Message</strong></td>
                                <td width="131"> <input type="text" name="message" id="message" onblur="checkBlur()" /></td>

                            </tr>

                            <?php if (isset($msg)) { ?>
                                <tr>
                                    <td colspan="2" align="center" valign="top"><?php //echo $msg; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>
                                    <img src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'><br>
                                    <label for='message'>Enter the code above here :</label><br>
                                    <input id="captcha_code" name="captcha_code" type="text"><br>
                                    Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.
                                </td>
                            </tr>
                            <tr>

                            </tr>

                            <tr>
                                <td><input type="button" class="register" value="Submit" onclick="sendRequest();"/></td>
                                <td><input type="reset" class="register" value="Reset" /></td>


                            </tr>
                            <span id="output"> </span>
                        </table>                
                    </form>     

                </div>
                <br />
                <div id="content">
                    <?php //include('content.php');    ?>
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
