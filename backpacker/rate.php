<?php
session_start();
$user=$_SESSION['login_user'];
$post=$_POST['post_id'];
$rate_value = $_POST['rating_value'];



$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username= "backpack_zbc";
$password="123456";
$dbname="backpack_user";

//Create connection
$connection = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT * FROM rating WHERE username='$user' AND postID='$post'";
$result = mysqli_query($connection, $sql);
// echo "$post";
// echo "$user";
if($result->num_rows == 0)
{
	// echo "$user, $post, $rate_value";
	$sql = "INSERT INTO rating (username, postID, ratingValue, datetimestamp)
			VALUES ('$user', '$post', '$rate_value', CURRENT_TIMESTAMP)";

	mysqli_query($connection, $sql);
	// echo "<script>window.location.replace('http://backpacker.web.engr.illinois.edu/index.php');</script>";
}
else
{
	$sql = "UPDATE rating SET ratingValue = '$rate_value', datetimestamp = CURRENT_TIMESTAMP WHERE postID = '$post'";
		mysqli_query($connection, $sql);
	// echo "<script>window.location.replace('http://backpacker.web.engr.illinois.edu/index.php');</script>";
}

// below is the part updating the dev table
$sql = "SELECT DISTINCT r1.postID, r2.ratingValue - r1.ratingValue
		AS rating_difference
		FROM rating r1, rating r2
		WHERE r1.username = '$user' AND
		 r2.postID = '$post' AND
		  r2.username = '$user';";

$db_result = mysqli_query($connection, $sql);
$num_rows = $db_result->num_rows;

while($row = mysqli_fetch_assoc($db_result)){ //going thru every single post in the rating
	$other_postID = $row["postID"]; //the current post out of all posts
	$rating_difference = $row["rating_difference"];

//update:
	if(mysqli_num_rows(mysqli_query($connection, "SELECT postID1 FROM dev WHERE postID1 = $post AND postID2=$other_postID"))>0)
	//if the pair ($post, $other_postID) is already in the dev table
	//then we just want to update 2 rows
	{
		$sql = "UPDATE dev SET count=count+1, sum=sum+$rating_difference 
				WHERE postID1=$post AND postID2=$other_postID";
		mysqli_query($connection, $sql);

		if($post != $other_postID){
			$sql = "UPDATE dev SET count=count+1, sum=sum-$rating_difference
					WHERE postID1=$other_postID AND postID2=$post";
			mysqli_query($connection, $sql);
		}
	}
//insert:
	else
	// if the pair ($post, $other_postID) is not in the dev table,
	// then we want to insert 2 rows into the dev table
	{ 
		$sql = "INSERT INTO dev (postID1, postID2, count, sum) 
				VALUES ('$post','$other_postID','1','$rating_difference')";
				mysqli_query($connection, $sql);
		//if the posts are different, we will need to insert another table with postID1 and postID2 reversed
		if($post != $other_postID) {
			$sql = "INSERT INTO dev (postID1, postID2, count, sum)
					VALUES ('$other_postID', '$post', 1, -$rating_difference)";
			mysqli_query($connection, $sql);
		}
	}


}

// echo "<script>window.location.replace('http://backpacker.web.engr.illinois.edu/index.php');</script>";

// $sql = "SELECT postID2, (sum / count) AS average
// 		FROM dev
// 		WHERE count> 2 AND postID1 = '$post'
// 		ORDER BY (sum/count) DESC
// 		LIMIT 10";
// //the greater the value of sum/count meaning the rate difference between the current 
// //and the other post. Thus the other post is more recommanding		

// $suggest_result = mysqli_query($connection, $sql);
// while ($row = mysqli_fetch_assoc($suggest_result))
// {
// 	echo $row['postID2'];
// }
// echo "<br>";

// $sql2 = "SELECT d.postID1 as 'item', sum(d.sum + d.count * r.rating_value)/sum(d.count) AS 'avgrat'
// 		 FROM rating r, dev d
// 		 WHERE r.username = '$user' AND d.postID1 NOT IN 
// 		 (SELECT postID FROM rating WHERE username='$user')
// 		 AND d.postID2=r.postID
// 		 GROUP BY d.postID1 ORDER BY avgrat DESC LIMIT 10";

// $suggest_result = mysqli_query($connection, $sql2);
// while ($row = mysqli_fetch_assoc($suggest_result))
// {
// 	echo $row['postID2'];
// }
// echo "<br>";



