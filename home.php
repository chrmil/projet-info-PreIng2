<?php 
    session_start();
    include("users.php");   
    $users=getUserlist(); //gets userlist, not global
    
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
    $c=count($users);
    for($i=0; $i<10 ; $i++ ){
        $add=1;
        for ($j=0; $j<$c-1 ; $j++){
            if(date_create_from_format("d/m/Y" , $users[$j+1][7]) > date_create_from_format("d/m/Y" ,$users[$j][1][7])){ 
                $profile=$users[$j+1]; //select the most recent profile  
            }   
        }
        foreach($lastUsers as $user){ //check it isn't already in the array
            if($profile[0]==$user[0]){
                $add=0;
            }
        }
        if ($add){
            $lastUser[$i]=$profile; //adds it to the array
            $users=array_diff($users , array($profile)); //removes the profile from the list 
            $c=count($users); //updates the count
        }
    } 
            
      
    echo "test\n";
    foreach ($lastUsers as $user){ //display the results
        echo "$user[1]\n";
    }
    
      
   
?>
