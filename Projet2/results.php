<?php 
    session_start();
    include("users.php");   
    global $search;
    try {
        if(!isset($search) || empty($search)){
                throw new Exception("Error: results.php : search user list");
                header("Location:home.html");
        }
        if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
            throw new Exception("Please log in ");
            header("Location:home.html");
        }

    
    }  
    catch(Exception $e){
        echo $e->getMessage();
    }   
    if($search="empty"){ //if no filters
        $users=getUserlist();
        try {
            if(!isset($users) || empty($users)){
                throw new Exception("Error: results.php : user list");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        } 
        foreach ($users as $user){ //display the results
            echo "$user[1]\n"; //to modify in order to display the profiles more properly 
         
        }
    }
    else{
        foreach ($search as $user){ //display the results
            echo "$user[1]\n"; //to modify in order to display the profiles more properly 
     
        }
    }
   
    
      
   
?>