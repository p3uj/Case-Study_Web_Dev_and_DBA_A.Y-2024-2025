document.addEventListener('DOMContentLoaded', function () {
    const tenantSearchBar = document.querySelector('#tenant-search-bar');
    const propertySearchBar = document.querySelector('#property-search-bar');
    
    const tenantList = document.querySelector('#tenant-list');
    const propertyList = document.querySelector('#property-list');

    const tenantNameDisplay = document.querySelector('#user-name');
    const propertyNameDisplay = document.querySelector('#property-name');

    const tenantIdInput = document.getElementById('tenant_id'); // Hidden input for tenant ID
    const propertyIdInput = document.getElementById('property_id'); // Hidden input for property ID

    const submitBtn = document.getElementById('submit-btn');
    const form = document.getElementById('add-review-form');

    let selectedTenant = null;
    let selectedProperty = null;

    // Function to filter tenants
    tenantSearchBar.addEventListener('input', function () {
        const searchTerm = tenantSearchBar.value.toLowerCase();
        const tenants = tenantList.querySelectorAll('.tenant-item');

        tenants.forEach(function (tenant) {
            const tenantName = tenant.querySelector('p').innerText.toLowerCase();
            tenant.style.display = tenantName.includes(searchTerm) ? 'block' : 'none';
        });
    });

    // Function to filter properties
    propertySearchBar.addEventListener('input', function () {
        const searchTerm = propertySearchBar.value.toLowerCase();
        const properties = propertyList.querySelectorAll('.tenant-item');

        properties.forEach(function (property) {
            const propertyName = property.querySelector('p').innerText.toLowerCase();
            property.style.display = propertyName.includes(searchTerm) ? 'block' : 'none';
        });
    });

    // Event delegation for tenant selection
    tenantList.addEventListener('click', function (event) {
        if (event.target && event.target.matches('.select-tenant-btn')) {
            selectedTenant = {
                id: event.target.getAttribute('data-tenant-id'),
                name: event.target.getAttribute('data-tenant-name')
            };
            tenantIdInput.value = selectedTenant.id; // Update hidden input for tenant
            tenantNameDisplay.innerHTML = 'User: ' + selectedTenant.name; // Update UI
        }
    });

    // Event delegation for property selection
    propertyList.addEventListener('click', function (event) {
        if (event.target && event.target.matches('.select-property-btn')) {
            selectedProperty = {
                id: event.target.getAttribute('data-property-id'),
                name: event.target.getAttribute('data-property-name')
            };
            propertyIdInput.value = selectedProperty.id; // Update hidden input for property
            propertyNameDisplay.innerHTML = 'Property: ' + selectedProperty.name; // Update UI
        }
    });

    // Handling the Submit Button Click (Check if both tenant and property are selected)
    submitBtn.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent form from submitting immediately

        // Log values of tenant and property IDs
        console.log(tenantIdInput.value, propertyIdInput.value);
        
        // Check if both tenant and property are selected
        if (!selectedTenant || !selectedProperty) {
            alert('Please select both a tenant and a property before submitting.');
            return; // Stop submission if not both are selected
        }

        // Ask for confirmation before submitting
        const confirmation = confirm('Rent the property?');
        if (confirmation) {
            form.submit(); // Submit the form if user confirms
        }
    });
});