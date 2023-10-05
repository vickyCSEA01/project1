<?php
session_start(); // start session

// database connection parameters
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "project";

// connect to database
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// check if form has been submitted
if (isset($_POST['submit'])) {
    // get username and password from form
    $username = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['psw']);

    // query the database to check if username and password are correct
    $query = "SELECT * FROM admin WHERE user_name='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // check if a row is returned
    if (mysqli_num_rows($result) == 1) {
        // login successful, set session variables and redirect to admin page
        $_SESSION['username'] = $username;
        header('Location: indexad.html');
        exit();
    } else {
        // login failed, display error message
        $error="invalid login cratancial";
		echo $error;
    }
}
else{
	echo "not submitted";
}

mysqli_close($conn); // close database connection
?>
