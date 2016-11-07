<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>backpacker - find your way to the world</title>

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

    <div class="brand" style="padding-top:100px;">BackPacker</div>
    <div class="address-bar">World   |   Live   |   Vision</div>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide" style="height:600px;overflow:hidden;">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive img-full" src="http://static1.squarespace.com/static/52bdd7dfe4b02ffea75a35d6/t/555d396ce4b038f06242198b/1432172934164/Copenhagen?format=2500w" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="http://static1.squarespace.com/static/52bdd7dfe4b02ffea75a35d6/t/537e930ce4b0cabbb8fa0d27/1400804113550/Mission?format=1500w
                                " alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="http://static1.squarespace.com/static/52bdd7dfe4b02ffea75a35d6/t/55afc9abe4b0f74033fc7978/1437583791194/Geneva?format=2500w" alt="">
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    <h2 class="brand-before">
                        <small>Welcome to</small>
                    </h2>
                    <h1 class="brand-name">BackPacker</h1>
                    <!-- <hr class="tagline-divider"> -->
                    <h2>
                        <small> The place to find your companion on the journey
                            <!-- <strong>Team SegV</strong> -->
                        </small>
                    </h2>
                </div>
            </div>
        </div>


        <div class = "row" id="most_recent_post">
                <div class = "col-lg-12"> 
                    <h1 class = "text-center">MOST RECENT POSTS </h1>
                </div>
        </div>
        

        
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class = "text-center">
                           <strong><em> <?php
                            $sql = "SELECT * FROM post ORDER BY date DESC";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row["title"];
                            $rating_postid_prev = $row['post_id'];
                            $cur_user = $_SESSION['login_user'];
                            $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
                            $rating_result = mysqli_query($conn, $rating_sql);
                            $rating_row = mysqli_fetch_assoc($rating_result);
                            // echo $rating_row["ratingValue"];
                            ?></em></strong>

                            <?php 
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
                            ?>

                    </h2>
                    <h2 class = "intro-text text-center"><em><?php
                            echo $row["writer_username"];
                        ?>
                        </em>
                     </h2>
                    <h2 class = "intro-text text-center">
                        <?php
                            echo $row["location"];
                        ?>
        
                        <?php
                            echo $row["date"];
                        ?>
                     </h2>
                     <h2  class = "intro-text text-center">
                        sentiment: <?php
                            echo $row["sentiment"];
                        ?>
                     </h2>
                    <hr>
                    <!-- <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt=""> -->
                    <hr class="visible-xs">
                    <p class = "recent_post_container" style="height: 400px">
                        <?php
                         echo $row["content"];
                        ?>
                    </p>

                    <?php echo $prev_rate_block ?>
                    <?php echo $rate_block ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class = "text-center">
                           <strong><em> <?php
                            $row = mysqli_fetch_assoc($result);
                            echo $row["title"];
                            $rating_postid_prev = $row['post_id'];
                            $cur_user = $_SESSION['login_user'];
                            $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
                            $rating_result = mysqli_query($conn, $rating_sql);
                            $rating_row = mysqli_fetch_assoc($rating_result);
                            // echo $rating_row["ratingValue"];
                            ?></em></strong>
                            <?php 
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
                            ?>
                    </h2>
                    <h2 class = "intro-text text-center"><em><?php
                            echo $row["writer_username"];
                        ?>
                        </em>
                     </h2>
                    <h2 class = "intro-text text-center">
                        <?php
                            echo $row["location"];
                        ?>
        
                        <?php
                            echo $row["date"];
                        ?>
                     </h2>
                    <h2  class = "intro-text text-center">
                        sentiment: <?php
                            echo $row["sentiment"];
                        ?>
                     </h2>
                    <hr>
                    <!-- <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt=""> -->
                    <hr class="visible-xs">
                    <p class = "recent_post_container" style="height: 400px">
                        <?php
                         echo $row["content"];
                        ?>
                    </p>
                    <?php echo $prev_rate_block ?>
                    <?php echo $rate_block ?>
                </div>
            </div>
        </div>

    <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class = "text-center">
                           <strong><em> <?php
                            $row = mysqli_fetch_assoc($result);
                            echo $row["title"];
                            $rating_postid_prev = $row['post_id'];
                            $cur_user = $_SESSION['login_user'];
                            $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
                            $rating_result = mysqli_query($conn, $rating_sql);
                            $rating_row = mysqli_fetch_assoc($rating_result);
                            // echo $rating_row["ratingValue"];
                            ?></em></strong>

                            <?php 
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
                            ?>
                    </h2>
                    <h2 class = "intro-text text-center"><em><?php
                            echo $row["writer_username"];
                        ?>
                        </em>
                     </h2>
                    <h2 class = "intro-text text-center">
                        <?php
                            echo $row["location"];
                        ?>
        
                        <?php
                            echo $row["date"];
                        ?>
                     </h2>

                    <h2  class = "intro-text text-center">
                        sentiment: <?php
                            echo $row["sentiment"];
                        ?>
                     </h2>
                    <hr>
                    <!-- <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt=""> -->
                    <hr class="visible-xs">
                    <p class = "recent_post_container" style="height: 400px">
                        <?php
                         echo $row["content"];
                        ?>
                    </p>
                    <?php echo $prev_rate_block ?>
                    <?php echo $rate_block ?>
                </div>
            </div>
        </div>
            <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class = "text-center">
                           <strong><em> <?php
                            $row = mysqli_fetch_assoc($result);
                            echo $row["title"];
                            $rating_postid_prev = $row['post_id'];
                            $cur_user = $_SESSION['login_user'];
                            $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
                            $rating_result = mysqli_query($conn, $rating_sql);
                            $rating_row = mysqli_fetch_assoc($rating_result);
                            // echo $rating_row["ratingValue"];
                            ?></em></strong>

                            <?php 
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
                            ?>
                    </h2>
                    <h2 class = "intro-text text-center"><em><?php
                            echo $row["writer_username"];
                        ?>
                        </em>
                     </h2>
                    <h2 class = "intro-text text-center">
                        <?php
                            echo $row["location"];
                        ?>
        
                        <?php
                            echo $row["date"];
                        ?>
                     </h2>

                    <h2  class = "intro-text text-center">
                        sentiment: <?php
                            echo $row["sentiment"];
                        ?>
                     </h2>
                    <hr>
                    <!-- <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt=""> -->
                    <hr class="visible-xs">
                    <p class = "recent_post_container" style="height: 400px">
                        <?php
                         echo $row["content"];
                        ?>
                    </p>
                    <?php echo $prev_rate_block ?>
                    <?php echo $rate_block ?>
                </div>
            </div>
        </div>
            <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class = "text-center">
                           <strong><em> <?php
                            $row = mysqli_fetch_assoc($result);
                            echo $row["title"];
                            $rating_postid_prev = $row['post_id'];
                            $cur_user = $_SESSION['login_user'];
                            $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
                            $rating_result = mysqli_query($conn, $rating_sql);
                            $rating_row = mysqli_fetch_assoc($rating_result);
                            // echo $rating_row["ratingValue"];
                            ?></em></strong>

                            <?php 
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
                            ?>
                    </h2>
                    <h2 class = "intro-text text-center"><em><?php
                            echo $row["writer_username"];
                        ?>
                        </em>
                     </h2>
                    <h2 class = "intro-text text-center">
                        <?php
                            echo $row["location"];
                        ?>
        
                        <?php
                            echo $row["date"];
                        ?>
                     </h2>

                    <h2  class = "intro-text text-center">
                        sentiment: <?php
                            echo $row["sentiment"];
                        ?>
                     </h2>
                    <hr>
                    <!-- <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt=""> -->
                    <hr class="visible-xs">
                    <p class = "recent_post_container" style="height: 400px">
                        <?php
                         echo $row["content"];
                        ?>
                    </p>
                    <?php echo $prev_rate_block ?>
                    <?php echo $rate_block ?>
                </div>
            </div>
        </div>
            <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class = "text-center">
                           <strong><em> <?php
                            $row = mysqli_fetch_assoc($result);
                            echo $row["title"];
                            $rating_postid_prev = $row['post_id'];
                            $cur_user = $_SESSION['login_user'];
                            $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
                            $rating_result = mysqli_query($conn, $rating_sql);
                            $rating_row = mysqli_fetch_assoc($rating_result);
                            // echo $rating_row["ratingValue"];
                            ?></em></strong>

                            <?php 
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
                            ?>
                    </h2>
                    <h2 class = "intro-text text-center"><em><?php
                            echo $row["writer_username"];
                        ?>
                        </em>
                     </h2>
                    <h2 class = "intro-text text-center">
                        <?php
                            echo $row["location"];
                        ?>
        
                        <?php
                            echo $row["date"];
                        ?>
                     </h2>

                    <h2  class = "intro-text text-center">
                        sentiment: <?php
                            echo $row["sentiment"];
                        ?>
                     </h2>
                    <hr>
                    <!-- <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt=""> -->
                    <hr class="visible-xs">
                    <p class = "recent_post_container" style="height: 400px">
                        <?php
                         echo $row["content"];
                        ?>
                    </p>
                    <?php echo $prev_rate_block ?>
                    <?php echo $rate_block ?>
                </div>
            </div>
        </div>

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

// function log(txt) {
//   $("#log").html("location : <b>" + txt + "</b> px")
// }

// $(function() {
//   var eTop = $('.navbar').offset().top; //get the offset top of the element
//   log(eTop - $(window).scrollTop()); //position of the ele w.r.t window

//   $(window).scroll(function() { //when window is scrolled
//     log(eTop - $(window).scrollTop());
//   });
// });

    </script>

    <script src="js/backpacker.js"></script>

</body>
	<?php
	include('crawler-test.php');
	
	crawl();
	?>
</html>