<?php 
    session_start();
        if(!empty($_REQUEST["t"])){
            $t=$_REQUEST["t"];
            include("users.php");
            $users=getUserlist();
            foreach ($users as $user){
                if($user[1]==$t){
                    $res=$user[0];
                }
            }
            echo "userprofile.php?user=".$res;
        }
        else{
            try {
            
                if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
                    throw new Exception("Error: not logged in");
                }
            
            
            }
            catch(Exception $e){
                echo  $e->getMessage();
            }  
            echo "userprofile.php?user=".$_SESSION["userID"];
        }
    
?>