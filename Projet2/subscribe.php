<?php 
    session_start();

        try {
           
            if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
                throw new Exception("Error: not logged in");
            }
           
           
        }
        catch(Exception $e){
            echo  $e->getMessage();
        }  
        if(isset($_SESSION["msg"]) || !empty($_SESSION["msg"])){
            echo $_SESSION["msg"];
        }
        $_SESSION["msg"]="Subscribe to our site for 5$ per month or 30$ per year and gain access to the chat !";
        
       
    
    
   
?>