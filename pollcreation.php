<?php
    // Shows errors instead of a blank white php page
    ini_set('display_startup_errors', true);
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    
    session_start();
    
    
    if(!isset($_SESSION["user_ID"]))
    {
        header("Location: main.php");
        exit();
    }
    
    if (isset($_POST["submitted"]) && $_POST["submitted"])
    {
        
        $question = trim($_POST["question"]);
        $pollOpenDate = trim($_POST["pollOpenDate"]);
        $pollCloseDate = trim($_POST["pollCloseDate"]);
        $pollOpenTime = trim($_POST["pollOpenTime"]);
        $pollCloseTime = trim($_POST["pollCloseTime"]);
        
        $option1 = trim($_POST["option1"]);
        $option2 = trim($_POST["option2"]);
        $option3 = trim($_POST["option3"]);
        $option4 = trim($_POST["option4"]);
        $option5 = trim($_POST["option5"]);
        
        $options = array("$option1", "$option2", "$option3", "$option4", "$option5");
        
        $user_ID = $_SESSION["user_ID"];
        $screenName = $_SESSION["screenName"];
        
        $db = new mysqli("localhost", "rivero2r", "rivero28", "rivero2r");
        if ($db->connect_error)
        {
            die ("Connection failed: " . $db->connect_error);
        }
       
        $q = "INSERT INTO poll (user_ID, question, openDate, openTime, closeDate, closeTime, createdDateTime) VALUES ('$user_ID', '$question', '$pollOpenDate', '$pollOpenTime', '$pollCloseDate', '$pollCloseTime', NOW())";
        
        $r = $db->query($q);
        
        $q1 = "SELECT createdDateTime FROM poll WHERE user_ID = '$user_ID' AND question = '$question' AND openDate = '$pollOpenDate' AND closeDate = '$pollCloseDate' AND openTime = '$pollOpenTime' AND closeTime = '$pollCloseTime'";
        
        $r1 = $db->query($q1);
        
        $grabCreatedDateTime = $r1->fetch_assoc();
        
        $createdDateTime = $grabCreatedDateTime["createdDateTime"];
        
        $q2 = "SELECT poll_ID FROM poll WHERE question = '$question' AND user_ID = '$user_ID' AND createdDateTime = '$createdDateTime'";
        
        $r2 = $db->query($q2);
        
        $poll_ID = $r2->fetch_assoc();
        
        $id = $poll_ID["poll_ID"];
        
        $length = count($options);
        
        for ($i = 0; $i < $length; $i++)
        {
            $q3 = "INSERT INTO answers (poll_ID, answer, voteCount) VALUES ('$id', '$options[$i]', '0')";
            $r3 = $db->query($q3);
        }
        
        if ($r === true && $r3 === true)
        {
            header("Location: pollmanagement.php");
            $db->close();
            exit();
        } 
    } 
?>

<!DOCTYPE html> 
<html>
	<head>
		<meta charset="utf-8"> </meta>
		<link rel="stylesheet" href="style.css" type="text/css">
		<script type="text/javascript" src="pollcreation.js"></script>
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
					<?=$screenName?> <img id="image" src ="https://iupac.org/cms/wp-content/uploads/2018/05/default-avatar.png" alt="Image Not Found">
					&nbsp;
					<a href = "main.html"> Log out </a>
				</div>
			</section>
		</header>
		
		<div id="block">
		</div>
		
		<h1 id="solo"> Create a Poll </h1>
		
		<section id="solo">
			<p class="errorMessage"></p>
			
			<form id="pollCreationForm" method="post" action="pollcreation.php">
			<input type="hidden" name="submitted" value="1"/>
			
				<p id="wordCountDisplay">
					<span id="wordCount"></span> Characters Left
				</p>
				
				<label id="questionMessage" class="errorMessage"> </label>
				<textarea id="createQuestion" name="question" placeholder="Write a question here..." maxlength="100"></textarea><br>
				
				<label id="optionsMessage" class="errorMessage"> </label>
				<textarea id="createOption1" name="option1" placeholder="Option 1" maxlength="50"></textarea><br>
				<textarea id="createOption2" name="option2" placeholder="Option 2" maxlength="50"></textarea><br>
				<textarea id="createOption3" name="option3" placeholder="Option 3" maxlength="50"></textarea><br>
				<textarea id="createOption4" name="option4" placeholder="Option 4" maxlength="50"></textarea><br>
				<textarea id="createOption5" name="option5" placeholder="Option 5" maxlength="50"></textarea><br>	
								
				<label id="genericDateTimeMessage" class="errorMessage"> </label>
				Open Poll at: <input id="pollOpenDate" type="date" name="pollOpenDate"><input id="pollOpenTime" type="time" name="pollOpenTime"> &nbsp; 
				Close Poll at: <input id="pollCloseDate" type="date" name="pollCloseDate"><input id="pollCloseTime" type="time" name="pollCloseTime"><br>
				
				<input id="createPoll" type="submit" value="Create Poll"><br>
			</form>
			
			<script type="text/javascript" src="pollcreation-r.js"></script>
		</section>
	</body>
</html>