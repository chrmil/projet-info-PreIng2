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
        $userDetails = array();
        for($i=0;$i<9;$i++) {
               $userDetails[] = array(
                    "nom" => "empty", // adds username
                    "age" => "empty", // adds user age
                    "sex" => "empty", // adds user gender
                    "type" => "empty",  // adds user type
                    "starter" => "empty" , // adds user starter
                    "color" => "empty" // adds user type color
                );
        }
         
    }
    elseif(count($search)>=9){
            // array to stock user's details 
        $userDetails = array();
        foreach ($search as $user) {
                $userDetails[] = array(
                    "nom" => $user[1], // adds username
                    "age" => $user[2], // adds user age
                    "sex" => $user[6], // adds user gender
                    "type" => $user[15],  // adds user type
                    "starter" => $user[13] , // adds user starter
                    "color" => $type_color[$user[15]] // adds user type color
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
                        "starter" => "empty" , // adds user starter
                        "color" => "empty" // adds user type color
                );
            }
            else{
                $userDetails[] = array(
                    "nom" => $search[$i][1], // adds username
                    "age" => $search[$i][2], // adds user age
                    "sex" => $search[$i][6], // adds user gender
                    "type" => $search[$i][15],  // adds user type
                    "starter" => $search[$i][13] , // adds user starter
                    "color" => $type_color[$search[$i][13]] // adds user type color
                );
            }
        }
     }
   
    
 
     // Converts the array with user names and ages in JSON
     $userDetailsJSON = json_encode($userDetails);
 
     // send the JSON to the HTML page
     echo $userDetailsJSON;
    
   
      
   
?>
