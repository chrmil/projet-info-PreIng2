<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
	</head>
	<body>
		<?php
			function piczoom($x){
				copy('./'.$x, './image.png');
			}
			
			piczoom($_GET["pic"]);
		?>
		<a href="userprofile.php" target="_self"> <- Back to profile </a>
		<br>
		<img src="image.png">
	</body>
</html>
