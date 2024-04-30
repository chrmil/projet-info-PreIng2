function pfppreview(){
	var string = String(document.getElementById("addpfp").value);
	var tab = string.split(".");
	var len = tab.length;
	console.log(tab[len - 1]);
	if (tab[len - 1] == "png" || tab[len - 1] == "jpg" || tab[len - 1] == "jpeg"){
		console.log("yes");
	}
	else{
		console.log("no");
	}
	return 0;
}
