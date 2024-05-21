<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$_GET["user"] ?> target="_self"> <- Back to profile </a>
		<br>
		<?php
			function addpfp(){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["pfp"]["name"]);
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
						move_uploaded_file($_FILES["pfp"]["tmp_name"], "./pfppreview.png");
						
					}
					else{
						echo "Incorrect file format";
					}
				}
				return 0;
			}
			addpfp();
		?>
		<img src=pfppreview.png<?php echo "?user=".$_GET["user"] ?> id="pfp">
		<form method="post" enctype="multipart/form-data">
			<input type='file' id='addpic' name='pfp' accept='image/png,image/jpg,image/jpeg'>
			<br>
			<button type='submit' class='submit' id='addpic'>Submit profile picture</button>
		</form>
		<br>
		<a href=userprofile.php<?php echo "?user=".$_GET["user"] ?> target="_self" <?php copy("./pfppreview.png", "./pfp.png"); ?>>
			<button type='button'>
				Validate change
			</button>
		</a>
	</body>
</html>
