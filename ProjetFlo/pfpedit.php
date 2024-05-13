<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<a href="userprofile.php" target="_self"> <- Back to profile </a>
		<br>
		<?php
			function addpfp(){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["photo"]["name"]);
					echo $str[0];
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
						echo "<br>".$_FILES["photo"]["tmp_name"];
						echo "<br>".$_FILES["photo"]["name"];
						move_uploaded_file($_FILES["photo"]["tmp_name"], "./pfppreview.png");
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
		<img src="pfppreview.png" id="pfp">
		<form action="pfpedit.php" method="post" enctype="multipart/form-data" id="editprofile">
			<input type='file' id='addpfp' name='photo'>
			<br>
			<button type='submit' class='submit' id='addpfp'>Submit profile picture</button>
		</form>
		<br>
		<a href="userprofile.php" target="_self" <?php copy("./pfppreview.png", "./pfp.png"); ?>>
			<button type='button'>
				Validate change
			</button>
		</a>
	</body>
</html>
