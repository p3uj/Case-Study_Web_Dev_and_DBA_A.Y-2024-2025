document.addEventListener('DOMContentLoaded', function () {
    const tenantSearchBar = document.querySelector('#tenant-search-bar');
    const propertySearchBar = document.querySelector('#property-search-bar');
    
    const tenantList = document.querySelector('#tenant-list');
    const propertyList = document.querySelector('#property-list');

    const tenantNameDisplay = document.querySelector('#user-name');
    const propertyNameDisplay = document.querySelector('#property-name');

    let selectedTenant = null;
    let selectedProperty = null;

    // Function to filter tenants
    tenantSearchBar.addEventListener('input', function() {
        const searchTerm = tenantSearchBar.value.toLowerCase();
        const tenants = tenantList.querySelectorAll('.tenant-item');

        tenants.forEach(function(tenant) {
            const tenantName = tenant.querySelector('p').innerText.toLowerCase();
            tenant.style.display = tenantName.includes(searchTerm) ? 'block' : 'none';
        });
    });

    // Function to filter properties
    propertySearchBar.addEventListener('input', function() {
        const searchTerm = propertySearchBar.value.toLowerCase();
        const properties = propertyList.querySelectorAll('.tenant-item');

        properties.forEach(function(property) {
            const propertyName = property.querySelector('p').innerText.toLowerCase();
            property.style.display = propertyName.includes(searchTerm) ? 'block' : 'none';
        });
    });

    // Event delegation for tenant selection
    tenantList.addEventListener('click', function(event) {
        if (event.target && event.target.matches('.select-tenant-btn')) {
            selectedTenant = {
                id: event.target.getAttribute('data-tenant-id'),
                name: event.target.getAttribute('data-tenant-name')
            };
            tenantNameDisplay.innerHTML = 'User: ' + selectedTenant.name;
        }
    });

    // Event delegation for property selection
    propertyList.addEventListener('click', function(event) {
        if (event.target && event.target.matches('.select-property-btn')) {
            selectedProperty = {
                id: event.target.getAttribute('data-property-id'),
                name: event.target.getAttribute('data-property-name')
            };
            propertyNameDisplay.innerHTML = 'Property: ' + selectedProperty.name;
        }
    });

    // Submit button click event
    document.querySelector('#submit-btn').addEventListener('click', function() {
        const tenantId = selectedTenant?.id;
        const propertyId = selectedProperty?.id;
    
        // Ensure tenant and property are selected
        if (!tenantId || !propertyId) {
            alert('Please select both a tenant and a property.');
            return;
        }
    
        // Send AJAX request to submit the reviews
        fetch('/submit-review', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                tenantId: tenantId,
                propertyId: propertyId
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });    
});
