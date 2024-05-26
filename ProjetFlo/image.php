<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
		<?php
			session_start(); 
			$user = $_GET["user"];
			$cur = $_SESSION["userID"];
			include("imageadd.php");
		?>
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$user ?> target="_self"> <- Back </a>
		<?php
			if (checkUser($user, $cur)){
				echo "<div id=delbutton>";
				piczoom($_GET["pic"], $user, $cur);
				echo "</div>
				<br>
				<img src=<?php echo './users/'.$user ?>/image.png>";
			}
			else{
				echo "This is not your page";
			}
		?>
	</body>
</html>
