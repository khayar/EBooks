<?php
	session_start();
			
			unset($_SESSION['username']);
			unset($_SESSION['email']);	
			unset($_SESSION['phone']);	
			unset($_SESSION['company']) ;	
			unset($_SESSION['address']) ;
			unset($_SESSION['firstname']);	
			unset($_SESSION['lastname']) ;	
			unset($_SESSION['postcode']);	
			unset($_SESSION['state']);				
			unset($_SESSION['city']) ;
	header('Location: home.php');
?>