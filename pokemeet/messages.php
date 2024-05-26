<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<?php
		session_start();
		$user = $_GET["user"];
		$cur = $_SESSION["userID"];
		include("messagesadd.php");
	?>
	</head>
	<body>
		<div id=chat>
			<?php
				if (checkUser($user, $cur)){
					loadChats($user);
				}
				else{
					echo "This is not your page";
				}
			?>
		</div>
	</body>
</html>
