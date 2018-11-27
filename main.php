<?php
    $validate = true;
    $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
    $reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
    
    $email = "";
    $error = "";
    
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
            $_SESSION["email"] = $row["email"];
            header("Location: pollmanagement.html");
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
				<h2> Recent Polls </h2>
				
				<h3> QUESTION </h3>
				
				<ul>
					<li> Option 1</li>
					<li> Option 2</li>
					<li> Option 3</li>
					<li> Option 4</li>
					<li> Option 5</li>
				</ul>
				
				<!-- SHOULD BE A BUTTON IN THE FUTURE -->
				<a class="options" href = "pollresults.html"> Results </a> &nbsp;
				<a class="options" href = "pollvote.html"> Vote </a>
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
