<?php 
    session_start();
    include("users.php");   
    $users = getUserlist(); // Obtient la liste des utilisateurs, pas global
    
    try {
        if(!isset($users) || empty($users)){
            throw new Exception("Error: home.php : user list");
        }
        if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
            throw new Exception("Please log in to see the 10 last new trainers");
        }
    }  
    catch(Exception $e){
        #echo $e->getMessage();
    }   

    $lastUsers = array_fill(0, 10, array_fill(0, 19, 0)); // Tableau des 10 derniers nouveaux utilisateurs 
    $i = 0;
    $j = 0;
    $c = count($users);
    for($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < $c; $j++) {
            $t1 = 1;
            for($k = 0; $k < 10; $k++) {
                $array = $users[$j];
                if($array[0] == $lastUsers[$k][0]) { // Vérifie que $j n'est pas déjà dans le tableau
                    $t1 = 0;
                }
            }
            if($t1 && $lastUsers[$i][18] < $users[$j][18]) {
                $lastUsers[$i] = $users[$j];
            }
        }
    } 

    // Tableau pour stocker les noms et les âges des utilisateurs
    $userDetails = array();
    foreach ($lastUsers as $user) {
        if($user[0] != 0) {
            $userDetails[] = array(
                "nom" => $user[1], // Ajoute le nom de l'utilisateur
                "age" => $user[2], // Ajoute l'âge de l'utilisateur
                "sex" => $user[6]
            );
        }
    }

    // Convertit le tableau des noms et âges d'utilisateurs en JSON
    $userDetailsJSON = json_encode($userDetails);

    // Envoie le JSON à la page HTML
    echo $userDetailsJSON;
?>
