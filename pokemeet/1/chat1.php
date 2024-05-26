<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=../style.css>
		<script src="javascript.js"></script> 
	</head>
	<body onload=scrollDown()>
		<div id='test'>
			<?php
				function displaymessage($ownuser, $othuser){
					if(file_exists('./chat'.$othuser.'.txt')){
						$chat = fopen('./chat'.$othuser.'.txt', 'r');
						while (!feof($chat)){
							$tab = explode(";",fgets($chat));
							if (feof($chat)){
								break;
							}
							if ($tab[0] == $ownuser){
								$tab2 = array_slice($tab, 1);
								$message = implode($tab2);
								echo "<div id='ownmessage'>".$message;
								echo "<br></div>";
							}
							else if ($tab[0] == $othuser){
								$tab2 = array_slice($tab, 1);
								$message = implode($tab2);
								echo "<div id='othmessage'>".$message;
								echo "<br></div>";
							}
							else{
								echo "Problem displaymessage";
							}
						}
						fclose($chat);          
					}
				}

				function sendpic(){
					if (!empty($_FILES)){
						$str = explode(".", $_FILES["file"]["name"]);
						echo $str[0];
						if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
							echo "<br>".$_FILES["file"]["tmp_name"];
							echo "<br>".$_FILES["file"]["name"];
							move_uploaded_file($_FILES["file"]["tmp_name"], "./pfppreview.png");
							echo "<br>".$str[sizeof($str) - 1];
						}
						else{
							echo "Incorrect file format";
						}
					}
					return 0;
				}
				
				function sendmessage($ownuser, $message, $othuser){
					$owninfo = fopen('./profile.txt', 'r');
					$tab = explode(";", fgets($owninfo));
					fclose($owninfo);
					if(isset($message) && ($tab[4] == "subscribed" || $tab[4] == "admin")){
						$trimmed = trim($message, "\n\x0B \t\r");
						if (!empty($trimmed)){
							$ownchat = fopen('./chat'.$othuser.'.txt', 'a');
							fwrite($ownchat, $ownuser.";".$trimmed."\n");
							fclose($ownchat);
							$othchat = fopen('../'.$othuser.'/chat'.$ownuser.'.txt', 'a');
							fwrite($othchat, $ownuser.";".$trimmed."\n");
							fclose($othchat);
						}
					}
				}
	
				$ownprof = fopen('./profile.txt', 'r');
				$owntab = explode(";", fgets($ownprof));
				$ownuser = $owntab[0];
				fclose($ownprof);
				$othuser = '2';
				
				sendmessage($ownuser, $_POST["message"], $othuser);
				
				displaymessage($ownuser, $othuser);
			?>
		</div>
		<script>
			refreshmessage();
		</script>
		
		<form action="chat1.php" method="post" enctype="multipart/form-data" id="editprofile">
			<textarea id=message name=message>
			</textarea>
			<input type=file name=file accept="image/png, image/jpg, image/jpeg">
			<button type=submit id=send> Send </button>
		</form>
		<script>
			entersend();
		</script>
	</body>
</html>
