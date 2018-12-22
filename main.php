<?php
    // Shows errors instead of a blank white php page
    ini_set('display_startup_errors', true);
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    
    $db = new mysqli("localhost", "rivero2r", "rivero28", "rivero2r");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

    $validate = true;
    $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
    $reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
    
    $email = "";
    $error = "";
    
    $selectRecentPolls = "SELECT * FROM poll WHERE createdDateTime IN (SELECT MAX(createdDateTime) FROM poll GROUP BY poll_ID) ORDER BY createdDateTime DESC LIMIT 5";
    $recentPollsData = $db->query($selectRecentPolls);
    
    if (isset($_POST["submitted"]) && $_POST["submitted"])
    {
        $email = trim($_POST["loginEmail"]);
        $password = trim($_POST["loginPassword"]);
        
        $db = new mysqli("localhost", "rivero2r", "rivero28", "rivero2r");
        if ($db->connect_error)
        {
            die ("Connection failed: " . $db->connect_error);
        }
    
        $q = "SELECT * from user WHERE email = '$email' AND password = '$password'";
         
        $r = $db->query($q);
        $row = $r->fetch_assoc();
        if($email != $row["email"] && $password != $row["password"])
        {
            $validate = false;
        }
        else
        {
            $emailMatch = preg_match($reg_Email, $email);
            if($email == null || $email == "" || $emailMatch == false)
            {
                $validate = false;
            }
            
            $pswdLen = strlen($password);
            $passwordMatch = preg_match($reg_Pswd, $password);
            if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false)
            {
                $validate = false;
            }
        }
        
        if($validate == true)
        {
            session_start();
            $_SESSION["user_ID"] = $row["user_ID"];
            $_SESSION["screenName"] = $row["screenName"];
            header("Location: pollmanagement.php");
            $db->close();
            exit();
        }
        else 
        {
            $error = "The email/password combination was incorrect. Login failed.";
            $db->close();
        }
    }
?>

<!DOCTYPE html> 
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<script type="text/javascript" src="login.js"> </script>
		<script type="text/javascript" src="dynamicData.js"> </script>
	</head>
	
	<body>
		<header class="normal">
			<section class="title">
				<img  id="symbol" src="https://cdn.pixabay.com/photo/2013/07/13/10/11/green-156711_960_720.png" alt="Image Not Found">
	
				<h1> Pollit </h1>
			</section>
		</header>
		
		<div id="block">
		</div>
		
		<section>
			<section class="content">
				<h2 id="recentPolls"> Recent Polls </h2>
				
				<div id="test"></div>
				<div id="refreshPolls"></div>
				
				<div id="initialDisplay">
    				<?php 
    				while ($row = $recentPollsData->fetch_assoc())
                    {
                        $poll_ID = $row["poll_ID"];
                        $user_ID = $row["user_ID"];
                        $question = $row["question"];
                        $openDate = $row["openDate"];
                        $closeDate = $row["closeDate"];
                        $openTime = $row["openTime"];
                        $closeTime = $row["closeTime"];
                        $createdDateTime = $row["createdDateTime"];
                        $lastVoteDateTime = $row["lastVoteDateTime"];
                        
                        $associatedOptions = "SELECT answer_ID, voteCount, answer FROM answers WHERE poll_ID = '$poll_ID'";
                        $executeOptionSelection = $db->query($associatedOptions);
                        
                        $associatedUser = "SELECT screenName FROM user WHERE user_ID = '$user_ID'";
                        $executeUserSelection = $db->query($associatedUser);
                        $grabUsername = $executeUserSelection->fetch_assoc();
                        $screenName = $grabUsername["screenName"];
                      
                        
    //                     echo "$poll_ID &nbsp;";
    //                     echo "$user_ID &nbsp;";
    //                     echo "$question &nbsp;";
    //                     echo "$openDate &nbsp;";
    //                     echo "$closeDate &nbsp;";
    //                     echo "$openTime &nbsp;";
    //                     echo "$closeTime &nbsp;";
    //                     echo "$createdDateTime &nbsp;";
    //                     echo "$lastVoteDateTime &nbsp;";
    //                     echo "<br>";
                    ?>
                    
                    <p> 
                        <?=$screenName?> created a poll @ <?=$createdDateTime?> 
                        <h1><?=$question?></h1>
                        <?php 
                            while ($grabOption = $executeOptionSelection->fetch_assoc())
                            {
                                $answer = $grabOption["answer"];
                                $voteCount = $grabOption["voteCount"];
                                $answer_ID = $grabOption["answer_ID"];
                        ?>
                        <ul>
                        	<li><?=$answer?> </li>
                        </ul>
                        <?php
                            }
                        ?>
                        <a class="options" href = "pollresults.php?poll_ID=<?=$poll_ID?>">Results</a> &nbsp;
                        <a class="options" href = "pollvote.php?poll_ID=<?=$poll_ID?>"> Vote </a>
                    </p>
                    <br>
                    
                    <?php
                    }
                    ?>
                </div>
			</section>
			
			<section class="content">
				<h2> Log In to Create a Poll </h2>
				
				<p class="errorMessage"><?=$error?></p>
				<form id="loginForm" method="post" action="main.php">
					<input type="hidden" name="submitted" value="1"/>
					
					<label id="emailMessageLogin" class="errorMessage"></label>
					Email: <input type="text" name="loginEmail"> <br>
					
					<label id="passwordMessageLogin" class="errorMessage"></label>
					Password: <input type="password" name="loginPassword"><br>
					
					<input type="submit" value="Log In"/>
					
					<h3 id="special"> OR </h3>
					
					<a id="signup" href="signup.php"> Sign Up</a>
				</form>
				
				<script type="text/javascript" src="loginR.js"> </script>
			</section>
		</section>
		
	</body>
</html>
