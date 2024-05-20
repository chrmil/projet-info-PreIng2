<?php
	/* 
	$users=tableau multidimensionnel
	foreach $users as $user
 	$user[0] = userID		Généré aléatoirement, unique, inchangeable, permet de vérifier qui est la personne même après changement de pseudo/email
	$user[1] = username		Unique
	$user[2] = email		Unique
	$user[3] = password
	$user[4] = access level : "user", "subscribed", "admin"		User par défaut, peut changer si l'abonnement est pris, admin peut se donner les permissions via le fichier txt
	$user[5] = gender
	$user[6] = userprofile creation date	Généré automatiquement
	$user[7] = age (birthdate)
	$user[8] = profession			Optionnel
	$user[9] = address
	$user[10] = status
	$user[11] = favorite starter		Optionnel, liste des 27 starters 
 						Bulbasaur (Bulbizarre)		Charmander (Salamèche)	Squirtle (Carapuce)
       						Chikorita (Germignon)		Cyndaquil (Héricendre)	Totodile (Kaiminus)
	     					Treecko (Arcko)			Torchic (Poussifeu)	Mudkip (Gobou)
	   					Turtwig (Tortipouss)		Chimchar (Ouisticram)	Piplup (Tiplouf)
	 					Snivy (Vipélierre)		Tepig (Gruikui)		Oshawott (Moustillon)
       						Chespin (Marisson)		Fennekin (Feunnec)	Froakie (Grenousse)
	     					Rowlet (Brindibou)		Litten (Flamiaou)	Popplio (Otaquin)
	   					Grookey (Ouistempo)		Scorbunny (Flambino)	Sobble (Larméléon)
	 					Sprigatito (Poussacha)		Fuecoco (Chochodile)	Quaxly (Coiffeton)
	$user[12] = favorite generations	Optionnel, liste des 9 générations (préciser jeux principaux)
 						Gen 1	Red / Blue / Yellow
       						Gen 2	Gold / Silver / Crystal
	     					Gen 3	Ruby / Sapphire / Emerald
	   					Gen 4	Diamond / Pearl / Platinum
	 					Gen 5	Black / White
       						Gen 6	X / Y
	     					Gen 7	Sun / Moon
	   					Gen 8	Sword / Shield
	 					Gen 9	Scarlet / Violet
	$user[13] = favorite types		Optionnel, liste
	$user[14] = nature			Optionnel, prendre les natures de Pokémon
					 	Adamant		Bashful		Bold		Brave		Calm
					  	Careful		Docile		Gentle		Hardy		Hasty
					   	Impish		Jolly		Lax		Lonely		Mild
					    	Modest		Naive		Naughty		Quiet		Quirky
					     	Rash		Relax		Sassy		Serious		Timid
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

