function voteValidation(event)
{
	var result = true;
	
	var option1 = document.getElementById("option1").checked;
	var option2 = document.getElementById("option2").checked;
	var option3 = document.getElementById("option3").checked;
	var option4 = document.getElementById("option4").checked;
	var option5 = document.getElementById("option5").checked;
	
	document.getElementById("genericErrorMessage").innerHTML = "";
	
	if ((option1 == false) && (option2 == false) && (option3 == false) && (option4 == false) && (option5 == false))
	{
		document.getElementById("genericErrorMessage").innerHTML = "You must select one of the options to vote! <br>";
		result = false;
	}
	
	if(result == false)
    {    
        event.preventDefault();
    }
}