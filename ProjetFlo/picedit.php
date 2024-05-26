<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
		<?php
			session_start(); 
			$user = $_GET["user"];
			$cur = $_SESSION["userID"];
			include("piceditadd.php");
		?>
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$user ?> target="_self"> <- Back </a>
		<br>
		<?php
			if (checkUser($user, $cur)){
				editPic($user, $_FILES);
			}
			else{
				echo "This is not your page";
			}
		?>
	</body>
</html>

