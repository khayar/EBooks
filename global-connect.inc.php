<?php

/* Set oracle user login and password info */
//$dbuser = "falbaz";  /* your deakin login *//
//$dbpass = "1074730373Ff";  /* your deakin password */
//$dbname = "SSID";
//$conn = oci_connect($dbuser, $dbpass, $dbname);
/*
if (!$conn) {

    echo "An error occurred connecting to the database";
    exit;
}
$salt = 'dsfsfd333';
*/

$username = "BOOK";
$password = "systemdba";
$host = "localhost/orcl";

$conn = oci_connect($username, $password, $host);
  if (!$conn)  {

    echo "An error occurred connecting to the database";
    exit;
  }


?>