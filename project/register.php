<?php
// Start a session to store user information
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "project";

// connect to database
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

session_start();

// Check if the user has already logged in
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

// Check if the login form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate the user's input
  $Name = $_POST['name'];
  $Address = $_POST['address'];
  $PhoneNumber= $_POST['phonenumber'];
  $Date= $_POST['date'];
  $Problem= $_POST['problem'];

  $sql = "INSERT INTO user_prob (name, address, phonenumber,date,problem ) VALUES ('$Name', '$Address', '$PhoneNumber', '$Date','$Problem')";
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    header("Location: user1.html");
        
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);
}
  ?>


