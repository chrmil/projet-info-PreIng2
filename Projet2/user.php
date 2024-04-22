<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
	</head>
	<body>
		<?php
			function addpfp(){
				$test = 0;
				if (empty($_FILES)){
				}
				else {
					$str = explode(".", $_FILES["photo"]["name"]);
					echo $str[sizeof($str) - 1];
					if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg"){
						$test = 1;
						echo $_FILES["photo"]["tmp_name"];
						echo $_FILES["photo"]["name"];
						move_uploaded_file($_FILES["photo"]["tmp_name"], "/cergy/homee/v/vohoangmin/Informatique_PreIng2/Sem2/Projet/pfp.jpg");
						echo "<br>".$str[sizeof($str) - 1];
					}
				}
				return 0;
			}
			addpfp();
		?>
		<img src="/cergy/homee/v/vohoangmin/Informatique_PreIng2/Sem2/Projet/pfp.jpg">
		<a href=pfp.html target="_self">
			<img src="pfp.jpg" id="pfp">
		</a>
		<form action="user.php" method="post">
			<input type="file" id="addpfp">
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
