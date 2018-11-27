function characterCounter(event)
{
	var maxCharactersForQuestion = 100;
	var maxCharactersForAnswers = 50;
	
	var currentTextArea = event.currentTarget;
	
	var textIdentifier = currentTextArea.id.substring(6, 14);
	var maxIdentifier;
	
	var wordCount = document.getElementById("wordCount");
	
	var characters = currentTextArea.value.split('');
	//wordCount.innerText = characters.length;
	
	
	if (textIdentifier == "Question")
		{
			maxIdentifier = maxCharactersForQuestion;
			wordCount.innerText = maxIdentifier - characters.length;
		}
	else 
		{
			maxIdentifier = maxCharactersForAnswers;
			wordCount.innerText = maxIdentifier - characters.length;
		}
}