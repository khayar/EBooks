var validated = "0"; // use 0 and 1 to replace boolean value so it can accept integer value from php

function serverSideValidation(validate, data)
{
	//this function accepts two parameters:
	//the first one is the node to be validated
	//the second one is the data of the node
	
	if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
	else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				validated = xmlhttp.responseText; //getting the response from the php script
				
				//display the error node if validated variable is equal to 1
				//error node id = validate variable + "1"
				if (validated == "1")
				{
						document.getElementById(validate+"1").style.display = "block";	
				}
				else
				{
						document.getElementById(validate+"1").style.display = "none";	
				}
			}
	}
	xmlhttp.open("GET","php/validate.php?v="+validate+"&data="+data,true);
	xmlhttp.send();	
}

function clientSideValidation()
{
	//check whether all the inputs are empty
	//all the inputs must be named first using the name attribute
	//the form must also be named using the same attribute
	//if validated var is false, return false
	if(document.register.username.value == "")
		{
			alert ("please type in your username");
			return false;
		}
	else if(document.register.password.value == "")
		{
			alert ("please type in your password");
			return false;
		}
	else if(document.register.rePassword.value == "" || document.register.rePassword.value != document.register.password.value)
		{
			alert ("your retyped password does not match with your password");
			return false;
		}
	else if(document.register.givenname.value == "")
		{
			alert ("please type in your firstname");
			return false;
		}
	else if(document.register.surname.value == "")
		{
			alert ("please type in your surname");
			return false;
		}
	else if(document.register.email.value == "")
		{
			alert ("please type in your email address");
			return false;
		}
	else if(document.register.phone.value == "")
		{
			alert ("please type in your phone number");
			return false;
		}
	else if(document.register.address.value == "")
		{
			alert ("please type in your address");
			return false;
		}
	else if(document.register.state.value == "none")
		{
			alert ("please type in your address");
			return false;
		}
	else if(document.register.postcode.value == "")
		{
			alert ("please type in your postcode");
			return false;
		}
	else if(validated == "1")
		{
			return false;
		}
	else
		{
		return true;
		}
}

//global variable for login page validation
var validated_login = "1";

function loginServerValidation()
{
	//this function take the login parameters and use ajax and php to communicate with the database
	var username = document.register.username.value;
	var password = document.register.password.value;
	//initialize the response variable
	//alert("user name " + username + "Password = " + password);
	var response = "";
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
		
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			response = xmlhttp.responseText; //getting the response from the php script
				
			//display the error node if validated response is not equal to ""
			if (response != "")
			{
				document.getElementById("error_login").innerHTML = response;
				validated_login = "1";
			}
			else
			{	
					window.location.href = "authentication.php";//redirect to cart.html
					window.location = "authentication.php";//firefox version
			}
		}
	}
	xmlhttp.open("GET","log_in.php?username="+username+"&password="+password,true);
	xmlhttp.onreadystatechange = handleResponse66;
	xmlhttp.send();	
	return loginClientValidation();	
}
function handleResponse66() {
        if (xmlhttp.readyState == 4) 
		{	
			//alert("REsponsce"+ xmlhttp.responseText);
			if(xmlhttp.responseText == 1){
			window.location.href="home.php";
			}
			else{
				document.getElementById("error_login").innerHTML = xmlhttp.responseText;
			}
		}

}



function checkoutServerValidation()
{
	var cc = "";
	var response = "";
	var payment = document.checkout.payment.value;
	
	if(payment != "none")
	{
		if(payment == "credit card")
			cc = document.checkout.creditNum.value;
	}
	else
	{
		alert("Please select the payment method");
		return false;
	}
	
		
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
		
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			var response = xmlhttp.responseText; //getting the response from the php script
				
			//display the error node if validated response is not equal to ""
			if (response != "")
			{
				document.getElementById("error").innerHTML = response;

			}
			else
			{
				document.getElementById("logOff").style.display = "none";
				window.location.href = "finalise.html";
				window.location = "finalise.html";
				
			}
		}
	}
	xmlhttp.open("GET","php/checkout.php?creditCard="+cc+"&payment="+payment,true);
	xmlhttp.send();

	document.getElementById("error").style.display = "block";
	
	return false;
}

function loginClientValidation()
{	
	document.getElementById("error_login").innerHTML = "";
		
	return false;
}

function checkTotal()
{
	if(document.getElementById("total").innerHTML == "TOTAL: 0$")
	{
		alert("you got no item in your cart");
		return false;
	}
	else
		return confirm("are you sure?");
}