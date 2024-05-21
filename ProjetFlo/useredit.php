<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<?php
			function editinfo($user){
				if (file_exists('./'.$user.'/profile.txt')){
					$i = 1;
					$file = fopen('./'.$user.'/profile.txt', 'r');
					$info = fgets($file);
					$str = substr($info, 0, -1);
					$tab = explode(';', $str);
					$m = json_encode($tab);
					echo "<button type=button onclick=editprofile('$m')>Test</button>";
				}
			}
			
			editinfo($_GET["user"]);
		?>
		<img src="pfp.png" id="pfp">
		<form method="post" enctype="multipart/form-data" id="editprofile">
		</form>
	</body>
</html>
