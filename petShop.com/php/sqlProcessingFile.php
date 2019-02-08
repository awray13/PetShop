<?php 

//connect to the petShop Database
include "../../db_connect2.php";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['hashed_password'];

//hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

//sql insert command
$sql = "
INSERT INTO customerAccounts(firstName, lastName, email, phone, username, hashed_password)
VALUES('$firstName', '$lastName', '$email', '$phone', '$username', '$hashed_password')";

//run query and display results
if (mysqli_query($db_connection, $sql)){
	echo "<br><br> New Record Successfully Created";
}
else{
	echo "Error: ".$sql."<br>".mysql_error($db_connection);
}

//close the database
mysqli_close($db_connection);

?>

<br><br><br>
<a href="../index.html">Back to Home</a><br><br>
<a href="../setup.html">Back to Sign Up Page</a><br>