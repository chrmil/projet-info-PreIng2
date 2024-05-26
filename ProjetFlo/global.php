<script src="javascript.js"></script>

<?php
	function checkUser($user, $cur){
		$curinfo = fopen('./users/'.$cur.'/profile.txt', 'r');
		$tabinfo = explode(";", fgets($curinfo));
		fclose($curinfo);
		if($cur == $user || $tabinfo[4] == "admin"){
			return 1;
		}
		else{
			return 0;
		}
	}

	function picnumber($user){
		$i = 1;
		$a = 1;
		$pic = "pic1.png";
		while ($a != 0){
			if (file_exists("./users/".$user."/".$pic)){
				$i++;
				$pic = "pic".$i.".png";
			}
			else{
				$a = 0;
				$i--;
			}
		}
		return $i;
	}
?>