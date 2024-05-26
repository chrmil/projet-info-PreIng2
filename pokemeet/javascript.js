function piclist(x, user){
	var xhttp, xmlDoc, txt, i = 1;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			txt = "";
			for (i = 1; i <= x; i++) {
				txt = txt + "<a href=image.php?user=" + user + "&pic=pic" + i + ".png target='_self'><img src='./users/" + user + "/pic" + i + ".png' id='pics'></a>";
			}
			document.getElementById("piclist").innerHTML = txt;
		}
	};
	xhttp.open("GET", "userprofile.php", true);
	xhttp.send();
}

function picdel(x){
	const n = JSON.parse(x);
	var xhttp, xmlDoc, txt, i = 1;
	xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		if (this.readyState == 4 && this.status == 200) {
			xmlDoc = this.responseXML;
			if (n[2] == n[1] || n[3]){
				txt = "Confirm delete ?<br><a href=userprofile.php?user=" + n[1] + "&picdel=" + n[0] + " target='_self'> Yes </a> <a href=image.php?user=" + n[1] + "&pic=" + n[0] + " target='_self'> No </a>";
				document.getElementById("delbutton").innerHTML = txt;
			}
		}
	};
	xhttp.open("GET", "image.php", true);
	xhttp.send();
}

function refreshmessage(){
	var auto_refresh = setInterval(function (){
		var url = window.location.href;
		$('#chat').load(url + ' #chat');
	}, 1000); // refresh every 1000 milliseconds
}

function scrollDown(x){
	if (!x){
		window.scrollTo(0, document.body.scrollHeight);
	}
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