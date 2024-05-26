<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
                throw new Exception("Error: search: not logged in");
            }
            if($_POST["min_age"]>$_POST["max_age"]){
                throw new Exception("Error: search: age filter invalid");
                header("Location:home.html");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        } 
        include("users.php");   
        global $users;
        $users=getUserlist(); //gets userlist
        try {
            if(!isset($users) || empty($users)){
                    throw new Exception("Error: search.php: user list");
            }
        }  
        catch(Exception $e){
            echo $e->getMessage();
        }   
   
        reset($users);
        $search_fail="no user found"; 
        if(!empty($_POST["username"])){ //if username precised
            foreach($users as $user){
                if($user[1]==$_POST["username"]){ //if user found
                    $search_fail="user found";
                    $search=array($user);
                    
                }
            }
            
          
        }
        
        elseif($_POST["min_age"]==18 && $_POST["max_age"]==50 && $_POST["type"]=="unspecified" && $_POST["gender"]=="unspecified"){ //if no filter
            $search=array(); //list of users fitting the search filters
            $search=$users; //display full userlist
           
           
        }
        else{
            $min = $_POST["min_age"]; 
            $max = $_POST["max_age"];
            $type = $_POST["type"];
            $gender = $_POST["gender"];
            $search = array();
            $i = 0;
            $format = "d/m/Y";
            $date = new DateTime();//current date
            $min_date = new DateTime();
            $max_date = new DateTime();
            $birthdate = new DateTime();
            $date = date_create_from_format($format, date($format)); 
            foreach ($users as $user){
                $filter=1; //1 = the profile fits the filters
                if($_POST["min_age"]!=18 || $_POST["max_age"]!=50){ //if age specified
                    if($user[8]!='empty' && !empty($user[8])){ //if the user's age is set 
                        $birthdate=date_create_from_format($format, $user[8] );
                        $age=date_diff($date, $birthdate)->y;
                        if($age>$max || $age <$min  ){ //if the user doesn't fit the age filter
                            $filter=0;
                        }
                   
                     
                    }
                    else{ //if the age isn't set
                        $filter=0;
                    } 
                }
                if($type!="unspecified"){
                    if($user[15]!='empty'!empty($user[15])){ //if the user's favorite type is set 
                        if($user[15]!=$type){//if the type doesn't fit the filter
                            $filter=0;
                        }
                    }
                    else{ //if the type isn't set
                        $filter=0;
                    } 
                }
                if($gender!="unspecified"){
                   if($user[6]!=$gender){//if the type doesn't fit the filter
                        $filter=0;
                    }
                }
                if($filter){ //if the user fits the filters
                    $search[$i]=$user; //adds user to array
                    $i++; //move to next slot
                }
            }//once all users filtered
           
            
        } 
        if(empty($search)){
            $search_fail="no user found";
            $search=array(0,"Please try again");
        }
        else{
            $search_fail="user found";
  
        }
        
        $_SESSION["search_fail"]=$search_fail;
        $_SESSION["search"]=$search;
        header("Location:search.html"); 
    }
   
?>
