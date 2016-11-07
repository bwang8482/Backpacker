<?php
session_start();
$user=$_SESSION['login_user'];
$post=$_POST['post_id'];

$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username= "backpack_zbc";
$password="123456";
$dbname="backpack_user";

//Create connection
$connection = new mysqli($servername, $username, $password, $dbname);


$sql = "DELETE FROM post WHERE writer_username='$user' AND post_id='$post' ";
mysqli_query($connection, $sql);
header("Location: my_post.php");
?>




