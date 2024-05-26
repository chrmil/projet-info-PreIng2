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
		<br>
		<?php
			function addpfp($user){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["pfp"]["name"]);
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
						move_uploaded_file($_FILES["pfp"]["tmp_name"], "./users/".$user."/pfppreview.png");
						
					}
					else{
						echo "Incorrect file format";
					}
				}
				return 0;
			}

			$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
			$curtab = explode(";", fgets($curinfo));
			fclose($curinfo);
			if($cur == $user || $curtab[4] == "admin"){
				addpfp($user);
				echo '<img src=./users/'.$user.'/pfppreview.png id="pfp">
				<form method="post" enctype="multipart/form-data">
					<input type="file" id="addpic" name="pfp" accept="image/png,image/jpg,image/jpeg">
					<br>
					<button type="submit" class="submit" id="addpic">Submit profile picture</button>
				</form>
				<br>
				<a href=userprofile.php?user='.$user.' target="_self" 
					<?php copy("./users/".$user."/pfppreview.png", "./users/".$user."/pfp.png"); ?>
					>
					<button type="button">
						Validate change
					</button>
				</a>';
			}
			else{
				echo "This is not your page";
			}
		?>
	</body>
</html>
