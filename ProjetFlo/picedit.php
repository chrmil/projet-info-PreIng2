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
			function addpic(){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["photo"]["name"]);
					echo $str[0];
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
						echo "<br>".$_FILES["photo"]["tmp_name"];
						echo "<br>".$_FILES["photo"]["name"];
						move_uploaded_file($_FILES["photo"]["tmp_name"], "./picpreview.png");
						echo "<br>".$str[sizeof($str) - 1];
						
					}
					else{
						echo "Incorrect file format";
					}
				}
				return 0;
			}
			addpic();
		?>
		<img src="picpreview.png" id="picpreview">
		<form action="picedit.php" method="post" enctype="multipart/form-data" id="editprofile">
			<input type='file' id='addpfp' name='photo'>
			<br>
			<button type='submit' class='submit' id='addpfp'>Submit profile picture</button>
		</form>
		<br>
		<a href="userprofile.php" target="_self" <?php
						$i = 1;
						$a = 1;
						$pic = "pic1.png";
						while ($a != 0){
							if (file_exists($pic)){
								$i++;
								$pic = "pic".$i.".png";
							}
							else{
								$a = 0;
							}
						}
						
						copy("./picpreview.png", "./".$pic); ?>>
			<button type='button'>
				Validate changes
			</button>
		</a>
	</body>
</html>

