<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["username"]) || empty($_POST["username"])){
                throw new Exception("Error: incorrect username");
            }
            if(!isset($_POST["password1"]) || empty($_POST["password1"])){
                throw new Exception("Error: incorrect password");
            }
            if(!isset($_POST["email"]) || empty($_POST["email"])){
                throw new Exception("Error: incorrect email");
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
                    throw new Exception("Error: newUser.php : user list");
            }
            foreach ($users as $user){
                if($_POST["username"]==$user[1] ||$_POST["email"]==$user[2]){ //doesn't work now 
                    
                    exit("Error: Username or email unavailable");
                }   
            }
        }  
        catch(Exception $e){
            echo $e->getMessage();
        }   
        reset($users);
        $newUser=array(); //creates new profile
        $newUser[0]=rand(10,999); //generate user ID (int betwenn 10 and 999)
        foreach($users as $user) {
            while ($user[0]==$newUser[0]) { //checks ID is available , generates a new one if necessary
              $newUser[0]=rand(10,9999);
            }    
        }
        $newUser[1]=$_POST["username"];
        $newUser[2]=$_POST["email"];
        $password=$_POST["password1"];
        $newUser[3]=password_hash($password,PASSWORD_BCRYPT); 
        $newUser[4]="user";
        $newUser[5]=$_POST["gender"];
        $newUser[6]=date("d/m/Y");
        newUser($newUser); //adds in the new user's profile 
        $_SESSION["userID"]=$user[0];
        header("Location:user.html");
       
    
    }
   
?>