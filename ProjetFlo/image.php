<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$_GET['user']."&own=".$_GET['own'] ?> target="_self"> <- Back </a>
		<div id=delbutton>
			<?php
				function piczoom($x){
					copy('./users/'.$_GET["user"].'/'.$x, './users/'.$_GET["user"].'/image.png');
					$p = substr($x, 0, 3);
					$file = fopen('./users/'.$_GET['user'].'/profile.txt', 'r');
					$tab = explode(";", fgets($file));
					fclose($file);
					if ($p == "pic" && ($_GET['own'] || $tab[4] == "admin")){
						$m = json_encode($x);
						echo "<button type='button' onclick=picdel('$m',".$_GET['user'].",".$_GET['own'].")>
							<img src='delete.png' id='edit'>
						</button>";
					}
				}
				
				piczoom($_GET["pic"]);
			?>
		</div>
		<br>
		<img src=<?php echo "./users/".$_GET["user"] ?>/image.png>
	</body>
</html>
