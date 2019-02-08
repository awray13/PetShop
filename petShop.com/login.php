<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include db_connect2 file
require_once "../db_connect2.php";
 
// Define variables and initialize with empty values
$username = $password = $firstName = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["hashed_password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["hashed_password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT customerID, username, hashed_password, firstName FROM customerAccounts WHERE username = ?";
        
        if($stmt = mysqli_prepare($db_connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $firstName);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["customerID"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["firstName"] = $firstName;                            
                            
                            // Redirect user to welcome page
                            header("Location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password or username you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($db_connection);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style1.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="images/favicon.gif" type="image">
        <title>Login Page</title>
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
            <form method="post" action="">
                <fieldset>
                    <legend>Login</legend>
                        UserName:<br>
                        <input type="text" name="username"><br>
                        Password:<br>
                        <input type="password" name="hashed_password">
                        <br><br>
                        <button type="submit" value="Submit">Submit</button><br>
                        <a href="reset.php">Reset Password</a>
                </fieldset>
            </form>
        </main>
        
        <!--including my js file-->
        <script src="js/navbar.js"></script>
    </body>
</html>