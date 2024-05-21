document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById("search-btn");
    const searchOptions = document.getElementById("search-options");
    const ageSlider = document.getElementById("age-slider");
    const ageValue = document.getElementById("age-value");
    
     // Affiche ou masque les options de recherche lorsque le bouton est cliqué
    searchButton.addEventListener("click", function() {
        if (searchOptions.style.display === "none") {
            searchOptions.style.display = "block";
        } else {
            searchOptions.style.display = "none";
        }
    });

    // Met à jour la valeur de l'âge affichée lorsque la position du slider change
    ageSlider.addEventListener("input", function() {
        ageValue.textContent = ageSlider.value;
    });
    
    
    
});




