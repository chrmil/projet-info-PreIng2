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
		<a href=pfp.html target="_self">
			<img src="pfp.png" id="pfp">
		</a>
		<a href=useredit.php target="_self">
			<img src="edit.png" id="edit">
		</a>
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