?>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>More Post Suggested To You</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation" >
        <div class="container" height>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <a class="navbar-brand" href="index.php" style = "float:left; margin-right:0px;">BackPacker</a>
            <div style = "height: 60px;width:50%; margin-left:0px;margin-right:10px;float:left;">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="search.php">Search</a>
                    </li>
                    <li>
                        <a href="recommend.php">Find</a>
                    </li>
                    <li>
                        <a href="chat.php">Chat</a>
                    </li>
                    <li>
                        <a href="#">about us </a>
                    </li>
                    <li>
                        <div id="log"></div>
                    </li>
                </ul>            
            </div>
            <div id = "menuright">
            <?php
            $servername = "engr-cpanel-mysql.engr.illinois.edu";
            $username= "backpack_general";
            $password="123456";
            $dbname="backpack_user";

            //Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            //Check connection
            // if(mysqli_connect_error()){
            //  die("Database connection failed: " .mysqli_connect_error());
            // }
            // echo "Connected sucessfully<br><br>";
            ?>
                <?php           
                    if(isset($_SESSION['login_user'])){  //detect if there is an login user
                    $show='                                       
                              <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Hello '.$_SESSION['login_user']. '
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li><a href="new_post.php">New Post</a></li>
                                  <li><a href="my_post.php">My Post</a></li>
                                <li><a href="send.php">Send Message</a></li>
				<li><a href="message.php">My Message</a></li>
                                  <li><a href="logout.php">Log out</a></li>
                                </ul>
                              </div>';
                    }
                    else{
                    $show='<a href="login.php" class="loginbut">login</a> 
                           <a href="signup.php" class="signbut">sign up</a>';

                    }
                    echo $show;     
                ?>       
                             
            </div>
            <!-- <div id = "menuright">
                <input placeholder="search" type="text" spellcheck="false" value="" id="search"
                            style ="line-height: 21px; height: 28px;
                                        float:left; border-radius:3px; border:1px solid #AEAEAE; padding-left:8px;"> 
                <a href="login.html" id="loginbut">login</a>  
                <a href="signup.html" id="signbut">signup</a>                  
            </div> -->
            <!-- /.navbar-collapse -->

        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class = "row" id="most_recent_post" style="margin-top:100px; position:relative">
                <div class = "col-lg-12">
                    <h1 class = "text-center">More Posts Suggested To You </h1>
                    <h4 class="text-center"> Thank you for rating this post! </h4>
                    <h5 class = "text-center">Here are more posts that have similar rating by all users</h5>
                </div>
        </div>

<?php

	$sql = "SELECT postID2, (sum / count) AS average
		FROM dev
		WHERE count> 2 AND postID1 = '$post'AND postID2 <> '$post'
		ORDER BY (sum/count) DESC
		LIMIT 10";
//the greater the value of sum/count meaning the rate difference between the current 
//and the other post. Thus the other post is more recommanding		

		$suggest_result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($suggest_result))
		{
			$post_id_recommend = $row['postID2'];
			$sql_recommend = "SELECT * FROM post WHERE post_id='$post_id_recommend'";
			$result_recommend = mysqli_query($connection, $sql_recommend);
			$row_recommend = mysqli_fetch_assoc($result_recommend);

            $rating_postid_prev = $row['postID2'];
            $cur_user = $_SESSION['login_user'];
            $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
            $rating_result = mysqli_query($conn, $rating_sql);
            $rating_row = mysqli_fetch_assoc($rating_result);

                if(isset($_SESSION['login_user'])) {
                    if ($rating_result->num_rows != 0)
                        $prev_rate_block ='<span style="margin-left:800px; color:#4e7ebe"> Your Previously Rated This Post '.$rating_row["ratingValue"].'<span>';
                    else
                        $prev_rate_block ='<span style="margin-left:800px; color:#4e7ebe"> You have not rated this post yet<span>';
                    $rate_block = ' 
                                <form method="post" action="rate.php">
                                            <select name="rating_value" style ="margin-left:800px; margin-top:10px;line-height: 40px; font-size:17px; height: 35px;border-radius:3px; border:1px solid #AEAEAE; width:10%;background-color:rgba(255,255,255,1); text-align:center;
                                    margin-bottom:5%;">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option  value="3">3</option>
                                                <option  value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <input type="submit" name="submit" class="btn btn-primary btn-m active"  style="width:80px"  value="rate">
                                            <input type="hidden"  class="btn btn-primary btn-m "  name="post_id" value="'.$row_recommend['post_id'].'"/>
                                        </form>' ; 
                    }
//$_SESSION['index[$i]']=$row["post_id"];
        //$row["post_id"];
        if($row_recommend['post_id'] > 0)
        {
            echo '
            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                
                        
                        <hr>
                        <h2 class = "text-center">
                               <strong><em>'.$row_recommend["title"].'</em></strong>
                        </h2>

                        <h2 class = "intro-text text-center">
                            '.$row_recommend["location"] .' '.$row_recommend["date"].'
                         </h2>
                        <h2  class = "intro-text text-center">
                            Category: '.$row_recommend["category"].'
                            PostID: '.$row_recommend["post_id"].'
                        </h2>
                        <hr>
                        <hr class="visible-xs">
                        <p class = "recent_post_container" style="height:400px">
                            
                            '.$row_recommend["content"].'
                        </p>
        ';
                echo $prev_rate_block;
        echo $rate_block;
        echo '</div></div></div>';
        }
    }

?>


        

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>backpacker &copy; 2015 All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })



    </script>

    <script src="js/backpacker.js"></script>

</body>

</html>