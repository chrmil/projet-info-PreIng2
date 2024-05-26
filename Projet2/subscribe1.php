<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["mlength"]) || empty($_POST["mlength"])){
                throw new Exception("Error: length unspecified");
            }
            if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
                throw new Exception("Error: not logged in");
            }
           
        }
        catch(Exception $e){
            $_SESSION["msg"]= $e->getMessage();
        } 
        include("users.php");   
        global $users;
        $users=getUserlist(); //gets userlist
        try {
            if(!isset($users) || empty($users)){
                    throw new Exception("Error: subscribe1.php : user list");
            }
        }  
        catch(Exception $e){
            $_SESSION["msg"]= $e->getMessage();
        }   
        reset($users);
        try{
            $try=1;
            foreach($users as $user){
                if($user[0]==$_SESSION["userID"]){ // checks user
                    $try=0;
                    if($user[4]==2){ //if no current subscription
                        $user[4]=1; 
                        $format="d/m/Y";
                        $date=date($format); //creates a datetime object from current date
                        $datetime=date_create_from_format($format, $date );
                        $interval=new DateInterval('P'.$_POST["mlength"].'M');
                        $subdate=date_add( $datetime,$interval );// adds to it an interval from the chosen subscription length 
                        $user[5]=date_format($subdate, $format);// convert it back to string format
                        updateUser($_SESSION["userID"], $user);
                        $_SESSION["msg"]= "Thanks for subscribing $user[1] !  Your current subscription will last until the ".$user[5].".";
                    } 
                    elseif ($user[4]==1){  //if currently subscribed
                        $format="d/m/Y";
                        $date=$user[5];  //calculates from the previous subscription expiration  date instead of current date
                        $datetime=date_create_from_format($format, $date );
                        $interval=new DateInterval('P'.$_POST["mlength"].'M');
                        $subdate=date_add($datetime, $interval );
                        $user[5]=date_format($subdate, $format);
                        updateUser($_SESSION["userID"], $user);
                        $_SESSION["msg"]="Thanks for prolonging your subscription $user[1] !  Your current subscription will last until the ".$user[5].".";
                    }
                    else{
                        $_SESSION["msg"]="Admins already have the highest access level !";
                    }
                }
                
            }
            if ($try){
                throw new Exception("Error: subscribe1.php : user id");
            } 

        }
        catch(Exception $e){
            $_SESSION["msg"]= $e->getMessage();
        }   
        header("Location:subscriptions.html");
        
        
       
    
    }
   
?>