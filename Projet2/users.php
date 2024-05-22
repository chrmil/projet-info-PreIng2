<?php
  
   /* 
   $users=multidimensionnal array
   foreach $users as $user
	$user[0] = userID		randomly generated , unique, inchangeable, permet de vérifier qui est la personne même après changement de pseudo/email
   $user[1] = username		Unique
   $user[2] = email		Unique
   $user[3] = password
   $user[4] = access level : "user", "subscribed", "admin"		User par défaut, peut changer si l'abonnement est pris, admin peut se donner les permissions via le fichier txt
   $user[5] = array (subscription length, subscription date) ; length : -1 => admin , 0 => user, length>0 =>  subscribed.
   $user[6] = gender
   $user[7] = userprofile creation date	, automatically generated upon account creation
   $user[8] = age (birthdate)
   $user[9] = profession			Optionnel
   $user[10] = address			Pays obligatoire (liste de pays), reste optionnel
   $user[11] = status			Married / Divorced / Couple / Single
   $user[12] = children			Nombre d'enfants
   $user[13] = favorite starter		Optionnel, liste des 27 starters 
						Bulbasaur (Bulbizarre)	Charmander (Salamèche)	Squirtle (Carapuce)
						Chikorita (Germignon)	Cyndaquil (Héricendre)	Totodile (Kaiminus)
						Treecko (Arcko)			Torchic (Poussifeu)		Mudkip (Gobou)
						Turtwig (Tortipouss)	Chimchar (Ouisticram)	Piplup (Tiplouf)
						Snivy (Vipélierre)		Tepig (Gruikui)			Oshawott (Moustillon)
						Chespin (Marisson)		Fennekin (Feunnec)		Froakie (Grenousse)
						Rowlet (Brindibou)		Litten (Flamiaou)		Popplio (Otaquin)
						Grookey (Ouistempo)		Scorbunny (Flambino)	Sobble (Larméléon)
						Sprigatito (Poussacha)	Fuecoco (Chochodile)	Quaxly (Coiffeton)

   $user[14] = favorite generations	Optionnel, liste des 9 générations (préciser jeux principaux)
						Gen 1	Red / Blue / Yellow
						Gen 2	Gold / Silver / Crystal
						Gen 3	Ruby / Sapphire / Emerald
						Gen 4	Diamond / Pearl / Platinum
						Gen 5	Black / White
						Gen 6	X / Y
						Gen 7	Sun / Moon
						Gen 8	Sword / Shield
						Gen 9	Scarlet / Violet

   $user[15] = favorite types		Optionnel, liste des types
							Bug		Dark	Dragon	Electric	Fairy	Fighting	Fire	Flying	Ghost
							Grass	Ground	Ice		Normal		Poison	Psychic		Rock	Steel	Water

   $user[16] = nature			Optionnel, prendre les natures de Pokémon
							Adamant		Bashful		Bold		Brave		Calm
							Careful		Docile		Gentle		Hardy		Hasty
							Impish		Jolly		Lax			Lonely		Mild
						   	Modest		Naive		Naughty		Quiet		Quirky
							Rash		Relax		Sassy		Serious		Timid

   $user[17] = otherinfo			Optionnel, paragraphe libre
   

   ...

   */


	function getUserlist(){ //gets all users' profiles in an array  (see above)
		
	    try {
			$userlist=scandir("users"); //gets the content of the directory ; pathway name to be changed
			if(!isset($userlist) || empty($userlist) ||  !is_array($userlist)){
				throw new Exception("Error: getUserlist(): users dir");
			}
			else{
				$userlist=array_diff($userlist, array("..", ".")); //removes the . and .. entries of the array
			}
		}
	    catch(Exception $e){
			echo $e->getMessage();
	    }
	    $users;
	    $users=array();
	    reset($users);
		$i=0;
		foreach ($userlist as $userdir){
			$profile=fopen("users/$userdir/profile.txt", "r"); //gets each line of the file as an entry of the profile array
			try{
				if(!isset($profile) || empty($profile)){
					throw new Exception ("Error: getUserlist(): user profile");
				}
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
			$users[$i]=fgetcsv($profile,0, ";");
			$i++;			
		}
		$test=fopen("test.txt", "w+");
		foreach ($users as $user){
			fputcsv($test, $user, ";");
			fwrite($test, "\n");
		}
		fclose($test);
	    return $users;
	}

    function newUser($newUser){ //adds a new user to the directory, registry and list 
	
        global $users;
		$users=getUserlist(); //gets userlist
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
        array_push($users, $newUser);  //updates userlist
        try{
        	$try=1;
        	foreach ($users as $user){
        		if($user[0]==$newUser[0]){ //checks userlist is updated
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
					throw new Exception("Error:newUser(), users file not found");
			}
		}
	    catch(Exception $e){
			echo $e->getMessage();
	    }
		$i=0;
		fwrite($userfile, "$newUser[0];$newUser[1];$newUser[2]"); //update users registery (list of users by ID, username and email)
		fwrite($userfile, "\n");
	    fclose($userfile);
		try {
			if(file_exists("users/$newUser[0]")){
					throw new Exception("Error:newUser(), user dir already exists");
			}
		}
	    catch(Exception $e){
			echo $e->getMessage();
	    }
		mkdir("users/$newUser[0]"); //creates new user's directory 
		try {

			if(!file_exists("users/$newUser[0]") || !is_dir("users/$newUser[0]")){
					throw new Exception("Error:newUser(), user file not found");
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
	    }
		$userdir=opendir("users/$newUser[0]");
		try {
			$userfile=fopen("users/$newUser[0]/profile.txt", "w"); //creates profile file
			if(!isset($userfile)){
					throw new Exception("Error:newUser(), user file not found");
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
	    }
		fputcsv($userfile, $newUser, ";");
		fclose($userfile);
		closedir($userdir);
		try {
			copy("javascript.js", "users/$newUser[0]/javascript.js"); //copy js file to the new user's directory 
			if(!file_exists("users/$newUser[0]/javascript.js")){
					throw new Exception("Error:newUser(), copy failed");
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
	    }
		


 		
    }
    
    function updateUser($userID, $newUser){ //update an existing user profile designed by $userID with its new content $newUSer
        global $users;
		$users=getUserlist(); 
        try {
            if(!isset($users) || empty($users)){
                throw new Exception("Error:updateUser(), user list");
            }
			if ($userID!=$newUser[0]){
				throw new Exception("Error:updateUser(), wrong ID");
			}
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        try {
            if(!isset($newUser) || empty($newUser) || !is_array($newUser)){
                throw new Exception("Error: updateUser(), new profile");
            }
            if(!isset($userID) || empty($userID) ){
                throw new Exception("Error: updateUser(), user ID");
       		}
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
     
		$p=0;
		foreach($users as $user) { //checks user exists
			if ($user[0]==$userID) {
					$user=$newUser; //updates userlist
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
			$userfile=fopen("users.txt", "w+"); //updates registery (in case of username/email change)
			if(!isset($userfile)){
					throw new Exception("Error:updateUser(), user file not found");
			}
		}
	    catch(Exception $e){
		echo $e->getMessage();
	    }
	    reset($users);
	    foreach ($users as $user){
			fwrite($userfile, "$user[0];$user[1];$user[2]");
			fwrite($userfile, "\n");
	    }
		fclose($userfile);
		try {
			$userlist=scandir("users"); //gets list of user directories 
			
			if(!isset($userlist) || empty($userlist) ||  !is_array($userlist)){
					throw new Exception("Error: updateUser(): users dir");
			}
			else{
				$userlist=array_diff($userlist, array("..", ".")); //removes the . and .. entries of the array
			}
		}
	    catch(Exception $e){
			echo $e->getMessage();
	    }
		foreach ($userlist as $userdir){
			if($userdir==$userID){ //update specified user directory
				try {
					$userfile=fopen("$userdir/profile.txt", "w+");
					if(!isset($userfile)){
							throw new Exception("Error:updateUser(), user file not found");
					}
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				foreach ($newUser as $line){
					fwrite($userfile, $line);
					fwrite($userfile, "\n");
				}
				fclose($userfile);
			
			}		
		}
	    try{
	    	$newUserlist=getUserlist(); //checks everything was updated correctly (may not work yet)
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
	    
   

    }




?>

