<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "../db_connect2.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE customerAccounts SET hash_password = ? WHERE customerID = ?";
        
        if($stmt = mysqli_prepare($db_connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["customerID"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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
        <h2>Reset Password</h2>
        <h2>Please fill out this form to reset your password.</h2>
        <form action="php/sqlProcessingFile.php" method="post"> 
            <fieldset>
                <legend>Reset Password</legend>
                <label>New Password</label><br>
                <input type="password" name="new_password" value="<?php echo $new_password; ?>"><br>
                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password"><br>
                <button type="submit" name="Submit" value="Submit">Submit</button><br>
                <a href="welcome.php">Cancel</a>
        </fieldset>
        </form>   
    </body>
</html>