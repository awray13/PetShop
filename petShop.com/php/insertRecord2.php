<?php
//connect to the PetShop database
include "../../db_connect.php";

$first = $_POST['fname'];
$last = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// sql insert command
$sql = "
INSERT INTO message(fname, lname, email, phone, message)
VALUES('$first', '$last', '$email', '$phone', '$message')";

// run query and display results
if (mysqli_query($db_connection, $sql)){
	echo"<br><br>New Record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($db_connection);
}

// close the database
mysqli_close($db_connection);

?>

<br><br><br>
<a href="../index.html">Back to Home</a><br><br>
<a href="../contactForm.php">Back to Message Form</a><br>