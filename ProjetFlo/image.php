<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
	</head>
	<body>
		<a href="userprofile.php" target="_self"> <- Back to profile </a>
		<div id=delbutton>
			<?php
				function piczoom($x){
					copy('./'.$x, './image.png');
					$p = substr($x, 0, 3);
					if ($p == "pic"){
						$m = json_encode($x);
						echo "<button type='button' onclick=picdel('$m')>
							<img src='delete.png' id='edit'>
						</button>";
					}
				}
				
				piczoom($_GET["pic"]);
			?>
		</div>
		<br>
		<img src="image.png">
	</body>
</html>
