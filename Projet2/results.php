<?php 
    session_start();
    include("users.php");  
    global $search;
    $search=$_SESSION["search"];
    $search_fail=$_SESSION["search_fail"];
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
    if($search_fail=="no user found"){ //if no  user found with specified username
        echo "There is no trainer fitting those filters.<br>"; 
         
    }
    else{
        foreach ($search as $user){ //display the results
            echo "$user[1]<br>"; //to modify in order to display the profiles more properly 
        
        }
    }
   
    
      
   
?>
