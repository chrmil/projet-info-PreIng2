<?php
	/* 
	$users=tableau multidimensionnel
	foreach $users as $user
 	$user[0] = userID
	$user[1] = username
	$user[2] = email
	$user[3] = password
	$user[4] = access level : "user", "subscribed", "admin"
	$user[5] = gender
	$user[6] = userprofile creation date
	$user[7] = age (birthdate)
	$user[8] = profession
	$user[9] = address
	$user[10] = status
	$user[11] = favorite starter
	$user[12] = favorite generations
	$user[13] = favorite types
	$user[14] = nature
	$user[15] = otherinfo

    ...
    $limit=nb d'entrées du tab $user
    */


	function getUserlist(){
		$limit=10;
	    try {
		$userfile=fopen("users.txt", "r");
		if(!isset($userfile) || empty($userfile)){
		        throw new Exception("Error: user file");
		}
	    }
	    catch(Exception $e){
		echo $e->getMessage();
	    }
	    $users;
	    $users=array();
	    reset($users);
	    $i=0;
	    $userlist=file("users.txt");
	    foreach ($userlist as $user){
		    $users[$i]=explode(";", $user, $limit);
		    $i++;
	    }
	    fclose($userfile);
	    return $users;
	}

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
        try{
        	$try=1;
        	foreach ($users as $user){
        		if($user[0]==$newUser[0]){
        			$try=0;
        		}
        	}
        	if($try){
        		throw new Exception("Error: newUser(), new profile not registered");
        	}
        }
	 	catch(Exception $e){
            echo $e->getMessage();
        }
		try {
			$userfile=fopen("users.txt", "a+");
			if(!isset($userfile)){
					throw new Exception("Error:newUser(), user file not found");
			}
		}
	    catch(Exception $e){
			echo $e->getMessage();
	    }
		fwrite($userfile, implode(";",$newUser));
		fwrite($userfile, "\n");
	    
	    try{
	    	$newUserlist=getUserlist();
	    	if(count($newUserlist)!=count($users)){
	    		   throw new Exception("Error: newUser(), userlist not updated (wrong count)");
	    	}
	    	$try=0;
	    	$i=0;
	    	$error=0;
	    	
	    	foreach($users as $user){
	    		$j=0;
	    		if(count($newUserlist[$i])!=count($user)){
	    			$try=1;
	    			$error=2;
	    			break;
	    		}
	    		foreach ($user as $elmt){
	    			
	    			if(strcmp($newUserlist[$i][$j], $elmt)	!= 0){
	    				$try=1;
	    				$error=strcmp($newUserlist[$i][$j], $elmt);
	    				break;
	    			}
	    			$j++;
	    		}
	    		$i++;
	    	}
		if ($try){
		 	throw new Exception("Error: newUser(), userlist not updated (wrong content) : $error");
	    	}
	    }
	     catch(Exception $e){
		echo $e->getMessage();
	    }
	    fclose($userfile);
 
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
		try {
			$userfile=fopen("users.txt", "w+");
			if(!isset($userfile)){
					throw new Exception("Error:updateUser(), user file not found");
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
	    try{
	    	$newUserlist=getUserlist();
	    	if(count($newUserlist)!=count($users)){
	    		   throw new Exception("Error: updateUser(), userlist not updated (wrong count)");
	    	}
	    	$try=0;
	    	$i=0;
	    	$error=0;
	    	
	    	foreach($users as $user){
	    		$j=0;
	    		if(count($newUserlist[$i])!=count($user)){
	    			$try=1;
	    			$error=2;
	    			break;
	    		}
	    		foreach ($user as $elmt){
	    			
	    			if(strcmp($newUserlist[$i][$j], $elmt)	!= 0){
	    				$try=1;
	    				$error=strcmp($newUserlist[$i][$j], $elmt);
	    				break;
	    			}
	    			$j++;
	    		}
	    		$i++;
	    	}
		if ($try){
		 	throw new Exception("Error: updateUser(), userlist not updated (wrong content) : $error");
	    	}
	    }
	     catch(Exception $e){
		echo $e->getMessage();
	    }
	    fclose($userfile);
   

    }




?>

