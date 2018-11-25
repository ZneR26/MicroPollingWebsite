function characterCounter(event) {
	var currentTextArea = event.currentTarget;
	var wordCount = document.getElementById("wordCount");
	
	var characters = currentTextArea.value.split('');
	wordCount.innerText = characters.length;
}