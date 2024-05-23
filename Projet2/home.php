<?php 
    session_start();
    include("users.php");   
    global $users;
    $users=getUserlist(); //gets userlist
    try {
        if(!isset($users) || empty($users)){
                throw new Exception("Error: home.php : user list");
        }
    }  
    catch(Exception $e){
        echo $e->getMessage();
    }   
    reset($users);
    $count=count($users);
    $lastUsers=array(); //array of the last 5 new users 
    $i=0;
    
    for($i=0; $i<5; $i++){ 
        $j=0;
        for($j=0;$j<$count-1;$j++){ //for each of the users in the list
            if(date_create_from_format("d/m/Y" , $users[$j][7])>date_create_from_format("d/m/Y" , $users[$j+1][7])){ //if the $j user's account creation date is more recent
              foreach ($lastUsers as $user){ //for each of the last 5 new users
                if($user[0]!=$users[$j][0]){ //if the user isn't already in the array
                        $lastUsers[$i]=$users[$j]; //is added to the array
                    }
                }  
            }
        }     
    }
  
   foreach ($lastUsers as $user){ //display the results
        echo "$user[1]<br>";
   }
    
      
   
?>