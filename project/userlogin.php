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
if(isset($_SESSION['user_id'])) {
  // Redirect the user to the home page
  header("Location:user1.html");
  exit();
}

// Check if the login form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate the user's input
  $email = trim($_POST['email']);
  $password = trim($_POST['psw']);
  $hash = md5($password);

  $sql="SELECT * from user WHERE email = '$email' AND password = '$hash'";
  $res = mysqli_query($conn, $sql) or die();
  while($row = mysqli_fetch_assoc($res)){
      $usr_id = $row['user_id'];
  }
  if(mysqli_num_rows($res) > 0){
    $_SESSION['user_id'] = $usr_id;
    header("Location:user1.html");
  }
  else{
    echo "Failed";
  }
}

?>