function displayinfo(info){
	if (info == "username" || info == "gender" || info == "birthdate" || info == "profession" || info == "place" || info == "status" || info == "otherinfo"){
		return info;
	}
}

function editprofile(){
	var xhttp, xmlDoc, txt, x, i;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "<input type='file' id='addpfp' name='photo'><br>";
			x = ["username", "gender", "birthdate", "profession", "place", "status", "otherinfo"];
			for (i = 0; i < 7; i++) {
				txt = txt + "<input type='text' id='" + x[i] + "' value=" + displayinfo(x[i]) + "><br>";
			}
			txt = txt + "<input type='submit' class='submit'>";
			document.getElementById("editprofile").innerHTML = txt;
		}
	};
	xhttp.open("GET", "useredit.php", true);
	xhttp.send();
}
