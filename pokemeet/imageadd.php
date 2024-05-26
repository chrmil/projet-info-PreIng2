<script src="javascript.js"></script>

<?php
	include("global.php");

	function piczoom($pic, $user, $cur){
		copy('./users/'.$user.'/'.$pic, './users/'.$user.'/image.png');
		$p = substr($pic, 0, 3);
		if ($p == "pic" && checkUser($user, $cur)){
			$array = array($pic, $user);
			$m = json_encode($array);
			echo "<button type='button' onclick=picdel('$m')>
				<img src='delete.png' id='edit'>
			</button>";
		}
	}
?>