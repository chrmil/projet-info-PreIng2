document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById("search-btn");
    const searchOptions = document.getElementById("search-options");

     // show or hide reasearch options on click
    searchButton.addEventListener("click", function() {
        if (searchOptions.style.display === "none") {
            searchOptions.style.display = "block";
        } else {
            searchOptions.style.display = "none";
        }
    });

});

function loadUserDetails() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userDetails = JSON.parse(this.responseText); //  JSON data

            
            for (var i = 0; i < userDetails.length; i++) {
                var card = document.getElementById("card-" + (i + 1));
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");
                var userImage = document.getElementById("image-" + (i + 1));
                
                if(userDetails[i].color!="empty" && card){
                    card.setAttribute("class", "grid-individual-card card-background-"+userDetails[i].color);
                }
                if(userDetails[i].starter!="empty" && userImage){
                    userImage.setAttribute("src", "https://heatherketten.files.wordpress.com/2018/03/"+userDetails[i].starter+".png");
                }
                else if(userImage){
                    userImage.setAttribute("src", "https://heatherketten.files.wordpress.com/2018/03/pikachu.png");
                }
                if (userNameElement) {
                    userNameElement.textContent = userDetails[i].nom || "No name available";
                }
                if (userAgeElement) {
                    userAgeElement.textContent = userDetails[i].age || "No age available";
                }
                if (userSexElement) {
                    userSexElement.textContent = userDetails[i].sex || "No gender available";
                }
                if (userTypeElement) {
                    userTypeElement.textContent = userDetails[i].type || "No type available";
                }
            }

            for (var i = 0; i <10; i++) {
                var card = document.getElementById("card-" + (i + 1));
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");

                if ( userNameElement.textContent == "empty") {
                    card.style.visibility = "hidden";
                }
            }
        }
    };
    xhttp.open("GET", "home.php", true);
    xhttp.send();
}

document.addEventListener("DOMContentLoaded", function() {
    loadUserDetails();
    usernav();
    chatnav();
});

function usernav(){
    var userlink= document.getElementById("nav-user");
 
    userlink.addEventListener("click",  function(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href=this.response;
        }
       
    } 
    xhttp.open("GET", "userlink.php", true);
    xhttp.send();
 
    } );   
}

function chatnav(){
    var chatlink= document.getElementById("nav-chat");
    chatlink.addEventListener("click",  function(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("nav-chat").setAttribute("href",this.responseURL);
        }
        
    }
    xhttp.open("GET", "chatlink.php", true);
    xhttp.send();
 
    } );
}






