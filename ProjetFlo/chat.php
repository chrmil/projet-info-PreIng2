<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href=style.css>
		<script src="javascript.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<?php
		session_start();
		$own = $_GET["own"];
		$oth = $_GET["oth"];
		$cur = $_SESSION["userID"];
		$edit = $_GET["lineedit"];
		include("chatadd.php");
	?>
	</head>
	<body onload=scrollDown(<?php echo $edit ?>)>
		<div id=chat>
			<?php
				if (checkUser($own, $cur)){
					editMessage($cur, $own, $oth, $_POST["editmessage"], $_POST["buttonedit"]);
	
					sendMessage($own, $_POST["message"], $oth, $cur);
					displayMessage($own, $oth, $cur, $edit);
	
					if (!$edit){
						echo "<script>refreshmessage();</script>";
					}
					checkPerms($own, $cur);
				}
				else{
					echo "This is not your page";
				}
			?>
		</div>
	</body>
</html>
