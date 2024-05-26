<script src="javascript.js"></script>

<?php
	include("global.php");

	function addPic($user, $file){
		if (!empty($file)){
			$str = explode(".", $file["photo"]["name"]);
			if ($str[sizeof($str) - 1] == "jpg" || $str[sizeof($str) - 1] == "jpeg" || $str[sizeof($str) - 1] == "png"){
				move_uploaded_file($file["photo"]["tmp_name"], "./users/".$user."/picpreview.png");
				echo "<br><img src='./users/".$user."/picpreview.png' id='picpreview'><br>";

			}
			else{
				echo "Incorrect file format";
			}
		}
		return 0;
	}

	function editPic($user, $file){
		addpic($user, $file);
		echo '<form method="post" enctype="multipart/form-data" id="editprofile">
			<input type="file" id="addpic" name="photo" accept="image/png,image/jpg,image/jpeg">
			<br>
			<button type="submit" class="submit" id="addpic">Submit picture</button>
		</form>
		<br>
		<a href=userprofile.php?user='.$user.' target="_self" ';
			$pic = picnumber($user);
			echo copy("./users/".$user."/picpreview.png", "./users/".$user."/pic".$pic.".png");
			echo '>
			<button type=button>
				Validate change
			</button>
		</a>';
	}
?>