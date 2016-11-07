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
    <title>Chat</title>
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



    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
    
        // ask user for name with popup prompt    
        var name = "<?php echo $_SESSION['login_user'];?>"
        
        // default name is 'Guest'
        if (!name || name === ' ') {
           name = "Guest";  
        }
        
        // strip tags
        name = name.replace(/(<([^>]+)>)/ig,"");
        
        // display name on page
        //$("#name-area").html("You are: <span>" + name + "</span>");
        
        //start chat
        var chat =  new Chat();
        $(function() {
        
             chat.getState(); 
             
             // watch for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
                                                                                                                                                                                                            });
             // watch for key release
             $('#sendie').keyup(function(e) {   
                                 
                  if (e.keyCode == 13) { 
                  
                    var text = $(this).val();
                    var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
                        chat.send(text, name);  
                        $(this).val("");
                        
                    } else {
                    
                        $(this).val(text.substring(0, maxLength));  
                    }   
                    
                    
                  }
             });
            
        });
    </script>

    </head>


<body onload="setInterval('chat.update()', 1000)">

    <nav class="navbar navbar-default" role="navigation" >
        <div class="container" height>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
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
        <div id="page-wrap">
                <br><br><br><br><br><br>
                <h2>Backpacker Chatroom</h2><br>
                <p id="name-area"></p>
                <div id="chat-wrap"><div id="chat-area"></div></div>
                <form id="send-message-area">
                    <p>Your message: </p>
                    <textarea id="sendie" maxlength = '100' ></textarea>
                </form>
            </div>
    </body>
</html>
        