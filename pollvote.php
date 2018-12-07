<?php
    // Shows errors instead of a blank white php page
    ini_set('display_startup_errors', true);
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    
    if (isset($_POST["submitted"]) && $_POST["submitted"])
    {
        $chosenOption = $_POST["option"];
        $poll_ID = $_GET["poll_ID"];
        
        $db = new mysqli("localhost", "rivero2r", "rivero28", "rivero2r");
        if ($db->connect_error)
        {
            die ("Connection failed: " . $db->connect_error);
        }
        
        $selectAssociatedAnswerID = "SELECT answer_ID FROM answers WHERE poll_ID = '$poll_ID' AND answer = '$chosenOption'";
        $executeAnswerIDQuery = $db->query($selectAssociatedAnswerID);
        $grabAnswerID = $executeAnswerIDQuery->fetch_assoc();
        $answer_ID = $grabAnswerID["answer_ID"];
        
        echo $answer_ID;
        
        $incrementVoteCount = "UPDATE answers SET voteCount = voteCount + 1 WHERE answer_ID = '$answer_ID'";
        $executeIncrementVoteCountQuery = $db->query($incrementVoteCount);
        
        if ($executeIncrementVoteCountQuery === true)
        {
            header("Location: pollresults.php");
            $db->close();
            exit();
        }
    }
    
    session_start();
    
    $poll_ID = $_GET["poll_ID"];
    
    $db = new mysqli("localhost", "rivero2r", "rivero28", "rivero2r");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }
    
    $selectAssociatedUser = "SELECT user_ID FROM poll WHERE poll_ID = '$poll_ID'";
    $executeUserSelectionQuery = $db->query($selectAssociatedUser);
    $grabUser = $executeUserSelectionQuery->fetch_assoc();
    $user_ID = $grabUser["user_ID"];
    
    $selectAssociatedUserInfo = "SELECT * FROM user WHERE user_ID = '$user_ID'";
    $executeUserInfoQuery = $db->query($selectAssociatedUserInfo);
    $grabUserInfo = $executeUserInfoQuery->fetch_assoc();
    $screenName = $grabUserInfo["screenName"];
    
    $selectAssociatedCreatedDateTime = "SELECT createdDateTime FROM poll WHERE poll_ID = '$poll_ID'";
    $executeCreatedDateTimeQuery = $db->query($selectAssociatedCreatedDateTime);
    $grabCreatedDateTime = $executeCreatedDateTimeQuery->fetch_assoc();
    $createdDateTime = $grabCreatedDateTime["createdDateTime"];
    
    $selectAssociatedQuestion = "SELECT question FROM poll WHERE poll_ID = '$poll_ID'";
    $executeQuestionSelectionQuery = $db->query($selectAssociatedQuestion);
    $grabQuestion = $executeQuestionSelectionQuery->fetch_assoc();
    $question = $grabQuestion["question"];
    
    $selectAssociatedOptions = "SELECT answer FROM answers WHERE poll_ID = '$poll_ID'";
    $executeOptionSelectionQuery = $db->query($selectAssociatedOptions);
    
?>
<!DOCTYPE html>
<html>	
	<head>
		<link rel="stylesheet" href="style.css" type="text/css">
		<script type="text/javascript" src="pollvote.js"> </script>
	</head>
	
	<body>
		<header>
			<section class="title login">
				<img  id="symbol" src="https://cdn.pixabay.com/photo/2013/07/13/10/11/green-156711_960_720.png" alt="Image Not Found">
	
				<h1> Pollit </h1>
			</section>
			<section class="title login">
				<form>
				Username/Email 
					<input type="text"> &nbsp;
				Password
					<input type="password">
					
					<a href = "signup.html"> Log in </a>
				</form>
			</section>
		</header>
		
		<div id="block">
		</div>
		
		<section>
			<section class="content">
				<h2> Register Your Vote!</h2>
				
				<img id ="image" src ="https://iupac.org/cms/wp-content/uploads/2018/05/default-avatar.png" alt="Image Not Found">
				<?=$screenName?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				CREATED : <?=$createdDateTime?>
				
				<h3> <?=$question?> </h3>
				
				<form id="voteForm" method="post" action="pollvote.php?poll_ID=<?=$poll_ID?>">
					<input type="hidden" name="submitted" value="1"/>
    				<?php 
    				    $optionNumber = 0;
        				while ($grabOptions = $executeOptionSelectionQuery->fetch_assoc())
        				{
        				    $optionNumber++;
        				    $option = $grabOptions["answer"];
    				?>
    					 <input type="radio" id="option<?=$optionNumber?>" name="option" value="<?=$option?>"> <?=$option?><br>
    				<?php   
        				}
    				?>
    				<label id="genericErrorMessage" class="errorMessage"></label>
    				<input id="registerVote" type="submit" value="Vote!">
    				&nbsp;<a href = "main.php"> Go back to the homepage </a
				</form>
				
				<script type="text/javascript" src="pollvoteR.js"> </script>
			</section>
			
			<section class="content">
			</section>
		</section>
	</body>
</html>