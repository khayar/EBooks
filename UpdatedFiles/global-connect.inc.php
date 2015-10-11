<?php
  /* Set oracle user login and password info */
  $dbuser = "falbaz";  /* your deakin login */
  $dbpass = "1074730373Ff";  /* your deakin password */
  $dbname = "SSID";
  $conn = oci_connect($dbuser, $dbpass, $dbname);

  if (!$conn)  {

    echo "An error occurred connecting to the database";
    exit;
  }
 $salt = 'dsfsfd333';
 /*
	$username="book";
	$password="dell123";
	$host="10.92.0.246:1521/orcl";

	$conn = oci_connect($username,$password,$host);
	if (!$conn) {
	    $e = oci_error();
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    // echo "success";
	}
	*/
?>