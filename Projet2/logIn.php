<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["email"]) || empty($_POST["email"])){
                throw new Exception("Error: incorrect email");
            }
            if(!isset($_POST["password"]) || empty($_POST["password"])){
                throw new Exception("Error: incorretc password");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        include("users.php");
        try {
            if(!isset($user) || empty($user)){
                throw new Exception("Error: user list");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        reset($user);
        $i=0;
        foreach ($user as $mail=>$password){
            if($_POST["email"]==$mail && $_POST["password"]==$password ){
                echo "Welcome back ".$mail."!<br>";
                header("Location:home.html");
                $i=1;
            }
        
        }
        if($i==0){
            header("Location:logIn.html");
            echo "Not an user";
          
        }
    }

?>