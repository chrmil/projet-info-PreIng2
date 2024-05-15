function displayinfo(info){
	if (info == "username" || info == "gender" || info == "birthdate" || info == "profession" || info == "place" || info == "status" || info == "otherinfo"){
		return info;
	}
}

function checkusernameedit(){
	var xhttp; 
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("usernamediv").innerHTML = this.responseText ;
		}
	};  
	var userInfo = document.forms.editprofile;
	var formData = new FormData(userInfo);
	username=formData.get("username");
	if (username.length == 0 ) {
		document.getElementById("usernamediv").innerHTML = "Please enter an username.";
	}
	else if (username.length<3){
		document.getElementById("usernamediv").innerHTML = "This username is too short. The minimum length is 3 characters.";
	}
	else{
		document.getElementById("usernamediv").innerHTML = "";
		xhttp.open("GET", "useredit.php", true);
	}
	xhttp.send();
}

function editprofile(){
	var xhttp, xmlDoc, txt, x, i;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "";
			x = ["username", "gender", "birthdate", "profession", "place", "status", "otherinfo"];
			for (i = 0; i < 7; i++) {
				txt = txt + "<input type='text' id='" + x[i] + "' name='" + x[i] + "' value='" + displayinfo(x[i]) + "' onkeyup='check" + x[i] + "edit()'><div id='" + x[i] + "div'></div>";
			}
			txt = txt + "<button type='submit' class='submit'>Submit</button>";
			document.getElementById("editprofile").innerHTML = txt;
		}
	};
	xhttp.open("GET", "useredit.php", true);
	xhttp.send();
}

function piclist(x){
	var xhttp, xmlDoc, txt, i = 1;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "";
			for (i = 1; i <= x; i++) {
				console.log(i);
				txt = txt + "<a href=image.html target='_self' <?php copy('./pic" + i + ".jpg', './image.png'); ?><img src='pic" + i + ".jpg' id='pics'></a>"
				console.log("<a href=image.html target='_self' <?php copy('./pic" + i + ".jpg', './image.png'); ?><img src='pic" + i + ".jpg' id='pics'></a>");
			}
			document.getElementById("piclist").innerHTML = txt;
		}
	};
	xhttp.open("GET", "userprofile.php", true);
	xhttp.send();
}
