document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById("search-btn");
    const searchOptions = document.getElementById("search-options");
    const ageSlider = document.getElementById("age-slider");
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

    // Updates the age slider's value accordingly
    ageSlider.addEventListener("input", function() {
        ageValue.textContent = ageSlider.value;
    });
    max_ageSlider.addEventListener("input", function() {
        max_ageValue.textContent = max_ageSlider.value;
    });
    
    
    
});

function loadUserDetails() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userDetails = JSON.parse(this.responseText); //  JSON data

            
            for (var i = 0; i < userDetails.length; i++) {
                
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");

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
        }
    };
    xhttp.open("GET", "home.php", true);
    xhttp.send();
}

document.addEventListener("DOMContentLoaded", function() {
    loadUserDetails();
});









