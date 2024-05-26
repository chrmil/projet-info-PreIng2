<script src="javascript.js"></script>

<?php
	include("global.php");

	function deletepic($picdel, $user){
		if(isset($picdel)){
			$tab = explode(".", $picdel);
			$p = substr($tab[0], 0, 3);
			if ($p == "pic"){
				$n = substr($tab[0], 3);
				unlink("./users/".$user."/".$picdel);
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

	function pfpButton($user, $cur){
		if (checkUser($user, $cur)){
			echo "<a href=pfpedit.php?user=".$user." target='_self' ";
			echo copy('./users/'.$user.'/pfp.png', './users/'.$user.'/pfppreview.png');
			echo ">
				<img src=edit.png id='edit'>
			</a>";
		}
	}
	
	function displayInfo($user, $cur){
		if (file_exists('./users/'.$user.'/profile.txt')){
			$infolist = ["UserID", "Username", "Email", "Password", "Subscription", "Subtime", "Gender", "Accdate", "Birthdate", "Profession", "Home", "Relationship", "Children", "Pokemon", "Generation", "Type", "Nature", "Description"];
			$i = 1;
			$file = fopen('./users/'.$user.'/profile.txt', 'r');
			$info = fgets($file);
			$tab = explode(';', $info);
			$tab[sizeof($infolist) - 1] = str_replace('_', ' ', $tab[sizeof($infolist) - 1]);
			for ($i = 1; $i < sizeof($infolist); $i++){
				echo "<div id=displayinfo>";
				if ($i != 2 && $i != 3 && $i != 5){
					echo "<br>".$infolist[$i].":".$tab[$i];
				}
				else if ($i == 2 || $i == 5){
					if (checkUser($user, $cur)){
						echo "<br>".$infolist[$i].":".$tab[$i];
					}
				}
				echo "</div>";
			}
		}
	}
?>
