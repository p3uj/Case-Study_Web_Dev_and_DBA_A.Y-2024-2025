<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review Page</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
    @vite('resources/css/add-review.css')

</head>
<body>
    <x-navbar></x-navbar>

    <div class="container">
        <!-- Close Button Container (placed below navbar) -->
        <div class="close-btn-container">
            <button class="close-btn" onclick="window.history.back()">x</button>
        </div>

        <!-- Middle Container with two columns -->
        <div class="s-container">
            <div class="search-container">
                <input type="text" class="search-bar" id="tenant-search-bar" placeholder="Search Tenant...">
                <div class="tenant-list" id="tenant-list">
                    @foreach ($tenants as $tenant)
                        <div class="tenant-item" id="tenant-item">
                            <div class="tenant-image">
                                <img src="{{ asset('storage/uploads/images/profile-pictures/' . $tenant->profile_photo_path) }}" alt="Tenant Image">
                            </div>
                            <div class="tenant">
                                <p>{{ $tenant->firstname }} {{ $tenant->lastname }}</p>
                                <button>+</button>
                            </div>                        
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="search-container">
                <input type="text" class="search-bar" id="property-search-bar" placeholder="Search Property...">
                <div class="tenant-list" id="property-list">
                    @foreach ($properties as $property)
                        <div class="tenant-item" id="property-item">
                            <div class="tenant-image">
                                <img src="{{ asset('storage/uploads/images/property-posts/' . $property->FirstPhoto) }}" alt="Tenant Image">
                            </div>
                            <div class="tenant">
                                <p>{{ $property->city }}, {{ $property->barangay }}</p>
                                <button>+</button>
                            </div>                        
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Submit Button Container -->
        <div class="submit-btn-container">
            <button class="submit-btn">Submit</button>
        </div>
    </div>
</body>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const tenantSearchBar = document.querySelector('#tenant-search-bar');
            const propertySearchBar = document.querySelector('#property-search-bar');
            
            const tenantList = document.querySelector('#tenant-list');
            const propertyList = document.querySelector('#property-list');

            // Function to filter tenants
            tenantSearchBar.addEventListener('input', function() {
                const searchTerm = tenantSearchBar.value.toLowerCase();
                const tenants = tenantList.querySelectorAll('#tenant-item');

                tenants.forEach(function(tenant) {
                    const tenantName = tenant.querySelector('p').innerText.toLowerCase();
                    if (tenantName.includes(searchTerm)) {
                        tenant.style.display = 'block'; // Show tenant item
                    } else {
                        tenant.style.display = 'none'; // Hide tenant item
                    }
                });
            });

            // Function to filter properties
            propertySearchBar.addEventListener('input', function() {
                const searchTerm = propertySearchBar.value.toLowerCase();
                const properties = propertyList.querySelectorAll('#property-item');

                properties.forEach(function(property) {
                    const propertyName = property.querySelector('p').innerText.toLowerCase();
                    if (propertyName.includes(searchTerm)) {
                        property.style.display = 'block'; // Show property item
                    } else {
                        property.style.display = 'none'; // Hide property item
                    }
                });
            });
        });
    </script>

</html>
