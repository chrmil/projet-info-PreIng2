<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["username"]) || empty($_POST["username"])){
                throw new Exception("Error: login: incorrect username");
            }
            if(!isset($_POST["password"]) || empty($_POST["password"])){
                throw new Exception("Error: login : incorrect password");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        include("users.php");
        global $users;
        $users=getUserlist();
        try {
            if(!isset($users) || empty($users)){
                throw new Exception("Error: login : user list");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        reset($users); 
        $i=0;
       
        foreach ($users as $user){
            if( ($_POST["username"]==$user[1] || $_POST["username"]==$user[2]) && password_verify($_POST["password"],$user[3])){
                echo "Welcome back ".$user[1]."!<br>";
                //session start ?
                header("Location:home.html");
                $i=1;
            }
        
        }
        if($i==0){
            header("Location:logIn.html");
          
        }
    }

?>