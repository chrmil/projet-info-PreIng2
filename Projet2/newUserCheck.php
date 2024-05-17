<?php 
    include("users.php");
    global $users;
    $users=getUserlist();
    try {
        if(!isset($users) || empty($users)){
                throw new Exception("Error: newUsercheck :user list");
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
    echo $res === "" ? "" : $res;
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
    echo $res === "" ? "" : $res;
 
?>