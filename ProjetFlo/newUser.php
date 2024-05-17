<?php 
   
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["username"]) || empty($_POST["username"])){
                throw new Exception("Error: incorrect username");
            }
            if(!isset($_POST["password1"]) || empty($_POST["password1"])){
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
        global $users;
        reset($users);
        $newUser=array();
        $newUser[0]=$_POST["username"];
        $newUser[1]=$_POST["email"];
        $password=$_POST["password1"];
        $newUser[2]=password_hash($password,PASSWORD_BCRYPT);
        $newUser[3]="user";
        $newUser[4]=$_POST["gender"];
        $newUser[5]=date("d/m/Y");
        newUser($newUser);
    
    }
   
?>