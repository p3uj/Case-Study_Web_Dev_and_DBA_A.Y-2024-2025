document.addEventListener("DOMContentLoaded", () => {
    var barangayDropdown = document.getElementById("barangay"); // Get the barangay dropdown element
    var fetchBarangay = document.getElementById("barangay").getAttribute("data-fetch-barangay"); // Get the value of the data attribute 'data-fetch-barangay'

    const barangayList = JSON.parse(document.getElementById("barangay").dataset.barangayList); // Get barangay data from the dataset attribute

    // Find the cityCode of the barangay in the barangayList where the name or value matches fetchBarangay
    const cityCode = barangayList.find((b) => b.name === fetchBarangay).cityCode;

    // Store all the barangays that match the cityCode in the barangayList
    const barangaysForCityCode = barangayList.filter((b) => b.cityCode === cityCode);

    // Create the options for the barangay dropdown
    barangayDropdown.innerHTML = ''; // Clear the existing options

    // Add a default option
    let defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Select Barangay';
    defaultOption.disabled = true; // Disable the default option
    barangayDropdown.appendChild(defaultOption);

    // Loop through the filtered barangays and add them to the dropdown
    barangaysForCityCode.forEach((barangay) => {
        let option = document.createElement('option');
        option.value = barangay.name; // Set the value as the barangay name or id
        option.textContent = barangay.name; // Set the visible text as the barangay name
        barangayDropdown.appendChild(option);
    });

    // If there is a default barangay to be selected, set it
    if (fetchBarangay) {
        barangayDropdown.value = fetchBarangay;
    }

    // City dropdown
    document.getElementById("city").addEventListener("change", function () {
        var selectedOption = this.options[this.selectedIndex]; // Get the selected option
        var cityCode = selectedOption.id; // Get the city code from the selected option
        const barangayList = JSON.parse(
            document.getElementById("barangay").dataset.barangayList
        ); // Get barangay data from the dataset attribute

        console.log("Data type:", typeof barangayList);
        console.log("Barangay list:", barangayList);
        console.table(barangayList);
        console.log("Selected City Code:", cityCode); // For debugging

        // Set the data attribute for the city code on the city dropdown
        document.getElementById("city").setAttribute("data-city-code", cityCode);

        barangayDropdown.disabled = false; // Enable the barangay dropdown

        // Filter barangay list based on the cityCode
        var filteredBarangays = barangayList.filter(function (barangay) {
            return barangay.cityCode === cityCode; // Match barangays with the selected city code
        });

        // Select the filtered barangays based on the value of the fetchBarangay

        // Clear previous barangay options
        barangayDropdown.innerHTML = "";

        // Add a default "Select Barangay" option
        var defaultOption = document.createElement("option");
        defaultOption.text = "Please select barangay";
        defaultOption.value = ""; // Set the value as null
        defaultOption.disabled = true; // Disable the default option
        defaultOption.selected = true; // Make it the default selected option
        barangayDropdown.appendChild(defaultOption);

        // Populate barangay dropdown with filtered barangays
        filteredBarangays.forEach(function (barangay) {
            var option = document.createElement("option");
            option.value = barangay.name; // Set value to barangay name
            option.text = barangay.name; // Set the display text to barangay name
            barangayDropdown.appendChild(option);
        });

        // Update the hidden input field with the currently selected barangay value from the dropdown
        barangayDropdown.addEventListener("change", function () {
            var selectedBarangayOption = this.options[this.selectedIndex]; // Get the selected option
            console.log("barangay value:", selectedBarangayOption);
        });
    });
});
