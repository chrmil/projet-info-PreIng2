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
    $lastUsers=array_fill(0, 10 , array_fill(0, 18, 0) ); //array of the last 10 new users 
    $i=0;
    $j=0;
    $c=count($users);
    for($i=0; $i<10 ; $i++ ){
        for ($j=0; $j<$c ; $j++){
            $t1=1;
            for($k=0; $k<10 ; $k++ ){
                $array=$users[$j];
                if($array[0]==$lastUsers[$k][0]){//check $j isn't already in the array
                    $t1=0;
                }
            }
            if($t1 && $lastUsers[$i][18]<$users[$j][18]){
                $lastUsers[$i]=$users[$j];
            }
        }
    } 
    $test=fopen("test1.txt", "w+");
    foreach ($users as $user){
        fputcsv($test, $user, ";");
        fwrite($test, "\n");
    }
    fclose($test);  
    $test=fopen("test2.txt", "w+");
    foreach ($lastUsers as $user){
        fputcsv($test, $user, ";");
        fwrite($test, "\n");
    }
    fclose($test);       
    $full=1; 
    foreach ($lastUsers as $user){ //display the results
        if($user[0]!=0){
            echo "$user[1]\n"; //to modify in order to display the profiles more properly 
        }
        else{
            $full=0;
        }
    }
    if ($full==0){
        echo "No other trainers have joined us yet.\n";
    }
    
      
   
?>
