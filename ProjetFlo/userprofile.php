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
		<?php
			
			function deletepic($x, $user){
				if(isset($x)){
					$tab = explode(".", $x);
					$p = substr($tab[0], 0, 3);
					if ($p == "pic"){
						$n = substr($tab[0], 3);
						unlink("./users/".$user."/".$x);
						$n++;
						$a = 1;
						while ($a != 0){
							$m = $n - 1;
							echo $n.$m."<br>";
							if (file_exists('./users/'.$user.'/pic'.$n.'.png')){
								copy('./users/'.$user.'/pic'.$n.'.png', './users/'.$user.'/pic'.$m.'.png');
							}
							else{
								unlink('./users/'.$user.'/pic'.$m.'.png');
								$a = 0;
							}
							$n++;
						}
					}
					header("Location:userprofile.php?user=".$user);
				}
			}
			
			if (file_exists("./users/".$user."/picpreview.png")){
				unlink("./users/".$user."/picpreview.png");
			}
			
			deletepic($_GET["picdel"], $user);
		?>
		<a href=image.php<?php echo "?user=".$user ?>&pic=pfp.png target='_self'>
			<img src=<?php echo "./users/".$user ?>/pfp.png id='pfp'>
		</a>
		<?php
			$file = fopen('./users/'.$user.'/profile.txt', 'r');
			$tab = explode(";", fgets($file));
			fclose($file);
			if ($cur == $user || $tab[4] == "admin"){
				echo "<a href=pfpedit.php?user=".$user." target='_self' ";
				echo copy('./users/'.$user.'/pfp.png', './users/'.$user.'/pfppreview.png');
				echo ">
					<img src=edit.png id='edit'>
				</a>";
			}
			
			function displayinfo($user){
				if (file_exists('./users/'.$user.'/profile.txt')){
					$x = ["UserID", "Username", "Email", "Password", "Subscription", "Subtime", "Gender", "Accdate", "Birthdate", "Profession", "Home", "Relationship", "Children", "Pokemon", "Generation", "Type", "Nature", "Description"];
					$i = 1;
					$file = fopen('./users/'.$user.'/profile.txt', 'r');
					$info = fgets($file);
					$tab = explode(';', $info);
					$tab[sizeof($x) - 1] = str_replace('_', ' ', $tab[sizeof($x) - 1]);
					for ($i = 1; $i < sizeof($x); $i++){
						if ($i != 3){
							echo "<br>".$x[$i].":".$tab[$i];
						}
						
					}
				}
			}
			
			displayinfo($user);
		?>
		<br>
		<a href=useredit.php<?php echo "?user=".$user ?> target='_self'>
			<?php
				$file = fopen('./users/'.$user.'/profile.txt', 'r');
				$tab = explode(";", fgets($file));
				fclose($file);
				if ($cur == $user || $tab[4] == "admin"){
					echo "<button type='button'>Edit profile</button>";
				}
			?>
		</a>
		<br>
		<a href=picedit.php<?php echo "?user=".$user ?> target='_self'>
			<?php
				$file = fopen('./users/'.$user.'/profile.txt', 'r');
				$tab = explode(";", fgets($file));
				fclose($file);
				if ($cur == $user || $tab[4] == "admin"){
					echo "<button type='button'>Add picture</button>";
				}
			?>
		</a>
			<script>
				piclist(<?php
					function picnumber($user){
						$i = 1;
						$a = 1;
						$pic = "pic1.png";
						while ($a != 0){
							if (file_exists("./users/".$user."/".$pic)){
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
					
					echo picnumber($user).",".$user.",".$cur;
				?>)
			</script>
		<div id='piclist'>
		</div>
	</body>
</html>
