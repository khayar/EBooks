<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(1);
// Include database connection
require_once('global-connect.inc.php');

$name = $_GET['name'];
$email = $_GET['email'];
$message = $_GET['message'];

print "Session Var=".$_SESSION['captcha_code'];

if ($name == '' && $email == '' && $message == '') {
    print '<p style="color:red">Enter All Manadatory Fields</p>';
} else {
    
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
?>