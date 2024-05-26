<script src="javascript.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<?php
	include("global.php");

	function loadChats($user){
		$tab = scandir("./users/".$user, SCANDIR_SORT_DESCENDING);
		for ($i = 0; $i < sizeof($tab); $i++){
			$str = substr($tab[$i], 0, 4);
			if ($str == 'chat'){
				$othtab = explode(".", $tab[$i]);
				$oth = substr($othtab[0], 4);
				$othfile = fopen("./users/".$oth."/profile.txt", "r");
				$othinfo = explode(";", fgets($othfile));
				fclose($othfile);
				$othuser = $othinfo[1];
				echo "<a href=chat.php?own=".$user."&oth=".$oth." target=_self>
					<button type=button>".$othinfo[1]."</button>
				</a><br>";
			}
		}
		echo "<script>refreshmessage();</script>";
	}
?>
