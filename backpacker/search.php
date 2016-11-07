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

    <title>Search</title>

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
            #search_holder{
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
                    padding-top:10%;
                    padding-bottom:3px;
                    text-align:center;
                    z-index: 9999;
                    display: inline-block;
                    float: bottom;

                }
                
            .input_container input {
                line-height: 21px; 
                font-size:17px; 
                height: 40px;
                border-radius:5px; 
                border:1px solid #AEAEAE; 
                padding-left:8px;
                width:60%;
                margin-top:15px;
                background-color:rgba(255,255,255,0.9);
            }
            .input_container ul {
                font-size: 17px;
                border: 1px solid #eaeaea;
                width: 60%;
                background: #f3f3f3;
                padding-left: 0px;
                list-style: none;
                margin-left: auto;
                margin-right: auto;
                border-radius: 5px;
            }
            .input_container ul li {
                padding: 2px;
            }
            #post_title_id {
                display: none;
            }
            .input_container ul li:hover {
                background: rgba(234,234,234,1);
    


            } 
    </style>
        <title>Search Post</title>
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


    <div style="padding-top:100px; margin-left:auto; margin-right:auto;">
        <div id="search_holder">

            <span style = "margin:10px; line-height:40px;color:white; font-size:30px;">Search Post</span><br>
            <form  method="post" action="">
                <div class="input_container">
                    <input  placeholder="Please search and click on prompt" type="text" spellcheck="false" value="" id="search" name="content"
                            onkeyup="autocomplet()">
                    <ul id="post_title_id">
                        <!-- <li>HAHAHA</li>
                        <li>hhalfhas</li>
                        <li>asfkhsaflk</li> -->
                    </ul>
                </div>


                <select name="search_type" id="type_search" style = "height: 40px;line-height:21px; width:20%; border-radius:20%;">
                    <option value="writer_username" >Writer</option>
                    <option value="post_title"selected>Title</option>
                    <option value="location">Location</option>
                </select>


                <input  type="submit" name="submit" value="Search"  class="btn btn-primary btn-m" style="height:40px; width:39%" >
                <br>
            </form>
              
        </div>
    </div>   
    
    
    
    
    <?php
        if(isset($_POST['submit'])){
            $search_type = $_POST['search_type'];
            $search_res = $_POST['content'];
            $servername = "engr-cpanel-mysql.engr.illinois.edu";
            $username= "backpack_zbc";
            $password="123456";
            $dbname="backpack_user";
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn)
                die("Connection failed: " . mysqli_connect_error());
            
            if($search_type=='writer_username'){
                $sql = "SELECT * FROM post WHERE writer_username LIKE '%".$search_res."%'";
                $fromcrawler = "SELECT * FROM crawled_posts WHERE author LIKE '%".$search_res."%'";
            }
            else if($search_type=='post_title'){
                $sql = "SELECT * FROM post WHERE title LIKE '%".$search_res."%'";
                $fromcrawler = "SELECT * FROM crawled_posts WHERE title LIKE '%".$search_res."%'";
            }
            else if($search_type=='location'){
                $sql = "SELECT * FROM post WHERE location LIKE '%".$search_res."%'";
                $fromcrawler = "SELECT * FROM crawled_posts WHERE location LIKE '%".$search_res."%'";
            }
            $result = mysqli_query($conn, $sql);
            $crawledposts = mysqli_query($conn, $fromcrawler);
            
            if (mysqli_num_rows($result)>0 || mysqli_num_rows($crawledposts)>0) {
                echo '<div style="margin-top:350px;">';

                while($row = mysqli_fetch_assoc($result)) {

                    $rating_postid_prev = $row['post_id'];
                    $cur_user = $_SESSION['login_user'];
                    $rating_sql = "SELECT * FROM rating WHERE postID =  $rating_postid_prev AND username = '$cur_user'";
                    $rating_result = mysqli_query($conn, $rating_sql);
                    $rating_row = mysqli_fetch_assoc($rating_result);

                    echo '
                     
                    <div class="row" >
                        <div class="box">
                            <div class="col-lg-12">
                            <hr>
                            <h2 class = "text-center">
                                   <strong><em>'.$row["title"].'</em></strong>
                            </h2>

                            <h2 class = "intro-text text-center">
                                '.$row["writer_username"].'
                             </h2>
                             <h2 class = "intro-text text-center">
                                '.$row["location"].' '.$row["date"].'   overall sentiment:'.$row[sentiment].'
                             </h2>
                            <hr>
                            <hr class="visible-xs">
                            <p class = "recent_post_container" style="height:400px; margin-bottom:10px">
                                '.$row["content"].'
                            </p>';

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
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <input type="submit" name="submit" class="btn btn-primary btn-m active" style="width:80px" value="rate">
                                    <input type="hidden"  class="btn btn-primary btn-m "  name="post_id" value="'.$row['post_id'].'"/>
                                </form>' ; 
                    }
                    echo $prev_rate_block;
                    echo $rate_block;
                    echo '</div></div></div>';
                }

                while($row = mysqli_fetch_assoc($crawledposts)) {

                    echo '<div class="row" >
                            <div class="box">
                                <div class="col-lg-12">
                                <hr>
                                <h2 class = "text-center">
                                       <strong><em>'.$row["title"].'</em></strong>
                                </h2>

                                <h2 class = "intro-text text-center">
                                    '.$row["author"].'
                                 </h2>
                                 <h2 class = "intro-text text-center">
                                    '.$row["location"].' '.$row["date"].'    overall sentiment:'.$row[rating].'
                                 </h2>
                                <hr>
                                <hr class="visible-xs">
                                    <div>'.$row["content"].'</div>';
                    echo '</div></div></div>';

                }

        echo '</div>';
       
    } 
    else {
        echo '<div style="margin-top:350px;">
            <div class="row">
                <div class="box">
                    <div class="col-lg-12" style="height: 255px;">
                        <h2 class = "text-center" style="padding-top: 50px">
                        0 Post Found.
                        </h2>       
                 
                    </div>
                </div>
            </div>
            </div>
        ';
    }       
        }
        ?>
    
    </body>
    
    <script type="text/javascript">
        function autocomplet() {
            var min_length = 0; // min caracters to display the autocomplete
            var keyword = $('#search').val();
            var search_type = document.getElementById('type_search').value;

            console.log(search_type);

            if (keyword.length >= min_length) {
                $.ajax({
                    url: 'ajax_refresh.php',
                    type: 'POST',
                    data: {keyword:keyword, search_type:search_type}, 
                    success:function(data){
                        $('#post_title_id').show();
                        $('#post_title_id').html(data);
                    }
                });
                // console.log(keyword);
            } else {
                $('#post_title_id').hide();
            }
        }
         
        // set_item : this function will be executed when we select an item
        function set_item(item) {
            // change input value
            $('#search').val(item);
            // hide proposition list
            $('#post_title_id').hide();
        }
    </script>

</html>

        