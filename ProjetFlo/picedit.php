<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$_GET["user"]."&own=".$_GET['own'] ?> target="_self"> <- Back to profile </a>
		<br>
		<?php
			function addpic(){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["photo"]["name"]);
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
						move_uploaded_file($_FILES["photo"]["tmp_name"], "./users/".$_GET["user"]."/picpreview.png");
						echo "<br><img src='./users/".$_GET["user"]."/picpreview.png' id='picpreview'><br>";
						
					}
					else{
						echo "Incorrect file format";
					}
				}
				return 0;
			}
			addpic();
		?>
		<form method="post" enctype="multipart/form-data" id="editprofile">
			<input type='file' id='addpic' name='photo' accept='image/png,image/jpg,image/jpeg'>
			<br>
			<button type='submit' class='submit' id='addpic'>Submit picture</button>
		</form>
		<br>
		<a href=userprofile.php<?php echo "?user=".$_GET["user"]."&own=".$_GET['own'] ?> target="_self" <?php
						$i = 1;
						$a = 1;
						$pic = "pic1.png";
						while ($a != 0){
							if (file_exists("./".$_GET["user"]."/".$pic)){
								$i++;
								$pic = "pic".$i.".png";
							}
							else{
								$a = 0;
								$i--;
							}
						}
						copy("./users/".$_GET["user"]."/picpreview.png", "./users/".$_GET["user"]."/".$pic);
						?>>
			<button type='button'>
				Validate change
			</button>
		</a>
	</body>
</html>

