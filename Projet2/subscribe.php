<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["length"]) || empty($_POST["length"])){
                throw new Exception("Error: length unspecified");
            }
            if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
                throw new Exception("Error: not logged in");
            }
           
        }
        catch(Exception $e){
            echo $e->getMessage();
        } 
        include("users.php");   
        global $users;
        $users=getUserlist(); //gets userlist
        try {
            if(!isset($users) || empty($users)){
                    throw new Exception("Error: subscribe.php : user list");
            }
        }  
        catch(Exception $e){
            echo $e->getMessage();
        }   
        reset($users);
        foreach($users as $user){
            if($user[0]==$_SESSION["userID"]){
                if($user[4]="user"){
                    $user[4]="subscribed";
                    $user[5]=array($_POST["length"], date("d/m/Y"));
                }
                elseif ($user[4]="subscribed"){ //to modify 
                    $user[5][0]+=$_POST["length"];
                    $user[5][1]=date("d/m/Y");
                }
                else{
                    echo "Admins already have the highest access level !.<br>";
                }
            }
        } 
        
        
       
    
    }
   
?>