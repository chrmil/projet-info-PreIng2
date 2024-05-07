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
?>