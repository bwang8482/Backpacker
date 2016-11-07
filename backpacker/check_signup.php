<?php
session_start();
$error='';

        if(isset($_POST['submit']))
        {
        $servername = "engr-cpanel-mysql.engr.illinois.edu";
        $username= "backpack_zbc";
        $password="123456";
        $dbname="backpack_user";

        $su_username = $_POST['username'];
        $su_password = $_POST['password'];
        $su_age = $_POST['age'];
        $su_gender = $_POST['gender'];
        $su_city = $_POST['city'];
        if ($su_username == "" || $su_password == "" || $su_age=="" || $su_city == ""){
            $error= "Missing information!!";
        }
            
        else{
            $conn = new mysqli($servername, $username, $password, $dbname);
            //$conn = mysqli_connect($servername, $username, $password, $dbname);
            
            $query = "SELECT * FROM user WHERE username='$su_username'";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);
            //var_dump($conn);
            if ($row>0)
            {
               $error=" Username already exist!!";
            }
            else
            {
                $sql = "INSERT INTO user (username, password, age, gender, city) 
                    VALUES('$su_username','$su_password','$su_age','$su_gender','$su_city')";
                mysqli_query($conn,$sql);
                $_SESSION['login_user']=$su_username;
                header("Location: index.php");
            }
        }
    }
    ?> 