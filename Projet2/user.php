<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
	</head>
	<body>
		<?php
			function addpfp(){
				if (!empty($_FILES)){
					$str = explode(".", $_FILES["photo"]["name"]);
					echo $str[0];
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg"){
						echo "<br>".$_FILES["photo"]["tmp_name"];
						echo "<br>".$_FILES["photo"]["name"];
						move_uploaded_file($_FILES["photo"]["tmp_name"], "./pfp.jpg");
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
		<img src="./pfp.jpg">
		<a href=pfp.html target="_self">
			<img src="pfp.jpg" id="pfp">
		</a>
		<form action="user.php" method="post" enctype="multipart/form-data">
			<input type="file" id="addpfp" name="photo">
			<input type="submit" class="submit">
		</form>
		<p id="username"></p>
		<p id="gender"></p>
		<p id="birth date"></p>
		<p id="profession"></p>
		<p id="place"></p>
		<p id="status"></p>
		<p id="otherinfo"></p>
		<div id="piclist">
			<img src="pic1.jpg" id="pics">
			<img src="pic2.jpg" id="pics">
			<img src="pic3.jpg" id="pics">
			<img src="pic4.jpg" id="pics">
			<img src="pic5.jpg" id="pics">
		</div>
	</body>
</html>
