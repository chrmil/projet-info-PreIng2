<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<?php $edit = $_GET["lineedit"]?>
	</head>
	<body onload=scrollDown(<?php echo $edit ?>)>
		<div id='test'>
			<?php
				function picnumber2($ownuser, $othuser){
					$i = 1;
					$a = 1;
					$pic = "1.png";
					while ($a != 0){
						if (file_exists("./users/".$ownuser."/own_".$othuser."_".$pic) || file_exists("./users/".$ownuser."/oth_".$othuser."_".$pic) || file_exists("./users/".$ownuser."/admin_".$othuser."_".$pic)){
							$i++;
							$pic = $i.".png";
						}
						else{
							$a = 0;
						}
					}
					return $i;
				}
				
				function displaymessage($ownuser, $othuser, $cur, $edit){
					if(file_exists('./users/'.$ownuser.'/chat'.$othuser.'.txt')){
						$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
						$tabinfo = explode(";", fgets($curinfo));
						fclose($curinfo);
						if($cur == $ownuser || $tabinfo[4] == "admin"){
							$chat = fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'r');
							while (!feof($chat)){
								$tab = explode(";",fgets($chat));
								if (feof($chat)){
									break;
								}
								if ($tab[0] == "FILE"){
									if ($tab[2] == $ownuser){
										echo "<div id='ownimg'>
											<a href=image.php?user=".$ownuser."&cur=".$cur."&pic=own_".$othuser."_".$tab[3]." target='_self'>
												<img src=./users/".$ownuser."/own_".$othuser."_".$tab[3]."><br>
											</a>
										</div>";
									}
									else if ($tab[2] == $othuser){
										echo "<div id='othimg'>
											<a href=image.php?user=".$ownuser."&cur=".$cur."&pic=oth_".$othuser."_".$tab[3]." target='_self'>
												<img src=./users/".$ownuser."/oth_".$othuser."_".$tab[3]."><br>
											</a>
										</div>";
									}
									else{
										echo "<div id='adminimg'>
												<a href=image.php?user=".$ownuser."&cur=".$cur."&pic=admin_".$othuser."_".$tab[3]." target='_self'>
													<img src=./users/".$ownuser."/admin_".$othuser."_".$tab[3]."><br>
												</a>
											</div>";
									}
								}
								else if ($tab[1] == $ownuser){
									$tab2 = array_slice($tab, 2);
									$message = implode($tab2);
									if ($edit == $tab[0]){
										echo "<form action=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur." method='post' id='editchat'><input type='text' id='editmessage' name='editmessage' value='".$message."'>
											<button type='submit' name=buttonedit value='".$edit."'> Submit change </button> <a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur." target='_self'>
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
										echo "<a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur."&lineedit=".$tab[0]." target=_self>
											<button type=button class='ownmessage' id=".$tab[0].">";
										echo $message;
										echo "</button></a><br>";
									}
								}
								else if ($tab[1] == $othuser){
									$tab2 = array_slice($tab, 2);
									$message = implode($tab2);
									if ($tabinfo[4] == "admin"){
										if ($edit == $tab[0]){
											echo $message."<br><form method='post' enctype='multipart/form-data' id='editmessage'> 
												<input type='text' id=edit".$edit." name=edit".$edit." value='".$message."'><br>
												<button type='submit' id='submit'>Submit change</button>";
											echo /*"Confirm change
												<br>
													<a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur."&linedel=".$edit." target='_self'> Yes </a>*/ "<a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur." target='_self'>
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
											echo "<a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur."&lineedit=".$tab[0]." target=_self>
												<button type=button class='ownmessage' id=".$tab[0].">";
											echo $message;
											echo "</button></a><br>";
										}
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
									if ($tabinfo[4] == "admin"){
										if ($edit == $tab[0]){
											echo "Confirm change
												<br>
													<a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur."&linedel=".$edit." target='_self'> Yes </a> <a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur." target='_self'> No </a>";
											echo "<div id=lineedit>
												<script>
													var edit = document.getElementById('lineedit');
											edit.scrollIntoView();
												</script>
											</div>";
										}
										else{
											echo "<a href=chat.php?ownuser=".$ownuser."&othuser=".$othuser."&cur=".$cur."&lineedit=".$tab[0]." target=_self>
												<button type=button class='ownmessage' id=".$tab[0].">";
											echo $message;
											echo "</button></a><br>";
										}
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
						fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'w');
						fopen('./users/'.$othuser.'/chat'.$ownuser.'.txt', 'w');
					}
				}
				
				function checkperms($ownuser, $cur){
					$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
					$tab = explode(";", fgets($curinfo));
					fclose($curinfo);
					if(($cur == $ownuser && $tab[4] == "subscribed") || $tab[4] == "admin"){
						echo "
						<form method='post' enctype='multipart/form-data'>
							<a href=userprofile.php?user=".$ownuser."&cur=".$cur." target='_self'> <- Back </a>
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
				
				function sendmessage($ownuser, $message, $othuser, $cur){
					$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
					$tab = explode(";", fgets($curinfo));
					fclose($curinfo);
					if((isset($message) || is_uploaded_file($_FILES["file"]["tmp_name"])) && (($cur == $ownuser && $tab[4] == "subscribed") || $tab[4] == "admin")){
						if (isset($message)){
							$i = 0;
							$chat = fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'r');
							while (!feof($chat)){
								fgets($chat);
								$i++;
							}
							fclose($chat);
							$tbreplaced = array("\n", "\x0B", "\r", "\t", "<", ">");
							$replaced = str_replace($tbreplaced, ' ', $message);
							$trimmed = trim($replaced, " ");
							if (!empty($trimmed)){
								$ownchat = fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'a+');
								echo "<br>".$i."<br>";
								fwrite($ownchat, $i.";".$cur.";".$trimmed."\n");
								fclose($ownchat);
								$othchat = fopen('./users/'.$othuser.'/chat'.$ownuser.'.txt', 'a');
								fwrite($othchat, $i.";".$cur.";".$trimmed."\n");
								fclose($othchat);
								$i++;
							}
						}
						if (is_uploaded_file($_FILES["file"]["tmp_name"])){
							$picnum = picnumber2($ownuser, $othuser);
							$str = explode(".", $_FILES["file"]["name"]);
							if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
								if ($cur == $ownuser){
									move_uploaded_file($_FILES["file"]["tmp_name"], './users/'.$ownuser.'/own_'.$othuser.'_'.$picnum.'.png');
									copy('./users/'.$ownuser.'/own_'.$othuser.'_'.$picnum.'.png', './users/'.$othuser.'/oth_'.$ownuser.'_'.$picnum.'.png');
									$ownchat = fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'a');
									fwrite($ownchat, "FILE;".$i.";".$cur.";".$picnum.".png"."\n");
									fclose($ownchat);
									$othchat = fopen('./users/'.$othuser.'/chat'.$ownuser.'.txt', 'a');
									fwrite($othchat, "FILE;".$i.";".$cur.";".$picnum.".png"."\n");
									fclose($othchat);
								}
								else{
									move_uploaded_file($_FILES["file"]["tmp_name"], './users/'.$ownuser.'/admin_'.$othuser.'_'.$picnum.'.png');
									copy('./users/'.$ownuser.'/admin_'.$othuser.'_'.$picnum.'.png', './users/'.$othuser.'/admin_'.$ownuser.'_'.$picnum.'.png');
									$ownchat = fopen('./users/'.$ownuser.'/chat'.$othuser.'.txt', 'a');
									fwrite($ownchat, "FILE;".$i.";".$cur.";".$picnum.".png"."\n");
									fclose($ownchat);
									$othchat = fopen('./users/'.$othuser.'/chat'.$ownuser.'.txt', 'a');
									fwrite($othchat, "FILE;".$i.";".$cur.";".$picnum.".png"."\n");
									fclose($othchat);
								}
							}
							else{
								echo "Incorrect file format";
							}
						}
					}
				}
		
				if (isset($_POST["editmessage"])){
					$tbreplaced = array("\n", "\x0B", "\r", "\t", "<", ">");
					$replaced = str_replace($tbreplaced, ' ', $_POST["editmessage"]);
					$trimmed = trim($replaced, " ");
					$chat = fopen('./users/'.$_GET["ownuser"].'/chat'.$_GET["othuser"].'.txt', 'r+');
					$i = 1;
					$tab[0] = 0;
					while (!feof($chat)){
						$tab[$i] = fgets($chat);
						$i++;
					}
					if(empty($trimmed)){
						for ($i = $_POST["buttonedit"] + 1 ; $i < sizeof($tab) - 1 ; $i++){
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
						file_put_contents('./users/'.$_GET["ownuser"].'/chat'.$_GET["othuser"].'.txt', "");
						fseek($chat,0);
						for ($i = 1 ; $i < sizeof($tab) ; $i++){
							fwrite($chat, $tab[$i]);
						}
					}
					else{
						$str = explode(";", $tab[$_POST["buttonedit"]]);
						$str[2] = $trimmed."\n";
						$tab[$_POST["buttonedit"]] = implode(";", $str);
						file_put_contents('./users/'.$_GET["ownuser"].'/chat'.$_GET["othuser"].'.txt', "");
						fseek($chat,0);
						for ($i = 1 ; $i < sizeof($tab) ; $i++){
							fwrite($chat, $tab[$i]);
						}
					}
					copy('./users/'.$_GET["ownuser"].'/chat'.$_GET["othuser"].'.txt', './users/'.$_GET["othuser"].'/chat'.$_GET["ownuser"].'.txt');
				}
		
				sendmessage($_GET["ownuser"], $_POST["message"], $_GET["othuser"], $_GET["cur"]);
				
				displaymessage($_GET["ownuser"], $_GET["othuser"], $_GET["cur"], $edit);

				if (!$edit){
					echo "<script>refreshmessage();</script>";
				}
			?>
		</div>
		<?php
			checkperms($_GET["ownuser"], $_GET["cur"]);
		?>
	</body>
</html>
