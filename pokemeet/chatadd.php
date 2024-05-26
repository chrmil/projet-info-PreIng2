<script src="javascript.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<?php
	include("global.php");

	function editChat($own, $oth, $edit, $line, $message){
		if ($edit == $line){
			echo "<form action=chat.php?own=".$own."&oth=".$oth." method='post' id='editchat'>
				<input type='text' id='editmessage' name='editmessage' value='".$message."'>
				<button type='submit' name=buttonedit value='".$edit."'> Submit change </button> <a href=chat.php?own=".$own."&oth=".$oth." target='_self'>
					<button type=button> Cancel </button>
				</a>
			</form>";
			echo "<div id=lineedit>
				<script>
					var edit = document.getElementById('lineedit');
					edit.scrollIntoView();
				</script>
			</div>";
		}
		else{
			echo "<a href=chat.php?own=".$own."&oth=".$oth."&lineedit=".$line." target=_self>
				<button type=button class='ownmessage' id=".$line.">";
			echo $message;
			echo "</button></a><br>";
		}
	}

	function chatImg($own, $oth, $imgown, $picnum){
		echo "<div id='".$imgown."img'>
			<a href=image.php?&own=".$own."&oth=".$oth."&pic=".$imgown."_".$oth."_".$picnum." target='_self'>
				<img src=./users/".$own."/".$imgown."_".$oth."_".$picnum."><br>
			</a>
		</div>";
	}

	function displayMessage($own, $oth, $cur, $edit){
		if(file_exists('./users/'.$own.'/chat'.$oth.'.txt')){
			if(checkUser($own, $cur)){
				$chat = fopen('./users/'.$own.'/chat'.$oth.'.txt', 'r');
				while (!feof($chat)){
					$tab = explode(";",fgets($chat));
					if (feof($chat)){
						break;
					}
					if ($tab[0] == "FILE"){
						switch ($tab[2]){
							case $own:
								chatImg($own, $oth, 'own', $tab[3]);
								break;
							case $oth:
								chatImg($own, $oth, 'oth', $tab[3]);
								break;
							default:
								chatImg($own, $oth, 'admin', $tab[3]);
						}
					}
					else if ($tab[1] == $own){
						$tab2 = array_slice($tab, 2);
						$message = implode($tab2);
						editChat($own, $oth, $edit, $tab[0], $message);
					}
					else if ($tab[1] == $oth){
						$tab2 = array_slice($tab, 2);
						$message = implode($tab2);
						if ($tabinfo[4] == 0){
							editChat($own, $oth, $edit, $tab[0], $message);
						}
						else{
							echo "<div id='othmessage'>";
							echo $message;
							echo "<br></div>";
						}
					}
					else{
						$tab2 = array_slice($tab, 2);
						$message = implode($tab2);
						if ($tabinfo[4] == 0){
							editChat($own, $oth, $edit, $tab[0], $message);
						}
						else{
							echo "<div id='adminmessage'>";
							echo $message;
							echo "<br></div>";
						}
					}
				}
				fclose($chat);
			}
		}
		else{
			fopen('./users/'.$own.'/chat'.$oth.'.txt', 'w');
			fopen('./users/'.$oth.'/chat'.$own.'.txt', 'w');
		}
	}

	function checkPerms($own, $cur){
		if(checkUser($own, $cur)){
			echo "
			<form method='post' enctype='multipart/form-data'>
				<a href=userprofile.php?user=".$own." target='_self'> <- Back </a>
				<textarea id=message name=message></textarea>
				<input type=file name=file accept='image/png,image/jpg,image/jpeg'>
				<button type=submit id=send> Send </button>
			</form>
			<script>
				entersend();
			</script>";
		}
		else{
			echo "You need to subscribe to send a message.";
		}
	}

	function replaceMessage($message){
		$tbreplaced = array("\n", "\x0B", "\r", "\t", "<", ">");
		$replaced = str_replace($tbreplaced, " ", $message);
		$trimmed = trim($replaced, " ");
		return $trimmed;
	}

	function addMessage($sender, $user1, $user2, $message, $line){
		$chat = fopen('./users/'.$user1.'/chat'.$user2.'.txt', 'a');
		fwrite($chat, $line.";".$sender.";".$message."\n");
		fclose($chat);
	}

	function addFile($sender, $user1, $user2, $picnum, $filename){
		move_uploaded_file($filename, './users/'.$user1.'/'.$sender.'_'.$user2.'_'.$picnum.'.png');
		copy('./users/'.$user1.'/'.$sender.'_'.$user2.'_'.$picnum.'.png', './users/'.$user2.'/'.$sender.'_'.$user1.'_'.$picnum.'.png');
	}
		
	function sendFile($sender, $user1, $user2, $picnum, $line){
		$chat = fopen('./users/'.$user1.'/chat'.$user2.'.txt', 'a');
		fwrite($chat, "FILE;".$line.";".$sender.";".$picnum.".png"."\n");
		fclose($chat);
	}

	function picnumber2($own, $oth){
		$i = 1;
		$a = 1;
		$pic = "1.png";
		while ($a != 0){
			if (file_exists("./users/".$own."/own_".$oth."_".$pic) || file_exists("./users/".$own."/oth_".$oth."_".$pic) || file_exists("./users/".$own."/admin_".$oth."_".$pic)){
				$i++;
				$pic = $i.".png";
			}
			else{
				$a = 0;
			}
		}
		return $i;
	}

	function sendMessage($own, $message, $oth, $cur){
		$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
		$tab = explode(";", fgets($curinfo));
		fclose($curinfo);
		if((isset($message) || is_uploaded_file($_FILES["file"]["tmp_name"])) && (($cur == $own && $tab[4] == 1) || $tab[4] == 0))){
			if (isset($message)){
				$i = 0;
				$chat = fopen('./users/'.$own.'/chat'.$oth.'.txt', 'r');
				while (!feof($chat)){
					fgets($chat);
					$i++;
				}
				fclose($chat);
				$trimmed = replaceMessage($message);
				if (!empty($trimmed)){
					addMessage($cur, $own, $oth, $trimmed, $i);
					addMessage($cur, $oth, $own, $trimmed, $i);
					$i++;
				}
			}
			if (is_uploaded_file($_FILES["file"]["tmp_name"])){
				$picnum = picnumber2($own, $oth);
				$str = explode(".", $_FILES["file"]["name"]);
				if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
					if ($cur == $own){
						addFile('own', $own, $oth, $picnum, $_FILES["file"]["tmp_name"]);
						sendFile($cur, $own, $oth, $picnum, $i);
						sendFile($cur, $oth, $own, $picnum, $i);
					}
					else{
						addFile('admin', $own, $oth, $picnum, $_FILES["file"]["tmp_name"]);
						sendFile($cur, $own, $oth, $picnum, $i);
						sendFile($cur, $oth, $own, $picnum, $i);
					}
				}
				else{
					echo "Incorrect file format";
				}
			}
		}
	}

	function validateChatEdit($own, $oth, $file, $tab){
		file_put_contents('./users/'.$own.'/chat'.$oth.'.txt', "");
		fseek($file,0);
		for ($i = 1 ; $i < sizeof($tab) ; $i++){
			fwrite($file, $tab[$i]);
		}
	}

	function editMessage($cur, $own, $oth, $edit, $button){
		if(checkUser($own, $cur)){
			if (isset($edit)){
				$trimmed = replaceMessage($edit);
				$chat = fopen('./users/'.$own.'/chat'.$oth.'.txt', 'r+');
				$i = 1;
				$tab[0] = 0;
				while (!feof($chat)){
					$tab[$i] = fgets($chat);
					$i++;
				}
				if(empty($trimmed)){
					for ($i = $button + 1 ; $i < sizeof($tab) - 1 ; $i++){
						$str = explode(";", $tab[$i]);
						if($str[0] == 'FILE'){
							$str[1]--;
						}
						else{
							$str[0]--;
						}
						$tab[$i - 1] = implode(";", $str);
						if ($i == sizeof($tab) - 2){
							$tab[$i] = "";
						}
					}
					validateChatEdit($own, $oth, $chat, $tab);
				}
				else{
					$str = explode(";", $tab[$_POST["buttonedit"]]);
					$str[2] = $trimmed."\n";
					$tab[$_POST["buttonedit"]] = implode(";", $str);
					validateChatEdit($own, $oth, $chat, $tab);
				}
				fclose($chat);
				copy('./users/'.$own.'/chat'.$oth.'.txt', './users/'.$oth.'/chat'.$own.'.txt');
			}
		}
	}
?>
