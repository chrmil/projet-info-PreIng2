<?php 
    session_start();
    include("users.php");   
    global $users;
    $users=getUserlist(); //gets userlist
    
    try {
        if(!isset($users) || empty($users)){
                throw new Exception("Error: home.php : user list");
        }
        if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
            throw new Exception("Please log in to see the 10 last new trainers");
        }

    
    }  
    catch(Exception $e){
        echo $e->getMessage();
    }   
    reset($users);
    $lastUsers=array(); //array of the last 10 new users 
    $i=0;
    $j=0;
    foreach ($users as $user){ //for each of the users in the list
        foreach ($lastUsers as $last){
        if(date_create_from_format("d/m/Y" , $user) > date_create_from_format("d/m/Y" ,$_SESSIONlastUser)){ //if the $j user's account creation date is more recent
            
                //to add
        }
    } 
            
      
    echo "test\n";
    foreach ($lastUsers as $user){ //display the results
        echo "$user[1]\n";
    }
    
      
   
?>
