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

function loadUsers(){
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("profiles").innerHTML =this.responseText ;
        }
    };  
    document.getElementById("profiles").innerHTML = "";
    xhttp.open("GET", "home.php", true);
    
   
    xhttp.send();
}



