function loginValidation(event){
	const minimumPasswordLength = 8;
	
	var emailInput = document.getElementById("loginEmail").value;
	var passwordInput = document.getElementById("loginPassword").value;
	
	var result = true;
	
	var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	var passwordPattern = /^(\S*)?\d+(\S*)?$/;
	
	document.getElementById("emailMessageLogin").innerHTML ="";
    document.getElementById("passwordMessageLogin").innerHTML ="";

    
    if ( (emailInput == "") || (emailInput == null) || (!emailPattern.test(emailInput)) ){
    	document.getElementById("emailMessageLogin").innerHTML="You must enter your email. <br>";
    	result = false;
    }
    
    if ( (passwordInput == "") || (passwordInput == null) || (passwordInput.length < minimumPasswordLength) || (!passwordPattern.test(passwordInput)) ) {
    	document.getElementById("passwordMessageLogin").innerHTML="You must enter your password. <br>";
        result = false;
    }
    
    if(result == false)
    {    
        event.preventDefault();
    }
}