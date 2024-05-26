<?php 
    session_start();
    include("users.php");  
    global $search;
    $search=$_SESSION["search"];
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
    if($search[0]==0){ //if no  user found
        $userDetails = array();
        for($i=0;$i<9;$i++) {
               $userDetails[] = array(
                    "nom" => "empty", // adds username
                    "age" => "empty", // adds user age
                    "sex" => "empty", // adds user gender
                    "type" => "empty",  // adds user type
                    "starter" => "empty"  // adds user starter
                );
        }
         
    }
    elseif(count($search)>=9){
        $userDetails = array();// array to stock users' details 
        foreach ($search as $user) {
                $userDetails[] = array(
                    "nom" => $user[1], // adds username
                    "age" => $user[2], // adds user age
                    "sex" => $user[6], // adds user gender
                    "type" => $user[15],  // adds user type
                    "starter" => $user[13]  // adds user starter
                );
            
        }
    }
    else{
        $userDetails = array();
        for($i=0;$i<9;$i++) {
            if(empty($search[$i]) || !isset($search[$i])){
                $userDetails[] = array(
                        "nom" => "empty", // adds username
                        "age" => "empty", // adds user age
                        "sex" => "empty", // adds user gender
                        "type" => "empty",  // adds user type
                        "starter" => "empty"  // adds user starter
                );
            }
            else{
                $userDetails[] = array(
                    "nom" => $search[$i][1], // adds username
                    "age" => $search[$i][2], // adds user age
                    "sex" => $search[$i][6], // adds user gender
                    "type" => $search[$i][15],  // adds user type
                    "starter" => $search[$i][13]  // adds user starter
                );
            }
        }
     }
 
     // Converts the array with user names and ages in JSON
     $userDetailsJSON = json_encode($userDetails);
 
     // send the JSON to the HTML page
     echo $userDetailsJSON;
    
   
      
   
?>