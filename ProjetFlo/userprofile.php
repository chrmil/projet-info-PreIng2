<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
		<?php
			session_start(); 
			$user = $_GET["user"];
			$cur = $_SESSION["userID"];
			include("userprofileadd.php");
		?>
	</head>
	<body>
		<?php
			
			if (file_exists("./users/".$user."/picpreview.png")){
				unlink("./users/".$user."/picpreview.png");
			}
			
			deletepic($_GET["picdel"], $user);
		?>
		<a href=image.php<?php echo "?user=".$user."&pic="?>pfp.png target='_self'>
			<img src=<?php echo "./users/".$user ?>/pfp.png id='pfp'>
		</a>
		<?php
			pfpButton($user, $cur);
			
			displayinfo($user);
		?>
		<br>
		<a href=useredit.php<?php echo "?user=".$user ?> target='_self'>
			<?php
				if (checkUser($user, $cur)){
					echo "<button type='button'>Edit profile</button>";
				}
			?>
		</a>
		<br>
		<a href=picedit.php<?php echo "?user=".$user ?> target='_self'>
			<?php
				if (checkUser($user, $cur)){
					echo "<button type='button'>Add picture</button>";
				}
			?>
		</a>
		<script>
			piclist(<?php echo picnumber($user).",".$user.",".$cur;?>)
		</script>
		<div id='piclist'>
		</div>
	</body>
</html>
