<?php 
    session_start();
    include("users.php");   
    $users = getUserlist(); //gets user list
    
    try {
        if(!isset($users) || empty($users)){
            throw new Exception("Error: home.php : user list");
        }
        if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
            throw new Exception("Please log in to see the 10 last new trainers");
        }
    }  
    catch(Exception $e){
        #echo $e->getMessage();
    }   

    $lastUsers = array_fill(0, 10, array_fill(0, 19, 0)); //tab of the latest 10 new users
    $i = 0;
    $j = 0;
    $c = count($users);
    for($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < $c; $j++) {
            $t1 = 1;
            for($k = 0; $k < 10; $k++) {
                $array = $users[$j];
                if($array[0] == $lastUsers[$k][0]) { // checks if $j isn't already in the array
                    $t1 = 0;
                }
            }
            if($t1 && $lastUsers[$i][18] < $users[$j][18]) {
                $lastUsers[$i] = $users[$j];
            }
        }
    } 

    // array to stock user's details such as name and age
    $userDetails = array();
    foreach ($lastUsers as $user) {
        if($user[0] != 0) {
            $userDetails[] = array(
                "nom" => $user[1], // adds username
                "age" => $user[2], // adds user age
                "sex" => $user[6],// adds user gender
                "starter" => $user[13],  // adds user starter
                "type" => $user[15] // adds user type
            );
        }
        else{ //if not enough users to fill the array
            $userDetails[] = array(
                "nom" => "empty", 
                "age" => "empty", 
                "sex" =>"empty",
                "starter" =>"empty",
                "type" => "empty"

            );
        }
    }

    // Converts the array with user names and ages in JSON
    $userDetailsJSON = json_encode($userDetails);

    // send the JSON to the HTML page
    echo $userDetailsJSON;
?>
