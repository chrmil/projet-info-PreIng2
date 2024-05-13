<?php
    /* 
    $users=tableau multidimensionnel
    foreach $users as $user
    $user[0] = username
    $user[1] = email
    $user[2] = password
    $user[3] = access level : "user", "subscribed", "admin"
    $user[4] = gender
    $user[5] = userprofile creation date
    ...
    $limit=nb d'entrées du tab $user
    */
    
    try {
        $userfile=fopen("users.txt", "a");
        if(!isset($userfile) || empty($userfile)){
                throw new Exception("Error: user file");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    global $users;
    $users=array();
    reset($users);
    $i=0;
    $userlist=file("users.txt");
    foreach ($userlist as $user){
            $users[$i]=explode(";", $user, $limit);
            $i++;
    }
    fclose($userlist);

    function newUser($newUser){
        global $users;
        try {
            if(!isset($users) || empty($users)){
                throw new Exception("Error: newUser(), user list");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        try {
            if(!isset($newUser) || empty($newUser) || !is_array($newUser)){
                    throw new Exception("Error: newUser(), new profile");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        array_push($users, $newUser); 

 
    }
    
    function updateUser($username, $newUser){
        global $users;
        try {
            if(!isset($users) || empty($users)){
                throw new Exception("Error:updateUser(), user list");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        try {
            if(!isset($newUser) || empty($newUser) || !is_array($newUser)){
                throw new Exception("Error: updateUser(), new profile");
            }
            if(!isset($username) || empty($username) || !is_string($username)){
                throw new Exception("Error: updateUser(), username");
        }

        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        reset($users);
        $p=0;
        foreach($users as $user) {
            if ($user[0]==$username) {
                $user=$newUser;
                $p=1;
            }
        }
        try {
            if ($p==0){
                throw new Exception("Error: updateUser(), no profile found");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
   

    }

    try {
        if(!isset($users) || empty($users)){
            throw new Exception("Error: user list");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    try {
        $userfile=fopen("users.txt", "w");
        if(!isset($userfile)){
                throw new Exception("Error: user file");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    reset($users);
    $i=0;

    foreach ($users as $user){
            fwrite($userfile, implode(";",$user));
            fwrite($userfile, "\n");
    }
    fclose($userlist);



?>

