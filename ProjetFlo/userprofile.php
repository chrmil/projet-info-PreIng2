<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<?php
			/*
			function collectdat1(){
				$tab = array("email" => array("one@test.com", "two@test.com", "three@test.com", "four@test.com", "five@test.com", "six@test.com", "seven@test.com", "eight@test.com", "nine@test.com", "ten@test.com"), "password" => array("one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"));
				$a = $_POST["email"];
				$b = (string)$_POST["password"];
				$i = 0;
				$c = 0;
				for ($i = 0; $i < 10; $i++){
					if ($a == $tab["email"][$i] && $b == $tab["password"][$i]){
						echo "Bienvenue à toi ".$b.".";
						$c = 1;
						break;
					}
				}
				if ($c == 0){
					header("Location:index.php");
				}
				return $c;
			}
			collectdat1();
			*/
		?>
		<a href=image.php?pic=pfp.png target='_self'>
			<img src='pfp.png' id='pfp'>
		</a>
		<a href=pfpedit.php target='_self' <?php copy('./pfp.png', './pfppreview.png'); ?>>
			<img src='edit.png' id='edit'>
		</a>
		<p id='username'>username</p>
		<p id='gender'>gender</p>
		<p id='birthdate'>birthdate</p>
		<p id='profession'>profession</p>
		<p id='place'>place</p>
		<p id='status'>status</p>
		<p id='otherinfo'>otherinfo</p>
		<a href=useredit.php target='_self'>
			<button type='button'>Edit profile</button>
		</a>
		<br>
			<script>
				console.log("test");
				function piclist(x){
					var xhttp, xmlDoc, txt, i = 1;
					xhttp = new XMLHttpRequest();
					xhttp.onload = function() {
						if (this.readyState == 4 && this.status == 200) {
							xmlDoc = this.responseXML;
							txt = "";
							for (i = 1; i <= x; i++) {
								console.log(i);
								txt = txt + "<a href=image.php?pic=pic" + i + ".jpg target='_self'><img src='pic" + i + ".jpg' id='pics'></a>"
								console.log("<a href=image.php?pic=pic" + i + ".jpg target='_self'><img src='pic" + i + ".jpg' id='pics'></a>");
							}
							document.getElementById("piclist").innerHTML = txt;
						}
					};
					xhttp.open("GET", "userprofile.php", true);
					xhttp.send();
				}
				
				piclist(<?php
					function picnumber(){
						$i = 1;
						$a = 1;
						$pic = "pic1.jpg";
						while ($a != 0){
							if (file_exists($pic)){
								$i++;
								$pic = "pic".$i.".jpg";
							}
							else{
								$a = 0;
								$i--;
							}
						}
						return $i;
					}
					echo picnumber();
				?>)
			</script>
		<div id='piclist'>
		</div>
	</body>
</html>
