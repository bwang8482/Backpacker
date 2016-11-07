<?php
include('checklogin.php'); // Includes Login Script
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
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

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
                <a class="navbar-brand" href="index.html">BackPacker</a>
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
            <!-- /.navbar-collapse -->

        </div>
        <!-- /.container -->
    </nav>

    <div style="margin-left:auto; margin-right:auto;position:relative;">
        
        <div style="margin:auto;width:40%;">
            <form method="post" action = "">
                
                <input placeholder="username" name="username" type="text" spellcheck="false" value="" id="username"
                style ="line-height: 40px; font-size:17px; height: 50px;border-radius:3px; border:1px solid #AEAEAE; width:100%;background-color:rgba(255,255,255,0.9);
                margin-top:300px;margin-bottom:25px;text-align:center;">
        
        
            
            <input placeholder="password" name="password" type="password" spellcheck="false" value="" id="password"
                style ="line-height: 40px; font-size:17px; height: 50px;border-radius:3px; border:1px solid #AEAEAE; width:100%;background-color:rgba(255,255,255,0.9);margin-bottom:25px;text-align:center;">
             

        
            <button name="submit" type="submit" data-target="#" style="line-height: 40px; font-size:17px; height: 50px;border-radius:3px; border:1px solid #AEAEAE; width:100%;background-color:rgba(255,255,255,1);
                margin-bottom:25px;text-align:center;">sign in</button>
            <p id="errormessage" class = "text-center"><?php echo $error; ?></p>
            </form>
        </div>
    </div>
</div>

</body>

</html>