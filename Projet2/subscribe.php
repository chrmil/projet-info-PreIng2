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
            if($user[0]==$_SESSION["userID"]){ // checks user
                if($user[4]="user"){ //if no current subscription
                    $user[4]="subscribed"; 
                    $user[5]=date_format(date_add( DateInterval::createFromDateString("$_POST['length'] month"), date_create_from_format("d/m/Y" , date("d/m/Y"))), "d/m/Y");
                    echo "Thanks for subscribing $user[1] !  Your current subscription will last until the $user[5]. <br>";
                } //creates a datetime object from current date(), adds to it an interval from the chosen subscription length and convert it back to string format
                elseif ($user[4]="subscribed"){  //if currently subscribed
                    $user[5]=date_format(date_add( DateInterval::createFromDateString("$_POST['length'] month"), date_create_from_format("d/m/Y" , $user[5])), "d/m/Y");
                    //calculates from the previous expiration subscription date instead of current date 
                    echo "Thanks for prolonging your subscription $user[1] !  Your current subscription will last until the $user[5]. <br>";
                }
                else{
                    echo "Admins already have the highest access level !<br>";
                }
            }
        } 
        
        
       
    
    }
   
?>