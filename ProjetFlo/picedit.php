<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
		<?php
			session_start(); 
			$user = $_GET["user"];
			$cur = $_SESSION["userID"];
		?>
	</head>
	<body>
		<a href=userprofile.php<?php echo "?user=".$user ?> target="_self"> <- Back to profile </a>
		<br>
		<?php
			function addpic($user){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["photo"]["name"]);
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
						move_uploaded_file($_FILES["photo"]["tmp_name"], "./users/".$user."/picpreview.png");
						echo "<br><img src='./users/".$user."/picpreview.png' id='picpreview'><br>";
						
					}
					else{
						echo "Incorrect file format";
					}
				}
				return 0;
			}
			
			$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
			$curtab = explode(";", fgets($curinfo));
			fclose($curinfo);
			if($cur == $user || $curtab[4] == "admin"){
				addpic($user);
				echo '<form method="post" enctype="multipart/form-data" id="editprofile">
					<input type="file" id="addpic" name="photo" accept="image/png,image/jpg,image/jpeg">
					<br>
					<button type="submit" class="submit" id="addpic">Submit picture</button>
				</form>
				<br>
				<a href=userprofile.php?user='.$user.' target="_self" <?php 
					$i = 1;
					$a = 1;
					$pic = "pic1.png";
					while ($a != 0){
						if (file_exists("./".$user."/".$pic)){
							$i++;
							$pic = "pic".$i.".png";
						}
						else{
							$a = 0;
							$i--;
						}
					}
					copy("./users/".$user."/picpreview.png", "./users/".$user."/".$pic);
					?>
				>
					<button type=button>
						Validate change
					</button>
				</a>'
			}
			else{
				echo "This is not your page";
			}
		?>
	</body>
</html>

