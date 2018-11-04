function loginValidation(event){
	const minimumPasswordLength = 8;
	
	var elements = event.currentTarget;
	
	var emailInput = elements[0].value;
	var passwordInput = elements[1].value;
	
	var result = true;
	
	var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	var passwordPattern = /^(\S*)?\d+(\S*)?$/;
	
	document.getElementById("emailMessageLogin").innerHTML ="";
    document.getElementById("passwordMessageLogin").innerHTML ="";
    
    if ( (emailInput == "") || (emailInput == null) || (!emailPattern.test(emailInput)) ){
    	document.getElementById("emailMessageLogin").innerHTML="Email is empty or invalid (example: rivero2r@uregina.ca)<br>";
    	result = false;
    }
    
    if ( (passwordInput == "") || (passwordInput == null) || (passwordInput.length < minimumPasswordLength) || (!passwordPattern.test(passwordInput)) ) {
    	document.getElementById("passwordMessageLogin").innerHTML="Invalid password format (atleast 8 characters long, no spaces)<br>";
        result = false;
    }
    
    if(result == false)
    {    
        event.preventDefault();
    }
}

function signupValidation(event){
	var result = true;
	
	var screenName = document.forms.signupForm.screenName.value;
	var email = document.forms.signupForm.email.value;
	var password = document.forms.signupForm.password.value;
	var confirmPassword = document.forms.signupForm.confirmPassword.value;
	
	const minPasswordLength = 8;
	
	var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	var screenNamePattern = /^\w+$/;
	var passwordPattern = /^(\S*)?\d+(\S*)?$/;
	
	document.getElementById("emailMessage").innerHTML ="";
	document.getElementById("screenNameMessage").innerHTML ="";
	document.getElementById("passwordMessage").innerHTML ="";
	document.getElementById("confirmPasswordMessage").innerHTML ="";
		
	if ( (screenName==null) || (screenName=="") || (!screenNamePattern.test(screenName)) ) {  
	    document.getElementById("screenNameMessage").innerHTML="Please enter the correct username format (No spaces or other non-word characters)<br>";
	    result = false;
    }
	
	if ( (email==null) || (email=="") || (!emailPattern.test(email)) ) {	
		document.getElementById("emailMessage").innerHTML="Please enter the correct username format (username@somewhere.sth)<br>";
		result = false;
	}

	if ( (password.length < minPasswordLength) || (!passwordPattern.test(password)) ) {
		document.getElementById("passwordMessage").innerHTML="Please enter the password correcty (8 characters long, at lease one non-letter)<br>";
		result = false;
	}

	if (confirmPassword != password) {
		document.getElementById("confirmPasswordMessage").innerHTML= "The confirmed password should be the same as the password given above<br>";
		result = false;
	}
			
	if(result == false)
    {    
        event.preventDefault();
    }
}