<?php  
    include("users.php");
    global $users;
    $users=getUserlist();
    reset($users);
    $r = $_REQUEST["r"];
    $res = "";
    if ($r !== "") {

        foreach($users as $user) {//checks if email is available
            if ($user[2]==$r) {
              $res="Email taken.";
            }
        }
    }
    echo $res === "" ? "" : $res;
 
?>