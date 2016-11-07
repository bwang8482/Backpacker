<?php
include('checklogin.php'); // Includes Login Script
// include('ajax_refresh.php');
session_start();
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
?>


<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Find</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
            #recommend_holder{
                    margin-left:auto; 
                    margin-right:auto;
                    position:absolute;
                    width:40%;
                    height:60%;
                    position: absolute;
                    top:0;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    margin: auto;
                    background-color:rgba(250,250,250,0);
                    padding-top:5%;
                    padding-bottom:3px;
                    text-align:center;
                    z-index: 9999;
                    display: inline-block;
                    float: bottom;

                }
            } 
    </style>
        <title>Recommend</title>
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
            <div id = "menuright" style="margin-left:200px;">
                <!-- <input placeholder="search" type="text" spellcheck="false" value="" id="search"
                            style ="line-height: 21px; height: 28px;
                                        float:left; border-radius:3px; border:1px solid #AEAEAE; padding-left:8px;">  -->


            <?php           
                echo $show;     
               ?>       
                             
            </div>
        </div>
        <!-- /.container -->
    </nav>


    <div style="padding-top:100px; margin-left:auto;margin-right:auto;">
        <div id="recommend_holder" >
        <span style = "margin-bottom:auto; line-height:40px;color:white; font-size:30px;">Find people you may want to know.
         <br>Find place you may want to go.</span><br>
            <form  method="post" action="">
                <input  type="submit" name="submit" value="Find" 
                    class="btn btn-primary btn-large" style="margin-top:20px;width:40%;height:40px"><br>
            </form>
              
        </div>
    </div>   
    
    
    
    
    <?php
        if(isset($_POST['submit'])){
            $search_type = $_POST['search_type'];
            $search_res = $_POST['content'];
            $current_user = $_SESSION['login_user'];
            $servername = "engr-cpanel-mysql.engr.illinois.edu";
            $username= "backpack_zbc";
            $password="123456";
            $dbname="backpack_user";
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn)
                die("Connection failed: " . mysqli_connect_error());
            
            $insertrank = "CREATE TEMPORARY TABLE rank AS
                            SELECT post1.writer_username, count(*) num
                            FROM post post2
                            JOIN post post1 ON post2.location = post1.location 
                            AND post2.writer_username != post1.writer_username
                            WHERE post2.writer_username = '$current_user'
                            GROUP BY post1.writer_username
                            ORDER BY num DESC
                            ";
            mysqli_query($conn, $insertrank) or die(mysqli_error($conn));
            $select1 = "SELECT * FROM rank";
            $result1 = mysqli_query($conn,$select1) or die(mysqli_error($conn));
            
            if (!$result1) {
                die(mysqli_error($conn));
            }

            if (mysqli_num_rows($result1)) {

                echo '<div style="margin-top:270px;">
                    <div class="row">
                        <div class="box">
                            <div class="col-lg-12"><p class="text-center">';

                $firstRow1 = mysqli_fetch_array($result1);
                if ($firstRow1)
                    echo "You may want to know <b style='color:#0066ff'>".$firstRow1[writer_username]. " </b> - You have <b style='color:#0066ff'>". $firstRow1[num]." </b>footpoint in common"."<br>";
                $secondRow1 = mysqli_fetch_array($result1);
                if ($secondRow1)
                    echo "You may want to know <b style='color:#0066ff'>".$secondRow1[writer_username]. " </b>- You have <b style='color:#0066ff'>". $secondRow1[num]." </b>footpoint in common"."<br>";

                $thirdRow1 = mysqli_fetch_array($result1);
                if ($thirdRow1)
                    echo "You may want to know <b style='color:#0066ff'>".$thirdRow1[writer_username]. " </b>- You have <b style='color:#0066ff'>". $thirdRow1[num]." </b>footpoint in common"."<br>";
            } 
            else {
                echo '<div style="margin-top:350px;">
                    <div class="row">
                        <div class="box">
                            <div class="col-lg-12">
                                <h2 class = "text-center">
                                You are special! You have no common footpoint with others.
                                </h2>       
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                die(mysqli_error($conn));
            }  
            echo "<br>";


            $inserttotal = "CREATE TEMPORARY TABLE recommend AS
                            SELECT post1.location, sum(rank.num) num
                            FROM rank
                            JOIN post post1 ON rank.writer_username = post1.writer_username
                            LEFT JOIN post post2 ON post2.writer_username = '$current_user' 
                            AND post2.location = post1.location
                            WHERE post2.location is NULL
                            GROUP BY post1.location
                            ORDER BY num DESC
                            ";
            mysqli_query($conn,$inserttotal) or die(mysqli_error($conn));

            $select2 = "SELECT * FROM recommend";
            $result2 = mysqli_query($conn,$select2) or die(mysqli_error($conn));

            if (!$result2) {
                die(mysqli_error($conn));
            }


            if (mysqli_num_rows($result2)) {    

                $firstRow = mysqli_fetch_array($result2);
                if($firstRow)
                    echo "You may like <b style='color:#0066ff'> ".$firstRow[location]. "</b> - The attractiveness index is  <b style='color:#0066ff'>". $firstRow[num]." </b><br>";
                
                $secondRow = mysqli_fetch_array($result2);
                if($secondRow)
                    echo "You may like <b style='color:#0066ff'>".$secondRow[location]. "</b> - The attractiveness index is <b style='color:#0066ff'>". $secondRow[num]."</b> <br>";
                
                $thirdRow = mysqli_fetch_array($result2);
                if($thirdRow)
                    echo "You may like <b style='color:#0066ff'>".$thirdRow[location]. " </b> - The attractiveness index is <b style='color:#0066ff'>". $thirdRow[num]."</b> <br>";
                echo '</p></br></br>';
                echo '<h6 class="text-center">';
                echo "Attraction index: recommends weight different according to the common footpoint with you."."<br>";
                echo "   e.g. people have 3 common footpoint with you may weight 3 in our recommend system."."<br>";
                echo "       while people have 1 common footpoint will only weight 1."."<br>";
                echo "<br>";
                echo '</h6></div></div></div>';       
            } 
            else {
                echo '<div style="margin-top:350px;">
                    <div class="row">
                        <div class="box">
                            <div class="col-lg-12">
                                <h2 class = "text-center">
                                You are special! You have no common footpoint with others.
                                </h2>       
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                die(mysqli_error($conn));
            }    
            echo "<br>";
            
            $sql = "SELECT * FROM post 
                    WHERE location =  '$firstRow[location]'
                    AND sentiment >= 3
                    UNION
                    SELECT * FROM post 
                    WHERE location =  '$secondRow[location]'
                    AND sentiment >= 3
                    UNION
                    SELECT * FROM post 
                    WHERE location =  '$thirdRow[location]'
                    AND sentiment >= 3
                    ";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){
                while($row = mysqli_fetch_assoc($result)) {
                //$_SESSION['index[$i]']=$row["post_id"];
                //$row["post_id"];
                $rating_postid_prev = $row['post_id'];
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
                                <input type="hidden"  class="btn btn-primary btn-m "  name="post_id" value="'.$row['post_id'].'"/>
                            </form>' ; 
                }

                echo '
                    <div class="row">
                        <div class="box">
                            <div class="col-lg-12">
                        
                                
                                <hr>
                                <h2 class = "text-center">
                                       <strong><em>'.$row["title"].'</em></strong>
                                </h2>

                                <h2 class = "intro-text text-center">
                                    '.$row["location"] .' '.$row["writer_username"].'
                                 </h2>
                                <h2 class = "intro-text text-center">
                                    sentiment: '.$row["sentiment"] .'
                                 </h2>
                                <h2  class = "intro-text text-center">
                                    '.$row["date"].'
                             </h2>
                                <hr>
                                <hr class="visible-xs">
                                <p class = "recent_post_container">
                                    
                                    '.$row["content"].'
                                </p>';

                        echo $prev_rate_block;
                        echo $rate_block;
                    echo '
                            </div>
                        </div>
                    </div>
                ';
                }
            } 

        }
        ?>
    

    </body>
</html>

        