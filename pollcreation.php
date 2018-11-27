<!DOCTYPE html> 

<html>
	<head>
		<meta charset="utf-8"> </meta>
		<link rel="stylesheet" href="style.css" type="text/css">
		<script type="text/javascript" src="characterCounter.js"></script>
	</head>
	
	<body>
		<header>
			<section class="logged">
				<img  id="symbol" src="https://cdn.pixabay.com/photo/2013/07/13/10/11/green-156711_960_720.png" alt="Image Not Found">
	
				<h1> Pollit </h1>
			</section>
			
			<section class="logged">
				<div id="info">
					Name <img id="image" src ="https://iupac.org/cms/wp-content/uploads/2018/05/default-avatar.png" alt="Image Not Found">
					&nbsp;
					<a href = "main.html"> Log out </a>
				</div>
			</section>
		</header>
		
		<div id="block">
		</div>
		
		<h1 id="solo"> Create a Poll </h1>
		
		<section id="solo">
			<form id="pollCreationForm">
				<p id="wordCountDisplay">
					<span id="wordCount"></span> Characters Left
				</p> 
				
				<textarea id="createQuestion" name="question" placeholder="Write a question here..."></textarea><br>
				<textarea id="createOption1" name="option1" placeholder="Option 1"></textarea><br>
				<textarea id="createOption2" name="option2" placeholder="Option 2"></textarea><br>
				<textarea id="createOption3" name="option3" placeholder="Option 3"></textarea><br>
				<textarea id="createOption4" name="option4" placeholder="Option 4"></textarea><br>
				<textarea id="createOption5" name="option5" placeholder="Option 5"></textarea><br>	
								
				Open Poll at: <input type="date" name="pollOpenDate"> <input type="time" name="pollOpenTime"> &nbsp; 
				Close Poll at: <input type="date" name="pollCloseDate"> <input type="time" name="pollCloseTime"><br>
				
				<input id="createPoll" type="submit" value="Create Poll"><br>
			</form>
			
			<script type="text/javascript" src="pollcreation-r.js"></script>
			
			
		</section>
	</body>
</html>