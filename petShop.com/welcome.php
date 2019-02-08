<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style1.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="images/favicon.gif" type="image">
        <title>Welcome Page</title>
    </head>
   
   <body>
   	<header>
            <img id="paw" src="images/pawPrint.gif">
            <span>Pet Shop</span>
            <div class="navbar" id="responsiveNavBar">
                <ul>
                    <li><a href="index.html" >HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="store.html">STORE</a></li>
                    <li><a href="contactForm.php" >CONTACT</a></li>
                    <li><a href="login.php" class="active">LOGIN</a></li>
                    <li><a href="setup.html">SIGNUP</a></li>
                    <a href="#" class="icon" onclick="myFunction()">
                        <i class="fa fa-bars"></i></a>
                </ul>
            </div>
        </header>

        <main>
	      <h1>Welcome Back! <?php echo $_SESSION["firstName"]; ?></h1> 
	      <h5><a href="">Purchase History</a></h5>
	      <h5><a href="reset.php">Change/Reset Password</a></h5>
	      <h5><a href="">Update Account Info</a></h5>
	      <h5><a href="">Delete Account</a></h5>
	      <h5><a href = "logout.php">Sign Out</a></h5>
	    </main>
   </body>
   
</html>