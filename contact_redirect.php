<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(1);
// Include database connection
require_once('global-connect.inc.php');

$name    =  htmlentities($_GET['name']);
$email   = htmlentities($_GET['email']);
$message = htmlentities($_GET['message']);
$capcode = htmlentities($_GET['capcode']);

//print $capcode . "OR" . $_SESSION['captcha_code'];

if ($name == '' && $email == '' && $message == '' && $capcode == '') {
    print '<p style="color:red">Enter All Manadatory Fields</p>';
} 
else {
		if($capcode == ""){
			$msg = "<span style='color:red'Please enter captcha code</span>"; 
			print $msg;
		}
		else{

 if (strcasecmp($_SESSION['captcha_code'], $capcode) != 0) {
		$msg = "<span style='color:red'>The captcha code does not match!</span>"; // Captcha verification is incorrect.		
		print $msg;
    } else {// Captcha verification is Correct. Final Code Execute here!		
        $msg = "<span style='color:green'>The Validation code has been matched.</span>";
		//print $msg;
		
		$query = "INSERT into contact values(contact_seq.nextval,'$name','$email','$message')";
		$registerSQL = oci_parse($conn, $query);
    //oci_execute($registerSQL);
    if (!oci_execute($registerSQL, OCI_DEFAULT)) {
        // If we have a problem, rollback then die
        oci_rollback($conn);
        print "Problem to inserting in database";
        die;
    }
    else{
        oci_execute($registerSQL);
        print "Thank you for contact us..";
    }

   }
   }
  
}
?>