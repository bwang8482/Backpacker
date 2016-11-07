<?php
    session_start();
    include 'sentiment_post.php';
    $error="";
    $su_post_id=$_POST['post_id'] ;
    $su_username=$_SESSION['login_user'];
    $servername = "engr-cpanel-mysql.engr.illinois.edu";
    $username= "backpack_zbc";
    $password="123456";
    $dbname="backpack_user";

    $su_title = $_POST['post_title'];
    $su_content = $_POST['post_content'];
    $su_location = $_POST['location'];
    // $su_month = $_POST['month'];
    // $su_cost = $_POST['cost'];
    // $su_duration = $_POST['duration'];
    $su_post_id = $_POST['post_id'];
    $su_category = $_POST['category'];
    $su_sentiment = sentiment_analysis_post($su_content);

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "UPDATE post SET writer_username = '$su_username', location = '$su_location', sentiment='$su_sentiment',
        content = '$su_content', title = '$su_title', category = '$su_category',date = CURRENT_TIMESTAMP
        WHERE  post_id = '$su_post_id' ";
        mysqli_query($conn,$sql);
        echo "<script>window.location.replace('http://backpacker.web.engr.illinois.edu/my_post.php');</script>";
    
?>               