<script src="javascript.js"></script>

<?php
	include("global.php");
	include("users.php");

	function replaceText($text){
		$tbreplaced = array("\n", "\x0B", "\r", "\t", "<", ">", "\"", "'", ";", " ");
		$replaced = str_replace($tbreplaced, '_', $text);
		return $replaced;
	}

	function userEdit($user, $infolist, $post){
		if (isset($post["Username"])){
			$newinfo = array($user);
			$file = fopen('./users/'.$user.'/profile.txt', 'r');
			$info = fgets($file);
			$str = substr($info, 0, -1);
			$tab = explode(';', $str);
			for ($i = 1; $i < sizeof($infolist); $i++){
				if ($i == 3 || $i == 5 || $i == 7){
					$newinfo[$i] = $tab[$i];
				}
				else if ($i == sizeof($infolist) - 1){
					$replaced = replaceText($post[$infolist[$i]]);
					$trimmed = trim($replaced, "_");
					$newinfo[$i] = $trimmed;
				}
				else{
					$newinfo[$i] = replaceText($post[$infolist[$i]]);
				}
			}
			updateUser($user, $newinfo);
		}
	}

	function selectInfo($infolist, $i, $tab){
		echo $infolist[$i].": <select id='".$infolist[$i]."' name='".$infolist[$i].">";
			for ($j = 0; $j < sizeof($tab); $j++){
				if ($tab[$j] == $tab[$i]){
					echo "<option value =".$tab[$j]."selected>".$tab[$j]."</option>";
				}
				else{
					echo "<option value =".$tab[$j].">".$tab[$j]."</option>";
				}
			}
		echo "</select><br>";
	}

	function editInfo($user, $infolist){
		if (file_exists('./users/'.$user.'/profile.txt')){
			$i = 1;
			$file = fopen('./users/'.$user.'/profile.txt', 'r');
			$info = fgets($file);
			$str = substr($info, 0, -1);
			$tab = explode(';', $str);
			$tabstatus = array('Married', 'Divorced', 'Couple', 'Single');
			$tabstarter = array('Bulbasaur', 'Charmander', 'Squirtle', 'Pikachu');
			$tabgen = array('Gen1	(Red / Blue / Yellow)', 'Gen2	(Gold / Silver / Crystal)', 'Gen3	(Ruby / Sapphire / Emerald)', 'Gen4	(Diamond / Pearl / Platinum)', 'Gen5	(Black / White)',  'Gen6	(X / Y)', 'Gen7	(Sun / Moon)', 'Gen8	(Sword / Shield)', 'Gen9	(Scarlet / Violet)');
			$tabtype = array('Bug', 'Dark', 'Dragon', 'Electric', 'Fairy', 'Fighting', 'Fire', 'Flying', 'Ghost', 'Grass', 'Ground', 'Ice', 'Normal', 'Poison', 'Psychic', 'Rock', 'Steel', 'Water');
			$tabnature = array('Adamant', 'Bashful', 'Bold', 'Brave', 'Calm', 'Careful', 'Docile', 'Gentle', 'Hardy', 'Hasty', 'Impish', 'Jolly', 'Lax', 'Lonely', 'Mild', 'Modest', 'Naive', 'Naughty', 'Quiet', 'Quirky', 'Rash', 'Relax', 'Sassy', 'Serious', 'Timid');
			for ($i = 1; $i < sizeof($tab); $i++){
				if ($i != 3 && $i != 5 && $i != 7 && $i < 11){
					echo $infolist[$i].": <input type='text' id='".$infolist[$i]."' name='".$infolist[$i]."' value='".$tab[$i]."'><br>";
				}
				else if($i == 12){
					echo $infolist[$i].": <input type='number' id='".$infolist[$i]."' name='".$infolist[$i]."' value='".$tab[$i]."' min=0><br>";
				}
				else if($i == 11 || $i == 13 || $i == 14 || $i == 15 || $i == 16){
					switch($i){
						case 11:
							echo $infolist[$i].": <select id='".$infolist[$i]."' name='".$infolist[$i].">";
								for ($j = 0; $j < sizeof($tabstatus); $j++){
									if ($tabstatus[$j] == $tab[$i]){
										echo "<option value =".$tabstatus[$j]."selected>".$tabstatus[$j]."</option>";
									}
									else{
										echo "<option value =".$tabstatus[$j].">".$tabstatus[$j]."</option>";
									}
								}
							echo "</select><br>";
							break;
						case 13:
							selectInfo($infolist, $i, $tabstarter);
							break;
						case 14:
							selectInfo($infolist, $i, $tabgen);
							break;
						case 15:
							selectInfo($infolist, $i, $tabtype);
							break;
						case 16:
							selectInfo($infolist, $i, $tabnature);
							break;
					}
				}
				else if ($i == sizeof($tab) - 1){
					echo "Additionnal description: <textarea id='description' name='description'>".$tab[$i]."</textarea><br>
				<button type='submit' id='submit'>Submit</button>";
				}
				else{
					echo "Problem editInfo"; 
				}
			}
		}
	}
?>
