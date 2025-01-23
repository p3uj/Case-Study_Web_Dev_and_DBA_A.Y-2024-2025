
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/properties.css')
    @vite('resources/js/property.js')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="properties-container">
        <div popover id="create-post-popover">
            <h3>Create a Property Post</h3>

            <!-- Form -->
            <form id="form" action="{{ route("property.post") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-container">
                    <!-- Unit Category Dropdown Box -->
                    <select name="unit-category" id="unit-category" required>
                        <option value="" disabled selected>Please select a unit category</option>
                        <option value="Dormitories">Dormitories</option>
                        <option value="Studio Units">Studio Units</option>
                        <option value="Apartments">Apartments</option>
                        <option value="Boarding Houses">Boarding Houses</option>
                        <option value="Other">Other</option>
                    </select>

                    <!-- City Dropdown Box -->
                    <select name="city" id="city" data-city-code="" required>
                        <option value="" disabled selected>Please select city</option>
                        @foreach ($cities as $city)
                            <option id="{{ $city['code'] }}"
                                value="{{ $city['name'] }}">
                                {{ $city['name'] }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Barangay Dropdown Box -->
                    <select name="barangay" id="barangay" data-barangay-list="{{ json_encode($barangays) }}" required>
                        <option value="" disabled selected>Please select barangay</option>
                        <!-- Barangay options will be populated by property.js -->
                    </select>

                    <!-- Input fields -->
                    <input type="number" placeholder="Rental Price" id="rental-price" name="rental-price" required>
                    <input type="number" placeholder="Maximum Occupancy" id="max-occupancy" name="max-occupancy" required>
                    <textarea class="description" placeholder="Write a description" id="description" name="description" required></textarea>

                    <!-- Image Upload Section (Initially Hidden) -->
                    <div id="image-upload-section">
                        <input type="file" name="images[]" id="imageInput" multiple accept="image/*">
                    </div>
                    <div id="image-preview-section"></div>

                    <!-- Post Button -->
                    <button type="submit" class="post-btn">Post</button>
                </div>
            </form>
        </div>

        <!-- Filter search -->
        <div class="filter-search-box">
            <div class="filter-search">Filter Search</div>
            <!-- Unit Category Dropdown Box -->
            <select class="property-unit-category" name="propety-unit-category" id="">
                <option value="">Dormitories</option>
                <option value="">Studio Units</option>
                <option value="">Apartments</option>
                <option value="">Boarding Houses</option>
                <option value="">Other</option>
            </select>

            <!-- Use city-dropdown component and pass the value of $cities -->
            <x-city-dropdown :cities="$cities"></x-city-dropdown>

            <!-- Rental Price -->
            <input class="budget-price" type="number" placeholder="Budget price" id="rental-price" name="rental-price">
        </div>

        <!-- Create Post Button -->
        <button class="create-a-post-btn" popovertarget="create-post-popover">
            Create a post
        </button>
    </div>

    <div class="container">
        <!-- Dormitory content -->
        <div class="property-post-content">
            <div class="property-post-container">
                <img class="property-post-image" src="{{ Vite::asset('resources/images/propertysample/property1.png') }}" alt="Property Post Image">
                <h3><img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="Location Icon" style="width: 16px; height: 16px;">
                    <span class="location">Holy Spirit, Quezon City</span>
                </h3>
                <p class="property-post-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse hic eius ad nulla unde consequuntur ea, minima non dolor recusandae distinctio qui quibusdam ipsum sapiente corrupti odit nesciunt voluptatibus tenetur!
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab rerum neque a sint aliquam alias obcaecati tenetur vel nostrum error, consequatur modi ipsum nemo ut amet pariatur eum, excepturi vero?
                </p>
                <h2 class="unit-price">₱5,0000 <span class="per-month">/month</span></h2>
                <div class="bottom-part">
                    <div class="user-profile">
                        <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                        {{-- Do Kyung-Soo --}}
                        <span class="user-name">Do Kyung-Soo</span>
                    </div>
                    <a>See more</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
