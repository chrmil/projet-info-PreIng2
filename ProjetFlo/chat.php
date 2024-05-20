<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	</head>
	<body onload=scrollDown()>
		<div id='test'>
			<?php
				function picnumber2($ownuser){
					$i = 1;
					$a = 1;
					$pic = "./".$ownuser."/1.png";
					while ($a != 0){
						if (file_exists($pic)){
							$i++;
							$pic = $i.".png";
						}
						else{
							$a = 0;
							$i--;
						}
					}
					return $i;
				}
				
				function displaymessage($ownuser, $othuser){
					if(file_exists('./'.$ownuser.'/chat'.$othuser.'.txt')){
						$chat = fopen('./'.$ownuser.'/chat'.$othuser.'.txt', 'r');
						while (!feof($chat)){
							$tab = explode(";",fgets($chat));
							if (feof($chat)){
								break;
							}
							if ($tab[0] == "FILE"){
								if ($tab[1] == $ownuser){
									echo "<div id='ownimg'><img src=./".$ownuser."/own_".$othuser."_".$tab[2]."<br></div>";
								}
								else if ($tab[1] == $othuser){
									echo "<div id='othimg'><img src=./".$ownuser."/oth_".$othuser."_".$tab[2]."<br></div>";
								}
								else{
									echo "Problem displaymessage";
								}
							}
							else if ($tab[0] == $ownuser){
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
				
				function checkperms($ownuser){
					$owninfo = fopen('./'.$ownuser.'/profile.txt', 'r');
					$tab = explode(";", fgets($owninfo));
					fclose($owninfo);
					if($tab[3] == "subscribed" || $tab[3] == "admin"){
						echo "<form method='post' enctype='multipart/form-data'>
							<textarea id=message name=message>
							</textarea>
							<input type=file name=file accept='image/png, image/jpg, image/jpeg'>
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
				
				function sendmessage($ownuser, $message, $file, $othuser){
					$owninfo = fopen('./'.$ownuser.'/profile.txt', 'r');
					$tab = explode(";", fgets($owninfo));
					fclose($owninfo);
					if((isset($message) || !empty($_FILES)) && ($tab[3] == "subscribed" || $tab[3] == "admin")){
						if (isset($message)){
							$trimmed = trim($message, "\n\x0B \t\r");
							if (!empty($trimmed)){
								$ownchat = fopen('./'.$ownuser.'/chat'.$othuser.'.txt', 'a');
								fwrite($ownchat, $ownuser.";".$trimmed."\n");
								fclose($ownchat);
								$othchat = fopen('./'.$othuser.'/chat'.$ownuser.'.txt', 'a');
								fwrite($othchat, $ownuser.";".$trimmed."\n");
								fclose($othchat);
							}
						}
						if (!empty($_FILES)){
							$picnum = picnumber2($ownuser);
							$str = explode(".", $_FILES["file"]["name"]);
							if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
								move_uploaded_file($_FILES["file"]["tmp_name"], './'.$ownuser.'/own_'.$othuser.'_'.$picnum.'.png');
								copy('./'.$ownuser.'/own_'.$othuser.'_'.$picnum.'.png', './'.$othuser.'/oth_'.$ownuser.'_'.$picnum.'.png');
								$ownchat = fopen('./'.$ownuser.'/chat'.$othuser.'.txt', 'a');
								fwrite($ownchat, "FILE;".$ownuser.";".$picnum.".png"."\n");
								fclose($ownchat);
								$othchat = fopen('./'.$othuser.'/chat'.$ownuser.'.txt', 'a');
								fwrite($othchat, "FILE;".$ownuser.";".$picnum.".png"."\n");
								fclose($othchat);
							}
							else{
								echo "Incorrect file format";
							}
						}
					}
				}
				
				sendmessage($_GET["ownuser"], $_POST["message"], $_POST["file"], $_GET["othuser"]);
				displaymessage($_GET["ownuser"], $_GET["othuser"]);

			?>
		</div>
		<script>
			refreshmessage();
		</script>
		<?php
			checkperms($_GET["ownuser"]);
		?>
	</body>
</html>
