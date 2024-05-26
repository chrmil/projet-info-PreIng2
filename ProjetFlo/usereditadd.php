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

	function editinfo($user, $infolist){
		if (file_exists('./users/'.$user.'/profile.txt')){
			$i = 1;
			$file = fopen('./users/'.$user.'/profile.txt', 'r');
			$info = fgets($file);
			$str = substr($info, 0, -1);
			$tab = explode(';', $str);
			for ($i = 1; $i < sizeof($tab); $i++){
				if ($i != 3 && $i != 5 && $i != 7 && $i < sizeof($tab) - 1){
				echo $infolist[$i].": <input type='text' id='".$infolist[$i]."' name='".$infolist[$i]."' value='".$tab[$i]."'><br>";
			}
			else if ($i == sizeof($tab) - 1){
				echo "Additionnal description: <textarea id='description' name='description'>".$tab[$i]."</textarea><br>
				<button type='submit' id='submit'>Submit</button>";
		}
	}
?>