// Filter search
// Get the value of the selected filter unit category
document.addEventListener("DOMContentLoaded", function () {
    var unitCategoryDropdown = document.getElementById('filter-unit-category'); // Get the element that has the id of 'filter-unit-category'
    var cityDropdown = document.querySelector('.filter-city');
    var filterRentalPriceInput = document.getElementById('filter-rental-price'); // Get the element that has the id of 'filter-rental-price'

    // Set the option of filter unit category dropdown based on the 'data-filter-unit-category' value
    unitCategoryDropdown.value = unitCategoryDropdown.getAttribute('data-filter-unit-category');

    // Reset the dropdown to the placeholder option if its value is null or empty
    if (!cityDropdown.value) {
        cityDropdown.selectedIndex = 0;  // Set to the first option which is the 'Select city'
    }

    // Set the option of filter city dropdown based on the 'data-filter-unit-category' value
    cityDropdown.value = cityDropdown.getAttribute('data-filter-city');

    // Set the option of filter rental price based on the 'data-filter-rental-price' value
    filterRentalPriceInput.value = filterRentalPriceInput.getAttribute('data-filter-rental-price');
});
