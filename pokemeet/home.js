document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById("search-btn");
    const searchOptions = document.getElementById("search-options");
    const ageValue = document.getElementById("age-value");
    const max_ageSlider = document.getElementById("max-age-slider");
    const max_ageValue = document.getElementById("max-age-value");
    
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
});









