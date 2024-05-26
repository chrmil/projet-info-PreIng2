<?php
    session_start();
    try {
        if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
                throw new Exception("Error: logout: not logged in");
        }

    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    session_destroy();
    session_register_shutdown();
    echo "Logged out successfully";


?>