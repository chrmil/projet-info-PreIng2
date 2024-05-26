<?php  
    include("users.php");
    global $users;
    $users=getUserlist();
    reset($users);
    $q = $_REQUEST["q"];
    $res = "";
    if ($r !== "") {

        foreach($users as $user) {//checks if username is available
            if ($user[1]==$q) {
              $res="Username taken.";
            }
        }
    }
    echo $res === "" ? "" : $res;
 
?>