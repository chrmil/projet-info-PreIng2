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
					copy('./'.$_GET["user"].'/'.$x, './'.$_GET["user"].'/image.png');
					$p = substr($x, 0, 3);
					if ($p == "pic" && $_GET['own']){
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
		<img src=<?php echo "./".$_GET["user"] ?>/image.png>
	</body>
</html>
