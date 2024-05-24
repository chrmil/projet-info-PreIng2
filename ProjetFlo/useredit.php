<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$_GET["user"]."&own=".$_GET['own'] ?> target="_self"> <- Back to profile </a>
		<img src=<?php echo "./users/".$_GET["user"] ?>/pfp.png id="pfp">
		<?php
			include("users.php");
			
			$x = ["UserID", "Username", "Email", "Password", "Subscription", "Subtime", "Gender", "Accdate", "Birthdate", "Profession", "Home", "Relationship", "Children", "Pokemon", "Generation", "Type", "Nature", "Description"];
			
			if (isset($_POST["username"])){
				$y = array($_GET["user"]);
				$file = fopen('./users/'.$_GET["user"].'/profile.txt', 'r');
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
				updateUser($_GET["user"], $y);
			}
			
			function editinfo($user){
				if (file_exists('./users/'.$user.'/profile.txt') && $_GET['own']){
					$i = 1;
					$file = fopen('./users/'.$user.'/profile.txt', 'r');
					$info = fgets($file);
					$str = substr($info, 0, -1);
					$tab = explode(';', $str);
					$m = json_encode($tab);
					echo "<button type=button onclick=editprofile('$m')><img src=edit.png id='edit'></button>";
				}
			}
			
			editinfo($_GET["user"]);
		?>
		<form method="post" enctype="multipart/form-data" id="editprofile">
		</form>
	</body>
</html>
