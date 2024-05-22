<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<?php
			
			function deletepic($x){
				if(isset($x)){
					$tab = explode(".", $x);
					$p = substr($tab[0], 0, 3);
					if ($p == "pic"){
						$n = substr($tab[0], 3);
						unlink("./".$_GET["user"]."/".$x);
						$n++;
						$a = 1;
						while ($a != 0){
							$m = $n - 1;
							echo $n.$m."<br>";
							if (file_exists('./'.$_GET["user"].'/pic'.$n.'.png')){
								copy('./'.$_GET["user"].'/pic'.$n.'.png', './'.$_GET["user"].'/pic'.$m.'.png');
							}
							else{
								unlink('./'.$_GET["user"].'/pic'.$m.'.png');
								$a = 0;
							}
							$n++;
						}
					}
					header("Location:userprofile.php?user=".$_GET['user']."&own=".$_GET['own']);
				}
			}
			
			if (file_exists("./".$_GET["user"]."/picpreview.png")){
				unlink("./".$_GET["user"]."/picpreview.png");
			}
			
			deletepic($_GET["picdel"]);
		?>
		<a href=image.php<?php echo "?user=".$_GET["user"]."&own=".$_GET['own'] ?>&pic=pfp.png target='_self'>
			<img src=<?php echo "./".$_GET["user"] ?>/pfp.png id='pfp'>
		</a>
		<?php
			if ($_GET['own']){
				echo "<a href=pfpedit.php?user=".$_GET['user']."&own=".$_GET['own']." target='_self' ";
				echo copy('./'.$_GET['user'].'/pfp.png', './'.$_GET['user'].'/pfppreview.png');
				echo ">
					<img src=edit.png id='edit'>
				</a>";
			}
			
			function displayinfo($user){
				if (file_exists('./'.$user.'/profile.txt')){
					$i = 1;
					$file = fopen('./'.$user.'/profile.txt', 'r');
					$info = fgets($file);
					$tab = explode(';', $info);
					for ($i = 1; $i < 17; $i++){
						if ($i != 3){
							echo "<br>".$tab[$i];
						}
					}
				}
			}
			
			displayinfo($_GET["user"]);
		?>
		<br>
		<a href=useredit.php<?php echo "?user=".$_GET["user"]."&own=".$_GET['own'] ?> target='_self'>
			<?php
				if ($_GET['own']){
					echo "<button type='button'>Edit profile</button>";
				}
			?>
		</a>
		<br>
		<a href=picedit.php<?php echo "?user=".$_GET["user"]."&own=".$_GET['own'] ?> target='_self'>
			<?php
				if ($_GET['own']){
					echo "<button type='button'>Add picture</button>";
				}
			?>
		</a>
			<script>
				piclist(<?php
					function picnumber(){
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
						return $i;
					}
					
					echo picnumber().",".$_GET["user"].",".$_GET['own'];
				?>)
			</script>
		<div id='piclist'>
		</div>
	</body>
</html>
