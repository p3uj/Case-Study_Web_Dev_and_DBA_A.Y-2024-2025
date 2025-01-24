// Filter search
// Get the value of the selected filter unit category
document.addEventListener("DOMContentLoaded", function () {
    var unitCategoryDropdown = document.getElementById("filter-unit-category"); // Get the element that has the id of 'filter-unit-category'
    var filterRentalPriceInput = document.getElementById('filter-rental-price'); // Get the element that has the id of 'filter-rental-price'

    unitCategoryDropdown.addEventListener("change", function () {
        var selectedOption = this.options[this.selectedIndex]; // Get the selected option
        var filterUnitCategoryValue = selectedOption.value; // Get the value of the selected option

        console.log("Selected filter unit category:", filterUnitCategoryValue);
    });

    // Get the value of the selected filter city
    document.querySelectorAll(".filter-city").forEach(function (dropdown) {
        dropdown.addEventListener("change", function () {
            var selectedOption = this.options[this.selectedIndex]; // Get the selected option
            var filterCityValue = selectedOption.value; // Get the value of the selected option

            console.log("Selected filter city:", filterCityValue);

            this.setAttribute("data-filter-city-value", filterCityValue);
        });
    });

    // Get the value of the filter rental price
    filterRentalPriceInput.addEventListener("input", function () {
        var filterRentalPriceValue = filterRentalPriceInput.value; // Get the value of the filter rental price

        console.log('filter rental price value:', filterRentalPriceValue);
    });
});
