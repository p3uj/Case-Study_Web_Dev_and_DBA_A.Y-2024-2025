document.addEventListener('DOMContentLoaded', () => {
    var barangayDropdown = document.getElementById('barangay'); // Get the barangay dropdown element
    barangayDropdown.disabled = true; // Disable the barangay dropdown initially
    const form = document.getElementById('form');

    document.getElementById('city').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];  // Get the selected option
        var cityCode = selectedOption.id;  // Get the city code from the selected option
        const barangayList = JSON.parse(document.getElementById('barangay').dataset.barangayList);  // Get barangay data from the dataset attribute

        console.log('Data type:', typeof barangayList);
        console.log('Barangay list:', barangayList);
        console.table(barangayList);

        console.log("Selected City Code:", cityCode);  // For debugging

        // Set the data attribute for the city code on the city dropdown
        document.getElementById('city').setAttribute('data-city-code', cityCode);

        barangayDropdown.disabled = false; // Enable the barangay dropdown

        // Filter barangay list based on the cityCode
        var filteredBarangays = barangayList.filter(function (barangay) {
            return barangay.cityCode === cityCode;  // Match barangays with the selected city code
        });

        // Clear previous barangay options
        barangayDropdown.innerHTML = '';

        // Add a default "Select Barangay" option
        var defaultOption = document.createElement('option');
        defaultOption.text = 'Please select barangay';
        defaultOption.value = ""; // Set the value as null
        defaultOption.disabled = true;  // Disable the default option
        defaultOption.selected = true;  // Make it the default selected option
        barangayDropdown.appendChild(defaultOption);

        // Populate barangay dropdown with filtered barangays
        filteredBarangays.forEach(function (barangay) {
            var option = document.createElement('option');
            option.value = barangay.name;  // Set value to barangay name
            option.text = barangay.name;  // Set the display text to barangay name
            barangayDropdown.appendChild(option);
        });

        // Update the hidden input field with the currently selected barangay value from the dropdown
        barangayDropdown.addEventListener('change', function () {
            var selectedBarangayOption = this.options[this.selectedIndex];  // Get the selected option

            console.log('barangay value:', selectedBarangayOption)
        });

        // Check the barangay dropdown if the value is null
        form.addEventListener('submit', function (event) {
            if (barangayDropdown.value === "") {
                event.preventDefault(); // Prevent form submission
            }
        });
    });
});
