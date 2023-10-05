<?php
// Start a session to store user information
session_start();

// database connection parameters
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "project";

// connect to database
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


// Check if the user has already logged in

// Check if the signup form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate the user's input
  $email = trim($_POST['email']);
  $password = trim($_POST['psw']);
  $confirm_password = trim($_POST['confirm_password']);

  // Check if the passwords match
  if($password != $confirm_password) {
    // Display an error message
    $error_message = "Passwords do not match.";
	echo $error_message;
  } else {
    // Hash the password
    $hashed_password = md5($password);
	
  	$query = "INSERT into user(email, password) values('$email', '$hashed_password')";
    $result = mysqli_query($conn, $query);

    // check if a row is returned
    if ($result == 1) {
       // Redirect the user to the home page
     header("Location: userlogin.html");   
     //echo "Data Inserted";
    }

   //echo mysqli_connect_error($conn);
    exit();
  }
}

?>