<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Message</title>

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
                    <h1 class = "text-center">MY MESSAGES</h1>
                </div>
        </div>

<?php
    $cur_user=$_SESSION['login_user'];
    $sql = "SELECT * FROM message WHERE toUser = '$cur_user' ORDER BY time DESC ";
    $result = mysqli_query($conn, $sql)  or die(mysqli_error($conn));
    if($result->num_rows > 0){
        while($row = mysqli_fetch_assoc($result)) {
        //$_SESSION['index[$i]']=$row["post_id"];
        //$row["post_id"];
        echo '
            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <h5>
                            <span style="font-size:20px">'.$row["time"].'</span>  
                             <b style="font-size:20px; color:#00aaaa; margin-left:10px">'.$row["fromUser"].'</b> 
                                <span> messaged you: </span>                
                            <b style="front-size:20px;color:#2266ee; margin-left:10px">'.$row["message"].'</b>
                        </h5>

                        <div style="margin-left:900px; margin-right: auto">
                            <form method="post" action="reply.php" style="float:left" >
                                <input type="submit" class="btn btn-primary btn-m " style="width:80px"name="reply" value="Reply"/>
                                <input type="hidden"  class="btn btn-primary btn-m " style="width:80px" name="replyToUser" value="'.$row['fromUser'].'"/>
                            </form>
                        </div>
                        <div style="margin-left:900px; margin-right: auto">
                            <form method="post" action="deletemessage.php" style="float:left" >
                                <input type="submit" class="btn btn-primary btn-m " style="width:80px"name="delete" value="Delete"/>
                                <input type="hidden"  class="btn btn-primary btn-m " style="width:80px" name="deleteMessage" value="'.$row['message'].'"/>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        ';
        }
    } 
    else {
        echo '<div style="margin-top:350px;">
            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <h2 class = "text-center">
                        0 Message Found.
                        </h2>       
                        <br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
        ';
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