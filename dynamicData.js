var timer = setInterval(myTimer, 3000);

function myTimer() 
{
	fetchNewPoll();
	fetchUserData();
	fetchAnswers();
	fetchButtons();
}

function fetchButtons()
{
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function()
	{
		if ((xhr.readyState == 4) && (xhr.status == 200))
		{
			//document.getElementById("test").innerHTML = xhr.responseText;
			var responseObject = JSON.parse(xhr.responseText);
			
			for (var index = 0; index < responseObject.pollID.length; index++)
			{	
				var resultAnchor = document.createElement("a");
				var voteAnchor = document.createElement("a");
				
				if (index == 0)
				{
					var associatedQuestion = document.getElementById("question1");
				}
				else if (index == 1)
				{
					var associatedQuestion = document.getElementById("question2");
				}
				else if (index == 2)
				{
					var associatedQuestion = document.getElementById("question3");
				}
				else if (index == 3)
				{
					var associatedQuestion = document.getElementById("question4");
				}
				else if (index == 4)
				{
					var associatedQuestion = document.getElementById("question5");
				}
				
				var poll_ID = responseObject.pollID[index].poll_ID;
				resultAnchor.setAttribute("href", "pollresults.php?poll_ID=" + poll_ID);
				voteAnchor.setAttribute("href", "pollvote.php?poll_ID=" + poll_ID);
				
				resultAnchor.innerHTML = "Results    ";
				voteAnchor.innerHTML = "Vote";
				
				associatedQuestion.appendChild(resultAnchor);
				associatedQuestion.appendChild(voteAnchor);
			}
		}
	}
	
	xhr.open("GET", "dynamicButtons.php", true);
	xhr.send();
}

function fetchAnswers()
{
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function()
	{
		if ((xhr.readyState == 4) && (xhr.status == 200))
		{
			//document.getElementById("test").innerHTML = xhr.responseText;
			var responseObject = JSON.parse(xhr.responseText);
			
			
			var associatedQuestion = document.getElementById("question1");
			
			for (var index = 0; index < responseObject.options.length; index++)
			{	
				var unorderedListTag = document.createElement("ul");
				var orderedlistTag = document.createElement("li");
				unorderedListTag.setAttribute("class", "options1");
				
				if ((index >= 5) && (index < 10))
				{
					var associatedQuestion = document.getElementById("question2");
					unorderedListTag.setAttribute("class", "options2");
				}
				else if ((index >= 10) && (index < 15))
				{
					var associatedQuestion = document.getElementById("question3");
					unorderedListTag.setAttribute("class", "options3");
				}
				else if ((index >= 15) && (index < 20))
				{
					var associatedQuestion = document.getElementById("question4");
					unorderedListTag.setAttribute("class", "options4");
				}
				else if ((index >= 20) && (index < 25))
				{
					var associatedQuestion = document.getElementById("question5");
					unorderedListTag.setAttribute("class", "options5");
				}
				
				orderedlistTag.innerHTML = responseObject.options[index].answer;
				unorderedListTag.appendChild(orderedlistTag);
				
				associatedQuestion.appendChild(unorderedListTag);
			}
		}
	}
	
	xhr.open("GET", "dynamicOptions.php", true);
	xhr.send();
	
}

function fetchUserData()
{
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function()
	{
		if ((xhr.readyState == 4) && (xhr.status == 200))
		{
			//document.getElementById("test").innerHTML = xhr.responseText;
			var responseObject = JSON.parse(xhr.responseText);
			
			for (var index = 0; index < responseObject.screenName.length; index++)
			{	
				if (index == 0)
				{
					var userDataText = document.getElementById("user1");
				}
				else if (index == 1)
				{
					var userDataText = document.getElementById("user2");
				}
				else if (index == 2)
				{
					var userDataText = document.getElementById("user3");
				}
				else if (index == 3)
				{
					var userDataText = document.getElementById("user4");
				}
				else if (index == 4)
				{
					var userDataText = document.getElementById("user5");
				}
				
				var screenName = document.createTextNode(responseObject.screenName[index].screenName);
				
				userDataText.insertBefore(screenName, userDataText.childNodes[0]);
			}
		}
	}
	
	xhr.open("GET", "dynamicUserData.php", true);
	xhr.send();
	
}

function fetchNewPoll()
{
	document.getElementById("initialDisplay").innerHTML = "";
	
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function()
	{
		if ((xhr.readyState == 4) && (xhr.status == 200))
		{
			//document.getElementById("refreshPolls").innerHTML = xhr.responseText;
			var responseObject = JSON.parse(xhr.responseText);
			document.getElementById("refreshPolls").innerHTML = "";
			var lengthOfRefreshedPollArray = responseObject.polls.length; 
			
			for (var index = 0; index < lengthOfRefreshedPollArray; index++)
			{	
				var paragraphTagCreatedDateTime = document.createElement("p");
				var headerTagQuestion = document.createElement("h1");
				
				if (index == 0)
				{
					paragraphTagCreatedDateTime.setAttribute("id", "user1");
					headerTagQuestion.setAttribute("id", "question1");
				}
				else if (index == 1)
				{
					paragraphTagCreatedDateTime.setAttribute("id", "user2");
					headerTagQuestion.setAttribute("id", "question2");
				}
				else if (index == 2)
				{
					paragraphTagCreatedDateTime.setAttribute("id", "user3");
					headerTagQuestion.setAttribute("id", "question3");
				}
				else if (index == 3)
				{
					paragraphTagCreatedDateTime.setAttribute("id", "user4");
					headerTagQuestion.setAttribute("id", "question4");
				}
				else if (index == 4)
				{
					paragraphTagCreatedDateTime.setAttribute("id", "user5");
					headerTagQuestion.setAttribute("id", "question5");
				}
				
				headerTagQuestion.innerHTML = responseObject.polls[index].question;
				paragraphTagCreatedDateTime.innerHTML = " created a poll @ ";
				
				var createdDateTime = document.createTextNode(responseObject.polls[index].createdDateTime);
				paragraphTagCreatedDateTime.appendChild(createdDateTime);
				
				document.getElementById("refreshPolls").appendChild(paragraphTagCreatedDateTime);
				document.getElementById("refreshPolls").appendChild(headerTagQuestion);
			}
		}
	}
	
	xhr.open("GET", "dynamicPoll.php", true);
	xhr.send();
	
}

