<?php 
    session_start();
    include("users.php");   
    global $search;
    try {
        if(!isset($search) || empty($search)){
                throw new Exception("Error: results.php : user list");
        }
        if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
            throw new Exception("Please log in ");
            header("Location:home.html");
        }

    
    }  
    catch(Exception $e){
        echo $e->getMessage();
    }   
    
   
    foreach ($search as $user){ //display the results
        echo "$user[1]\n"; //to modify in order to display the profiles more properly 
     
    }
    
      
   
?>