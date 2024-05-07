<?php 
    include("users.php");
    try {
        if(!isset($users) || empty($users)){
                throw new Exception("Error: user list");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    reset($users);
    $q = $_REQUEST["q"];
    $res = "";
    if ($q !== "") {
        foreach($users as $user) {
            if ($user[0]==$q) {
              $res="Username taken.";
            }
        }
    }
    reset($users);
    $r= $_REQUEST["r"];
    $res = "";
    if ($r !== "") {

        foreach($users as $user) {
            if ($user[1]==$r) {
              $res="Email taken.";
            }
        }
    }


    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try {
            if(!isset($_POST["username"]) || empty($_POST["username"])){
                throw new Exception("Error: incorrect username");
            }
            if(!isset($_POST["password"]) || empty($_POST["password"])){
                throw new Exception("Error: incorrect password");
            }
            if(!isset($_POST["email"]) || empty($_POST["email"])){
                throw new Exception("Error: incorrect email");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        $newUser=array();
       
        $newUser[0]=$_POST["username"];
        $newUser[1]=$_POST["email"];
        $password=$_POST["password"];
        $newUser[2]=password_hash($password);
        $newUser[3]=$_POST["sex"];
        array_push($users, $newUser); //?
    
    }
   
?>