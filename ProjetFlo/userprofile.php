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
			function deletepic($x){
				if(isset($x)){
					$tab = explode(".", $x);
					$p = substr($tab[0], 0, 3);
					if ($p == "pic"){
						$n = substr($tab[0], 3);
						unlink($x);
						$n++;
						$a = 1;
						while ($a != 0){
							$m = $n - 1;
							if (file_exists("pic".$n.".png")){
								echo $n;
								copy('./pic'.$n.'.png', './pic'.$m.'.png');
							}
							else{
								unlink('pic'.$m.'.png');
								$a = 0;
							}
							$n++;
						}
					}
				}
			}
			
			deletepic($_GET["picdel"]);
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
		<a href=picedit.php target='_self'>
			<button type='button'>Add picture</button>
		</a>
			<script>
				piclist(<?php
					function picnumber(){
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
