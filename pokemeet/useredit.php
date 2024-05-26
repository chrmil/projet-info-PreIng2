<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
		<?php
			session_start(); 
			$user = $_GET["user"];
			$cur = $_SESSION["userID"];
			include("usereditadd.php");
		?>
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$user ?> target="_self"> <- Back </a>
		<img src=<?php echo "./users/".$user ?>/pfp.png id="pfp">
		<?php
			$infolist = ["UserID", "Username", "Email", "Password", "Subscription", "Subtime", "Gender", "Accdate", "Birthdate", "Profession", "Home", "Relationship", "Children", "Pokemon", "Generation", "Type", "Nature", "Description"];
			
			useredit($user, $infolist, $_POST);
			
			if(checkUser($user, $cur)){
				echo "<form method='post' enctype='multipart/form-data' id='editprofile'>";
				editInfo($user, $infolist);
				echo "</form>";
			}
			else{
				echo "This is not your page";
			}
		?>
	</body>
</html>
