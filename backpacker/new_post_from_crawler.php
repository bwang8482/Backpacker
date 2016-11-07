<?php

	require_once __DIR__ . '/best-sentiment.php';

	$titleIn = $_POST["title"];
	$contentIn = $_POST["content"]; //"<p>Already wishing for warmer weather ... and it's not even officially winter yet? With summer"
	$authorIn = $_POST["author"];
	$locationIn = $_POST["location"];
	
	$title1 = (string)$titleIn;
	$location1 = (string)$locationIn;
	$content1 = (string)$contentIn;
	$author1 = (string)$authorIn;


	if($location == "undefined") 
		$location = null;

	// $servername = "localhost";
        $servername = "engr-cpanel-mysql.engr.illinois.edu";
        $username= "backpack_zbc";
        $password="123456";
        $dbname="backpack_user";
	$conn = new mysqli($servername, $username, $password, $dbname);
	
        if($conn->connect_error){
            // echo "database connection failed <br>";
        }

	$content =  mysqli_real_escape_string($conn,$content1);
	$title =  mysqli_real_escape_string($conn,$title1);
	$author =  mysqli_real_escape_string($conn,$author1);
	$location =  mysqli_real_escape_string($conn,$location1);
	$rating = sentiment_analysis($contentIn);
	
	$cmd = "SELECT * FROM crawled_posts WHERE title = '".$title."'";
	$result = $conn->query($cmd);

        // echo $result->num_rows."    ";
	// echo $content;
	
	if($result->num_rows==0){
                // echo $content;
		$cmd = "INSERT INTO crawled_posts(author, location, content, title, rating) VALUES('$author','$location','$content','$title', '$rating')";
		
		if(!mysqli_query($conn,$cmd)){
			// echo "in     ";
			echo ("Error: ".mysqli_error($conn)."    ");
		}
		echo "success";
		return;
	}

	echo "duplicate";
	// echo $title;
	// post_id, author, location, content, title, date

?>