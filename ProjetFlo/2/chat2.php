<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=../style.css>
		<script src="../javascript.js"></script> 
	</head>
	<body>
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
			
			function sendmessage($ownuser, $message, $othuser){
				$owninfo = fopen('./profile.txt', 'r');
				$tab = explode(";", fgets($owninfo));
				if(isset($message) && ($tab[3] == "subscribed" || $tab[3] == "admin")){
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
			$ownuser = '1';
			$othuser = '2';
			
			sendmessage($ownuser, $_POST["message"], $othuser);
			
			displaymessage($ownuser, $othuser);
		?>
		<form action="chat2.php" method="post" enctype="multipart/form-data" id="editprofile">
			<textarea id=message name=message>
			</textarea>
			<button type=submit> Send </button>
		</form>
	</body>
</html>
