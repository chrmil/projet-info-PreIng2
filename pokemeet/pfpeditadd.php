<script src="javascript.js"></script>

<?php
	include("global.php");

	function addPfp($user, $file){
		if (!empty($file)){
			$str = explode(".", $file["pfp"]["name"]);
			if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
				move_uploaded_file($file["pfp"]["tmp_name"], "./users/".$user."/pfppreview.png");

			}
			else{
				echo "Incorrect file format";
			}
		}
		return 0;
	}

	function editPfp($user, $file){
		addPfp($user, $file);
		echo '<img src=./users/'.$user.'/pfppreview.png id="pfp">
		<form method="post" enctype="multipart/form-data">
			<input type="file" id="addpic" name="pfp" accept="image/png,image/jpg,image/jpeg">
			<br>
			<button type="submit" class="submit" id="addpic">Submit profile picture</button>
		</form>
		<br>
		<a href=userprofile.php?user='.$user.' target="_self"'; 
			echo copy("./users/".$user."/pfppreview.png", "./users/".$user."/pfp.png");
			echo '>
			<button type="button">
				Validate change
			</button>
		</a>';
	}
?>