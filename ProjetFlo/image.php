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
		<a href=userprofile.php<?php echo "?user=".$user ?> target="_self"> <- Back </a>
		<?php
			function piczoom($x, $user, $cur){
				copy('./users/'.$user.'/'.$x, './users/'.$user.'/image.png');
				$p = substr($x, 0, 3);
				$file = fopen('./users/'.$user.'/profile.txt', 'r');
				$tab = explode(";", fgets($file));
				fclose($file);
				if ($p == "pic" && ($cur || $tab[4] == "admin")){
					if ($tab[4] == "admin"){
						$array = array($x, $user, $cur, 1);
					}
					else{
						$array = array($x, $user, $cur, 0);
					}
					$m = json_encode($array);
					echo "<button type='button' onclick=picdel('$m')>
						<img src='delete.png' id='edit'>
					</button>";
				}
			}

			$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
			$curtab = explode(";", fgets($curinfo));
			fclose($curinfo);
			if($cur == $user || $curtab[4] == "admin"){
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
