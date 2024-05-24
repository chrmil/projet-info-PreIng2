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
				function picnumber2($ownuser, $othuser){
					$i = 1;
					$a = 1;
					$pic = "1.png";
					while ($a != 0){
						if (file_exists("./users/".$ownuser."/own_".$othuser."_".$pic) || file_exists("./users/".$ownuser."/oth_".$othuser."_".$pic)){
							$i++;
							$pic = $i.".png";
						}
						else{
							$a = 0;
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
									echo "<div id='ownimg'>
										<a href=image.php?user=".$_GET["ownuser"]."&own=0&pic=own_".$othuser."_".$tab[2]." target='_self'>
											<img src=./users/".$ownuser."/own_".$othuser."_".$tab[2]."><br>
										</a>
									</div>";
								}
								else if ($tab[1] == $othuser){
									echo "<div id='othimg'>
										<a href=image.php?user=".$_GET["ownuser"]."&own=0&pic=oth_".$othuser."_".$tab[2]." target='_self'>
											<img src=./users/".$ownuser."/oth_".$othuser."_".$tab[2]."><br>
										</a>
									</div>";
								}
								else{
									echo "Problem displaymessage";
								}
							}
							else if ($tab[0] == $ownuser){
								$tab2 = array_slice($tab, 1);
								$message = implode($tab2);
								echo "<div id='ownmessage'>";
								echo $message;
								echo "<br></div>";
							}
							else if ($tab[0] == $othuser){
								$tab2 = array_slice($tab, 1);
								$message = implode($tab2);
								echo "<div id='othmessage'>";
								echo $message;
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
					$owninfo = fopen('./users/'.$ownuser.'/profile.txt', 'r');
					$tab = explode(";", fgets($owninfo));
					fclose($owninfo);
					if($tab[4] == "subscribed" || $tab[4] == "admin"){
						echo "
						<form method='post' enctype='multipart/form-data'>
							<a href=userprofile.php?user=".$_GET['ownuser']."&own=".$_GET['own']." target='_self'> <- Back </a>
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
				
				function sendmessage($ownuser, $message, $othuser){
					$owninfo = fopen('./users/'.$ownuser.'/profile.txt', 'r');
					$tab = explode(";", fgets($owninfo));
					fclose($owninfo);
					if((isset($message) || is_uploaded_file($_FILES["file"]["tmp_name"])) && ($tab[4] == "subscribed" || $tab[4] == "admin")){
						if (isset($message)){
							$tbreplaced = array("\n", "\x0B", "\r", "\t", "<", ">");
							$replaced = str_replace($tbreplaced, ' ', $message);
							$trimmed = trim($replaced, " ");
							if (!empty($trimmed)){
								$ownchat = fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'a');
								fwrite($ownchat, $ownuser.";".$trimmed."\n");
								fclose($ownchat);
								$othchat = fopen('./users/'.$othuser.'/chat'.$ownuser.'.txt', 'a');
								fwrite($othchat, $ownuser.";".$trimmed."\n");
								fclose($othchat);
							}
						}
						if (is_uploaded_file($_FILES["file"]["tmp_name"])){
							$picnum = picnumber2($ownuser, $othuser);
							$str = explode(".", $_FILES["file"]["name"]);
							if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
								move_uploaded_file($_FILES["file"]["tmp_name"], './users/'.$ownuser.'/own_'.$othuser.'_'.$picnum.'.png');
								copy('./users/'.$ownuser.'/own_'.$othuser.'_'.$picnum.'.png', './users/'.$othuser.'/oth_'.$ownuser.'_'.$picnum.'.png');
								$ownchat = fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'a');
								fwrite($ownchat, "FILE;".$ownuser.";".$picnum.".png"."\n");
								fclose($ownchat);
								$othchat = fopen('./users/'.$othuser.'/chat'.$ownuser.'.txt', 'a');
								fwrite($othchat, "FILE;".$ownuser.";".$picnum.".png"."\n");
								fclose($othchat);
							}
							else{
								echo "Incorrect file format";
							}
						}
					}
				}
				
				sendmessage($_GET["ownuser"], $_POST["message"], $_GET["othuser"]);
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
