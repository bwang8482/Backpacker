<?php
session_start();
$user=$_SESSION['login_user'];
$post=$_POST['deleteMessage'];

$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username= "backpack_zbc";
$password="123456";
$dbname="backpack_user";

//Create connection
$connection = new mysqli($servername, $username, $password, $dbname);


$sql = "DELETE FROM message WHERE toUser='$user' AND message='$post' ";
mysqli_query($connection, $sql);
header("Location: message.php");
?>



