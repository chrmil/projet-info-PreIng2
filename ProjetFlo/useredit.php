<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<?php
			function addpfp(){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["photo"]["name"]);
					echo $str[0];
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
						echo "<br>".$_FILES["photo"]["tmp_name"];
						echo "<br>".$_FILES["photo"]["name"];
						move_uploaded_file($_FILES["photo"]["tmp_name"], "./pfp.png");
						echo "<br>".$str[sizeof($str) - 1];
						
					}
					else{
						echo "Incorrect file format";
					}
				}
				return 0;
			}
			addpfp();
		?>
		<img src="pfp.png" id="pfp">
		<form action="useredit.php" method="post" enctype="multipart/form-data">
			<input type="file" id="addpfp" name="photo" onchange="pfppreview()">
			<input type="submit" class="submit">
		</form>
		<p id="username"></p>
		<p id="gender"></p>
		<p id="birth date"></p>
		<p id="profession"></p>
		<p id="place"></p>
		<p id="status"></p>
		<p id="otherinfo"></p>
	</body>
</html>
