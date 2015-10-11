<?php
session_start();//start the session
// Include database connection
  require_once('global-connect.inc.php');
  if (!$conn)  
  {
    echo "An error occurred connecting to the database"; 
    exit; 
  }
		
	//get the passed parameters
	$username = $_GET['username'];
	$passwordGet = $_GET['password'];
	
	/*
	Convert login credentials to html entities to prevent XSS attack.
	*/
	
	$username_entity = htmlentities($username);
	$password_entity = htmlentities($passwordGet);
	
	
	
	
	
	/*
	password encryption
	*/
	$salt = substr($username_entity, 0, 2);
    $salt = '$1$' . $salt . '$';           
	
	$passwordmd5 = md5($password_entity.$salt); //MD5 conversion
	
	//check whether the user name and password is valid
	$sql = "SELECT username,password,email,phone,company,address,city,postal_code,FIRSTNAME,LASTNAME,STATE FROM users WHERE USERNAME = '".$username_entity."' and PASSWORD ='".$passwordmd5."'";
	//print_r($sql);
	$stmt = oci_parse($conn, $sql);
	oci_execute($stmt);
	
	while($row = oci_fetch_array($stmt))
	{
		$user = $row[0];
		$passwordDb = $row[1];	
		$email = $row[2];	
		$phone = $row[3];	
		$company = $row[4];	
		$address = $row[5];	
		$city = $row[6];	
		$pcode = $row[7];	
		$firstname = $row[8];
		$lastname = $row[9];	
		$state = $row[10];	
	}
		
		
	if ($user != "")
	{		
		//if($passwordDb == crypt($passwordGet,$salt))
		if($passwordDb == $passwordmd5)
		{	
			$_SESSION['username'] = $user;	
			$_SESSION['email'] = $email;	
			$_SESSION['phone'] = $phone;	
			$_SESSION['company'] = $company;	
			$_SESSION['address'] = $address;
			$_SESSION['firstname'] = $firstname;	
			$_SESSION['lastname'] = $lastname;	
			$_SESSION['postcode'] = $pcode;	
			$_SESSION['state'] = $state;				
			$_SESSION['city'] = $city;
			
			$_SESSION['myvar']  = $user;
				
			
			print "1";
		}
		else
		{
			print "\tInvalid password";
		}
	}
	else{
		print "\tInvalid username";
		}						
	
	
?>