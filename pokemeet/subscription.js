document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("div_sub").innerHTML="Subscribe to our site for 5$ per month or 30$ per year and gain access to the chat !";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("div_sub").innerHTML=this.responseText;
        } 
    } 
    xhttp.open("GET", "subscribe.php", true);   
    xhttp.send(); 
});
