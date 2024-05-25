
function logout(){
   var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            document.getElementById("div1").innerHTML =this.responseText ;
        }
    };  
    xhttp.open("GET", "logout.php", true);
    xhttp.send();
   
}