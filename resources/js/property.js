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


    const imageInput = document.getElementById('imageInput');
    const imagePreviewSection = document.getElementById('image-preview-section');

    let selectedFiles = []; // Array to hold selected files

    // Initially hide the image-preview-section
    imagePreviewSection.style.display = 'none';

    imageInput.addEventListener('change', function () {
        const files = Array.from(imageInput.files);
        selectedFiles = files; // Update the selected files array

        // If files are selected, show the preview section
        if (files.length > 0) {
            imagePreviewSection.style.display = 'flex';
        } else {
            imagePreviewSection.style.display = 'none';
        }

        imagePreviewSection.innerHTML = ''; // Clear previous previews
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function (event) {
                const previewDiv = document.createElement('div');
                previewDiv.classList.add('image-preview');

                const img = document.createElement('img');
                img.src = event.target.result;
                previewDiv.appendChild(img);

                // Create and add remove button
                const removeButton = document.createElement('button');
                removeButton.textContent = 'X';
                removeButton.classList.add('remove-button');
                previewDiv.appendChild(removeButton);

                // Remove the preview when the button is clicked
                removeButton.addEventListener('click', () => {
                    // Find and remove the file from the selectedFiles array
                    selectedFiles = selectedFiles.filter(f => f !== file);

                    // Rebuild the file input with the updated files array
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(f => dataTransfer.items.add(f));

                    imageInput.files = dataTransfer.files; // Update the file input

                    // Remove the preview from the DOM
                    previewDiv.remove();

                    // If no files left, hide the preview section
                    if (selectedFiles.length === 0) {
                        imagePreviewSection.style.display = 'none';
                    }
                });

                imagePreviewSection.appendChild(previewDiv);
            };
            reader.readAsDataURL(file); // Convert file to base64 URL
        });
    });
});
