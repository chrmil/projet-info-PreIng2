document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById("search-btn");
    const searchOptions = document.getElementById("search-options");
    const ageSlider = document.getElementById("age-slider");
    const ageValue = document.getElementById("age-value");
    
     // show or hide reasearch options on click
    searchButton.addEventListener("click", function() {
        if (searchOptions.style.display === "none") {
            searchOptions.style.display = "block";
        } else {
            searchOptions.style.display = "none";
        }
    });

    // Updates the age slider's value accordingly
    ageSlider.addEventListener("input", function() {
        ageValue.textContent = ageSlider.value;
    });
    
    
    
});

function loadUserDetails() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userDetails = JSON.parse(this.responseText); // données JSON

            
            for (var i = 0; i < userDetails.length; i++) {
                
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                
                if (userNameElement) {
                    userNameElement.textContent = userDetails[i].nom || "Aucun nom disponible";
                }
                if (userAgeElement) {
                    userAgeElement.textContent = userDetails[i].age || "Aucun âge disponible";
                }
                if (userSexElement) {
                    userSexElement.textContent = userDetails[i].sex || "Aucun sex disponible";
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









