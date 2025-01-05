document.getElementById('city').addEventListener('change', function () {
    var selectedOption = this.options[this.selectedIndex];  // Get the index of the selected option.
    var cityCode = selectedOption.id;   // Get the id of the selected option.

    console.log("Selected City Code:", cityCode);  // For debugging

    // Set the data attribute of the data-city-code to the value of cityCode variable.
    document.getElementById('city').setAttribute('data-city-code', cityCode);
});
