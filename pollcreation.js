function validatePoll(event) 
{
	var question = document.forms.pollCreationForm.question.value;
	var option1 = document.forms.pollCreationForm.option1.value;
	var option2 = document.forms.pollCreationForm.option2.value;
	var option3 = document.forms.pollCreationForm.option3.value;
	var option4 = document.forms.pollCreationForm.option4.value;
	var option5 = document.forms.pollCreationForm.option5.value;
	
	const maxCharactersForQuestion = 100;
	const maxCharactersForAnswers = 50;
	
	var numberOfChoices = 0;
	
	document.getElementById("questionMessage").innerHTML = "";
	document.getElementById("optionsMessage").innerHTML = "";
	document.getElementById("genericDateTimeMessage").innerHTML = "";
	
	var result = true;
	
	if ((question == "") || (question == null)) 
	{  
	    document.getElementById("questionMessage").innerHTML = "Question cannot be left blank and must not exceed over 100 characters. <br>";
	    result = false;
    }
	
	if ((option1 == "") || (option1 == null))
	{  
	    result = false;
    } 
		else
		{
			numberOfChoices++;
		}
	
	if ((option2 == "") || (option2 == null)) 
	{  
	    result = false;
    }
		else
		{
			numberOfChoices++;
		}
	
	if ((option3 == "") || (option3 == null)) 
	{  
	    result = false;
    }
		else
		{
			numberOfChoices++;
		}
	
	if ((option4 == "") || (option4 == null)) 
	{  
	    result = false;
    }
		else
		{
			numberOfChoices++;
		}
	
	if ((option5 == "") || (option5 == null)) 
	{  
	    result = false;
    }
		else
		{
			numberOfChoices++;
		}
	
	if (numberOfChoices < 2)
	{
		document.getElementById("optionsMessage").innerHTML = "You must provide atleast 2 options for an answer. <br>";
		result = false;
	}
	else 
	{
		result = true;
	}
	
	var pollOpenDate = document.getElementById("pollOpenDate").value;
	var pollCloseDate = document.getElementById("pollCloseDate").value;
	
	var pollOpenTime = document.getElementById("pollOpenTime").value;
	var pollCloseTime = document.getElementById("pollCloseTime").value;
	
	
	if ((pollOpenDate == "") || (pollOpenDate == null))
	{
		document.getElementById("genericDateTimeMessage").innerHTML = "Please input a date and time <br>";
		result = false;
	}
	
	if ((pollCloseDate == "") || (pollCloseDate == null))
	{
		document.getElementById("genericDateTimeMessage").innerHTML = "Please input a date and time <br>";
		result = false;
	}
	
	if ((pollOpenTime == "") || (pollOpenTime == null))
	{
		document.getElementById("genericDateTimeMessage").innerHTML = "Please input a date and time <br>";
		result = false;
	}
	
	if ((pollCloseTime == "") || (pollCloseTime == null))
	{
		document.getElementById("genericDateTimeMessage").innerHTML = "Please input a date and time <br>";
		result = false;
	}
	
	var startYear = pollOpenDate.substring(0, 4);
	var startMonth = pollOpenDate.substring(5, 7);
	var startDay = pollOpenDate.substring(8, 10);
	
	var endYear = pollCloseDate.substring(0, 4);
	var endMonth = pollCloseDate.substring(5, 7);
	var endDay = pollCloseDate.substring(8, 10);
	
	var currentDate = new Date();
	//var startDate = new Date(pollOpenDate);
	//var startDate = new Date(startYear, startMonth, startDay);
	//var endDate = new Date(pollCloseDate);
	
	var currentMinute = currentDate.getMinutes();
	var currentHour = currentDate.getHours();
	if (currentHour == '0') {currentHour = 24;}
	var currentTime = currentHour + "." + currentMinute;
	
	var startTime = pollOpenTime.split(":");
	var startHour = startTime[0];
	if (startHour == '00') {startHour = 24;}
	var startMinute = startTime[1];
	
	var pollOpenTimeConverted =  startHour + "." + startMinute;
	
	if (currentDate.getFullYear() > startDate.getFullYear())
	{
		document.getElementById("genericDateTimeMessage").innerHTML = "The opening date cannot be before today's date and time. <br>";
		result = false;
	}
	else if (currentDate.getFullYear() == startYear/*startDate.getFullYear()*/)
	{
		if ((currentDate.getMonth() + 1) > startMonth/*startDate.getMonth() + 1*/)
		{
			document.getElementById("genericDateTimeMessage").innerHTML = "The opening date cannot be before today's date and time. <br>";
			result = false;
		}
		else if ((currentDate.getMonth() + 1) == startMonth/*(startDate.getMonth() + 1)*/)
		{
			if (currentDate.getDate() > startDay/*(startDate.getDate() + 1)*/)			
			{
				document.getElementById("genericDateTimeMessage").innerHTML = "The opening date cannot be before today's date and time. <br>";
				result = false;
			}
	
			else if (currentDate.getDate() == startDay/*(startDate.getDate() + 1)*/)
			{
				if ((Math.abs(currentTime)) > (Math.abs(pollOpenTimeConverted)))
				{
					document.getElementById("genericDateTimeMessage").innerHTML = "The opening date cannot be before today's date and time. <br>";
					result = false;
				}
			}
		}
	}
	
	var endTime = pollCloseTime.split(":");
	var endHour = endTime[0];
	if (endHour == '00') {endHour = 24;}
	var endMinute = endTime[1];
	
	var pollCloseTimeConverted = endHour + "." + endMinute;
	
	if (/*(startDate.getFullYear())*/startYear > endYear/*(endDate.getFullYear())*/)
	{
		document.getElementById("genericDateTimeMessage").innerHTML = "The opening year date cannot be before the closing year date. <br>";
		result = false;
	}
	else if (/*(startDate.getFullYear())*/ startYear == endYear/*(endDate.getFullYear())*/)
	{
		if (/*(startDate.getMonth() + 1)*/ startMonth > endMonth/*(endDate.getMonth() + 1)*/)
		{
			document.getElementById("genericDateTimeMessage").innerHTML = "The opening month date cannot be before the closing month date. <br>";
			result = false;
		}
		else if (/*(startDate.getMonth() + 1)*/startMonth == endMonth/*(endDate.getMonth() + 1)*/)
		{
			if (/*startDate.getDate()*/startDay > endDay/*(endDate.getDate())*/)			
			{
				document.getElementById("genericDateTimeMessage").innerHTML = "The opening day date cannot be before the closing day date. <br>";
				result = false;
			}
			else if (/*startDate.getDate()*/startDay == endDay/*(endDate.getDate())*/)
			{
				if ((Math.abs(pollOpenTimeConverted)) > (Math.abs(pollCloseTimeConverted)))
				{
					document.getElementById("genericDateTimeMessage").innerHTML = "The opening date time cannot be before the closing date time. <br>";
					result = false;
				}
			}
		}
	}
	
	if(result == false)
    {    
        event.preventDefault();
    }
}