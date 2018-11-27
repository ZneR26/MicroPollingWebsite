function signupValidation(event){
	var result = true;
	
	var screenName = document.forms.signupForm.screenName.value;
	var email = document.forms.signupForm.email.value;
	var password = document.forms.signupForm.password.value;
	var confirmPassword = document.forms.signupForm.confirmPassword.value;
	var birthday = document.forms.signupForm.birthday.value;
	
	const minPasswordLength = 8;
	
	var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	var screenNamePattern = /^\w+$/;
	var passwordPattern = /^(\S*)?\d+(\S*)?$/;
	var birthdayPattern = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
	
	document.getElementById("emailMessage").innerHTML ="";
	document.getElementById("screenNameMessage").innerHTML ="";
	document.getElementById("passwordMessage").innerHTML ="";
	document.getElementById("confirmPasswordMessage").innerHTML ="";
	document.getElementById("birthdayMessage").innerHTML ="";
		
	if ( (screenName==null) || (screenName=="") || (!screenNamePattern.test(screenName)) ) 
	{  
	    document.getElementById("screenNameMessage").innerHTML="Please enter the correct username format (No spaces or other non-word characters)<br>";
	    result = false;
    }
	
	if ( (email==null) || (email=="") || (!emailPattern.test(email)) ) 
	{	
		document.getElementById("emailMessage").innerHTML="Please enter the correct username format (username@somewhere.sth)<br>";
		result = false;
	}

	if ( (password.length < minPasswordLength) || (!passwordPattern.test(password)) ) 
	{
		document.getElementById("passwordMessage").innerHTML="Please enter the password correcty (8 characters long, at lease one non-letter)<br>";
		result = false;
	}

	if (confirmPassword != password) 
	{
		document.getElementById("confirmPasswordMessage").innerHTML= "The confirmed password should be the same as the password given above<br>";
		result = false;
	}
	
	if (!birthdayPattern.test(birthday))
	{
		document.getElementById("birthdayMessage").innerHTML="Invalid date <br>";
		result = false;
	}
			
	if(result == false)
    {    
        event.preventDefault();
    }
}