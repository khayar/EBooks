<?php 
session_start();//start the session
// Include database connection
  require_once('global-connect.inc.php');
				
				$user = $_SESSION['username'];
				
				
				$firstname =$_POST['firstname'];
				$lastname =$_POST['lastname'];
				$username = $_POST['username'];			
				$email=$_POST['email'];
				$phone= $_POST['phone'];
				$company= $_POST['company'];
				$city= $_POST['city'];
				$address= $_POST['address'];
				$pcode= $_POST['pcode'];
				$state= $_POST['state'];
				
	//check whether the user name and password is valid
	$sql = "SELECT userid FROM users WHERE USERNAME = '".$user."'";
	$stmt = OCIParse($conn, $sql);
	OCIExecute($stmt);
	$userid="";		
	while(OCIFetch($stmt))
	{
		$userid = OCIResult($stmt, 'USERID');

	}
				
				$queryupdate = "UPDATE users SET USERNAME ='$username',EMAIL = '$email',PHONE='$phone',COMPANY='$company',ADDRESS='$address',CITY='$city',
				POSTAL_CODE='$pcode',FIRSTNAME='$firstname',LASTNAME='$lastname',STATE='$state' where userid = $userid ";
				//print_r($queryupdate);
				$registerSQL= oci_parse($conn,$queryupdate);
				oci_execute($registerSQL);				

		header('Location: user_priv.php');
 
  
?>