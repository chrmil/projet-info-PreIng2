<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["username"]) || empty($_POST["username"])){
                throw new Exception("Error: incorrect username");
            }
            if(!isset($_POST["password"]) || empty($_POST["password"])){
                throw new Exception("Error: incorrect password");
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
        foreach ($user as $name=>$password){
            if($_POST["username"]==$name && $_POST["password"]==$password ){
                header("Location:home.html");
                $i=1;
            }
        
        }
        if($i==0){
            header("Location:logIn.html");
          
        }
    }

?>
