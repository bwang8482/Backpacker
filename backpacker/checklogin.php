<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) && empty($_POST['password'])) {
$error = "Username and Password is invalid";
}
else if(empty($_POST['username']) && !empty($_POST['password'])){
$error="Please enter username! ";
}
else if(!empty($_POST['username']) && empty($_POST['password'])){
$error="Please enter password! ";
}
else
{
// Define $username and $password
$uname=$_POST['username'];
$pword=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username= "backpack_zbc";
$password="123456";
$dbname="backpack_user";

//Create connection
$connection = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT * FROM user WHERE username ='$uname' AND password='$pword' ";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
//$rows = mysql_num_rows($row["username"]);
if ($row>0) {
$_SESSION['login_user']=$uname; // Initializing Session
header("location: my_post.php"); // Redirecting To Other Page
} 
else {
$error = "Username or Password is invalid";
//session_destroy();
//header('location:login.php');
}
//mysql_close($connection); // Closing Connection
}
}
?>