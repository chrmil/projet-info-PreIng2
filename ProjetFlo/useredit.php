<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
		<?php
			session_start(); 
			$user = $_GET["user"];
			$cur = $_SESSION["userID"];
		?>
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$user ?> target="_self"> <- Back to profile </a>
		<img src=<?php echo "./users/".$user ?>/pfp.png id="pfp">
		<?php
			
			
			include("users.php");
			
			$x = ["userID", "username", "email", "password", "subscription", "subtime", "gender", "accdate", "birthdate", "profession", "home", "relationship", "children", "pokemon", "generation", "type", "nature", "description"];
			
			if (isset($_POST["username"])){
				$y = array($user);
				$file = fopen('./users/'.$user.'/profile.txt', 'r');
				$info = fgets($file);
				$str = substr($info, 0, -1);
				$tab = explode(';', $str);
				for ($i = 1; $i < sizeof($x); $i++){
					if($i == 3 || $i == 5 || $i == 7){
						$y[$i] = $tab[$i];
					}
					else if($i == sizeof($x) - 1){
						$tbreplaced = array("\n", "\x0B", "\r", "\t", "<", ">", "\"", "'", ";", " ");
						$replaced = str_replace($tbreplaced, '_', $_POST[$x[$i]]);
						$trimmed = trim($replaced, "_");
						$y[$i] = $trimmed;
					}
					else{
						$tbreplaced = array("\n", "\x0B", "\r", "\t", "<", ">", "\"", "'", ";", " ");
						$replaced = str_replace($tbreplaced, '_', $_POST[$x[$i]]);
						$y[$i] = $replaced;
					}
				}
				updateUser($user, $y);
			}
			
			function editinfo($user){
				if (file_exists('./users/'.$user.'/profile.txt')){
					$i = 1;
					$file = fopen('./users/'.$user.'/profile.txt', 'r');
					$info = fgets($file);
					$str = substr($info, 0, -1);
					$tab = explode(';', $str);
					$m = json_encode($tab);
					echo "<button type=button onclick=editprofile('$m')><img src=edit.png id='edit'></button>";
				}
			}
			
			$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
			$curtab = explode(";", fgets($curinfo));
			fclose($curinfo);
			if($cur == $user || $curtab[4] == "admin"){
				editinfo($user);
			}
			else{
				echo "This is not your page";
			}
		?>
		<form method="post" enctype="multipart/form-data" id="editprofile">
		</form>
	</body>
</html>
