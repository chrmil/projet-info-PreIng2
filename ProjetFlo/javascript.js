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

function editprofile(info){
	const n = JSON.parse(info);
	var xhttp, xmlDoc, txt, x, i;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "";
			x = ["username", "email", "password", "subscription", "gender", "accdate", "birthdate", "profession", "home", "relationship", "children", "pokemon", "generation", "type", "nature"];
			for (i = 1; i < 16; i++) {
				if (i != 3 && i != 6){
					txt = txt + "<input type='text' id='" + x[i] + "' name='" + x[i] + "' value='" + n[i]/* + "' onkeyup='check" + x[i] + "edit()'><div id='" + x[i] + "div'></div>"*/ + "'><br>";
				}
			}
			txt = txt + "<textarea id='description' name='description'>" + n[16] + "</textarea><br><button type='submit' class='submit'>Submit</button>";
			document.getElementById("editprofile").innerHTML = txt;
		}
	};
	xhttp.open("GET", "useredit.php?user=" + n[0], true);
	xhttp.send();
}

function piclist(x, user){
	var xhttp, xmlDoc, txt, i = 1;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "";
			for (i = 1; i <= x; i++) {
				txt = txt + "<a href=image.php?user=" + user + "&pic=pic" + i + ".png target='_self'><img src='./" + user + "/pic" + i + ".png' id='pics'></a>";
			}
			document.getElementById("piclist").innerHTML = txt;
		}
	};
	xhttp.open("GET", "userprofile.php", true);
	xhttp.send();
}

function confirmdel(){
	if (confirm("Do you want to delete this picture ?")){
		
	}
}

function picdel(x, user){
	const n = JSON.parse(x);
	var xhttp, xmlDoc, txt, i = 1;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "Confirm delete ?<br><a href=userprofile.php?user=" + user + "&picdel=" + n + " target='_self' color='red'> Yes </a><a href=image.php?user=" + user + "&pic=" + n + " target='_self'> No </a>";
			document.getElementById("delbutton").innerHTML = txt;
		}
	};
	xhttp.open("GET", "image.php", true);
	xhttp.send();
}

function refreshmessage(){
	var auto_refresh = setInterval(function (){
		var url = window.location.href;
		$('#test').load(url + ' #test');
	}, 1000); // refresh every 1000 milliseconds
}

function scrollDown(){
	window.scrollTo(0, document.body.scrollHeight);
}

function entersend(){
	// Execute a function when the user presses a key on the keyboard
	document.body.addEventListener("keypress", function(event) {
		// If the user presses the "Enter" key on the keyboard
		if (event.key === "Enter") {
			// Cancel the default action, if needed
			event.preventDefault();
			// Trigger the button element with a click
			document.getElementById("send").click();
		}
	});
}
