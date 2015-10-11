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
	
			
	//check whether the user name and password is valid
	$sql = "SELECT username,password,email,phone,company,address,city,postal_code,FIRSTNAME,LASTNAME,STATE FROM users WHERE USERNAME = '".$username."' and PASSWORD ='".$passwordGet."'";
	//print_r("query=".$sql);
	$stmt = OCIParse($conn, $sql);
	$givenname = "";
	OCIExecute($stmt);
				
	while(OCIFetch($stmt))
	{
		$user = OCIResult($stmt, 'USERNAME');
		//$first = OCIResult($stmt, 'FIRSTNAME');
		$passwordDb = OCIResult($stmt, 'PASSWORD');	
		$email = OCIResult($stmt, 'EMAIL');	
		$phone = OCIResult($stmt, 'PHONE');	
		$company = OCIResult($stmt, 'COMPANY');	
		$address = OCIResult($stmt, 'ADDRESS');	
		$city = OCIResult($stmt, 'CITY');	
		$pcode = OCIResult($stmt, 'POSTAL_CODE');	
		$firstname = OCIResult($stmt, 'FIRSTNAME');
		$lastname = OCIResult($stmt, 'LASTNAME');	
		$state = OCIResult($stmt, 'STATE');	
	}
				
	if ($user != "")
	{
		if($passwordDb == $passwordGet)
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
			//$_SESSION['firstname'] = $first;
			
			//if remember checkbox is checked store the cookie for one month
			//otherwise store it for two hour
			/*
			if($remember == "true")
			{
				setcookie("user", $givenname, time()+60*60*24*30);
				setcookie("cid", $cid, time()+60*60*24*30);
			}
			else
			{
				setcookie("user", $givenname, time()+3600 *2);
				setcookie("cid", $cid, time()+3600 *2);
			}
			*/
			
			//header('Location:home.php');
			print "1";
		}
		else
		{
			echo "\tInvalid password";
		}
	}
	else
		echo "\tInvalid username";
								
	OCILogOff($conn);
?>