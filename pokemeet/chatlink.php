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
        echo "messages.php?".$_SESSION["userID"];
   
?>