<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script> 
	</head>
	<body>
		<?php
			function displaymessage($user){
				$file = fopen('./chat.txt', 'r');
				while (!feof($file)){
					echo "<div id='ownmessage'>".fgets($file);
					echo "<br></div>";
				}
				fclose($file);
			}
		
			function sendmessage($user, $message){
				if(isset($message)){
					$file = fopen('./chat.txt', 'a');
					fwrite($file, $user.";".trim($message, "\n\x0B \t\r"));
					fclose($file);
				}
			}
			
			sendmessage("1", $_POST["message"]);
			
			displaymessage("1");
		?>
		<form action="chat1.php" method="post" enctype="multipart/form-data" id="editprofile">
			<textarea id=message name=message>
			</textarea>
			<button type=submit> Send </button>
		</form>
	</body>
</html>
