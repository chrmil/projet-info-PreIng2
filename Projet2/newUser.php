<?php 
   
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["username"]) || empty($_POST["username"])){
                throw new Exception("Error: incorrect username");
            }
            if(!isset($_POST["password"]) || empty($_POST["password"])){
                throw new Exception("Error: incorrect password");
            }
            if(!isset($_POST["email"]) || empty($_POST["email"])){
                throw new Exception("Error: incorrect email");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        } 
        include("users.php");
        try {
            if(!isset($users) || empty($users)){
                    throw new Exception("Error: user list");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        reset($users);
        $newUser=array();
        $newUser[0]=$_POST["username"];
        $newUser[1]=$_POST["email"];
        $password=$_POST["password"];
        $newUser[2]=password_hash($password);
        $newUser[3]="user";
        $newUser[4]=$_POST["gender"];
        $newUser[5]=date();
        array_push($users, $newUser); //? 
    
    }
   
?>