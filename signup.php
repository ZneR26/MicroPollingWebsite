<?php
$validate = true;
$error = "";
$reg_screenName = "/^\w+$/";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
$reg_Bday = "/^\d{1,2}\/\d{1,2}\/\d{4}$/";
$email = "";
$date = "mm/dd/yyyy";


if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $screenName = trim($_POST["screenName"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $date = trim($_POST["birthday"]);
    
    $db = new mysqli("localhost", "rivero2r", "rivero28", "rivero2r");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }
    
    $q1 = "SELECT * FROM user WHERE email = '$email'";
    $r1 = $db->query($q1);
    
    $q2 = "SELECT * FROM user WHERE screenName = '$screenName'";
    $r2 = $db->query($q2);
    
    if($r1->num_rows > 0)
    {
        $error = "The email address you've entered is already taken.";
        $validate = false;
    }
    else if ($r2->num_rows > 0)
    {
        $error = "The screen name you've entered is already taken.";
        $validate = false;
    }
    else
    {
        $screenNameMatch = preg_match($reg_screenName, $screenName);
        if($screenName == null || $screenName == "" || $screenNameMatch == false)
        {
            $validate = false;
        }
        
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
        }
        
        
        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen< 8 || $pswdMatch == false)
        {
            $validate = false;
        }
        
        $birthdayMatch = preg_match($reg_Bday, $date);
        if($date == null || $date == "" || $birthdayMatch == false)
        {
            $validate = false;
        }
        
        $error = "";
    }
    
    if($validate == true)
    {
        $dateFormat = date("Y-m-d", strtotime($date));
        
        $q3 = "INSERT INTO user (screenName, email, password, dateOfBirth) VALUES ('$screenName', '$email', '$password', '$dateFormat')";
        
        $r3 = $db->query($q3);
        
        if ($r3 === true)
        {
            header("Location: main.php");
            $db->close();
            exit();
        }
    }
    else
    {
        $db->close();
    }
}
?>

<!DOCTYPE html> 
<html>
	<head>
		<title>Sign Up</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css" type="text/css">
		<script type="text/javascript" src="signup.js"> </script>
	</head>
	
	<body>
		<header>
			<section class="title login">
					<img  id="symbol" src="https://cdn.pixabay.com/photo/2013/07/13/10/11/green-156711_960_720.png" alt="Image Not Found">
	
					<h1> Pollit </h1>
			</section>
				
			<section class="title login">
				<form id="loginForm">
					<label id="emailMessageLogin" class="errorMessage"></label>
					Email 
					<input type="text"> &nbsp;
					
					<label id="passwordMessageLogin" class="errorMessage"></label>
					Password
					<input type="password">
					
					<input type="submit" value="Log In"/>
				</form>
				
			</section>
		</header>
		
		<div id="block">
		</div>
		
		<section>
			<section class="content">
				<h1> Create a New Account </h1>
			
				<p class="errorMessage"><?=$error?></p>
				<form id="signupForm" method="post" action="signup.php">
				<input type="hidden" name="submitted" value="1"/>
					<label id="screenNameMessage" class="errorMessage"></label>
					Screen Name: <input type="text" name="screenName"> <br>
					
					<label id="emailMessage" class="errorMessage"></label>
					Email: <input type="text" name="email"> <br>
					
					<label id="passwordMessage" class="errorMessage"></label>
					Password: <input type="password" name="password"> <br>
					
					<label id="confirmPasswordMessage" class="errorMessage"></label>
					Confirm Password: <input type="password" name="confirmPassword"> <br>
				
					<label id="birthdayMessage" class="errorMessage"></label>
					Date of Birth: <br> <input type="text" name="birthday" value="mm/dd/yyyy"> <br>
					
					<input id="createAccount" type="submit" value="Create Account">
				</form>
				
				<script type="text/javascript" src="signupR.js"> </script>
				
				
				<form class="avatar">
					Choose an Avatar <br>
					<img id="avatar" src ="https://iupac.org/cms/wp-content/uploads/2018/05/default-avatar.png" alt="Image Not Found"> <br>
				</form>
				
				
			</section>
			
			<section class="content">
			</section>
		</section>
		
	</body>
</html>