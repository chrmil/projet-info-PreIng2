<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$_GET["user"]."&own=".$_GET['own'] ?> target="_self"> <- Back to profile </a>
		<img src=<?php echo "./".$_GET["user"] ?>/pfp.png id="pfp">
		<?php
			include("users.php");
			
			function editinfo($user){
				if (file_exists('./'.$user.'/profile.txt') && $_GET['own']){
					$i = 1;
					$file = fopen('./'.$user.'/profile.txt', 'r');
					$info = fgets($file);
					$str = substr($info, 0, -1);
					$tab = explode(';', $str);
					$m = json_encode($tab);
					echo "<button type=button onclick=editprofile('$m')><img src=edit.png id='edit'></button>";
				}
			}
			
			editinfo($_GET["user"]);
			
			$x = ["username", "email", "password", "subscription", "subtime", "gender", "accdate", "birthdate", "profession", "home", "relationship", "children", "pokemon", "generation", "type", "nature"];
			if (isset($_POST["username"])){
				$y = array($_POST["username"]);
				for ($i = 1; $i < 17; $i++){
					$y[$i] = $_POST[$x[$i]];
				}
				updateUser($_GET["user"], $y);
			}
		?>
		<form method="post" enctype="multipart/form-data" id="editprofile">
		</form>
	</body>
</html>
