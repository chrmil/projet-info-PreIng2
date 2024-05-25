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
				txt = txt + "<a href=image.php?pic=pic" + i + ".png target='_self'><img src='pic" + i + ".png' id='pics'></a>";
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

function picdel(x){
	const n = JSON.parse(x);
	var xhttp, xmlDoc, txt, i = 1;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "Confirm delete ?<br><a href=userprofile.php?picdel=" + n + " target='_self' color='red'> Yes </a><a href=image.php?pic=" + n + " target='_self'> No </a>";
			document.getElementById("delbutton").innerHTML = txt;
		}
	};
	xhttp.open("GET", "image.php", true);
	xhttp.send();
}

function refreshmessage(){
	var auto_refresh = setInterval(function (){
		$('#test').load('chat.php #test');
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
