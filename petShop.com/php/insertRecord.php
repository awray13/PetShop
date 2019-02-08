<?php
// connect to the PetShop database
include "../../db_connect.php";

// sql insert command
$sql = "
INSERT INTO message(fname, lname, email, phone, message)
VALUES('Judy', 'Garland', 'jgarland@gtcc.edu', '111-222-1234', 'I love your site')";

// run query and display results
if (mysqli_query($db_connection, $sql)){
	echo"<br><br>New Record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($db_connection);
}

// close the database
mysqli_close($db_connection);

?>