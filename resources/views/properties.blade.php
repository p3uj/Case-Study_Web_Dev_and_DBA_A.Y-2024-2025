
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
            <form id="form" action="" method="post">
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
                        <!-- This dropdown should be dynamic based on the selected option in the city.
                            You can use this for API call to get the barangays based on the id(stored as cityCode) of selected option in the city.
                            https://psgc.gitlab.io/api/cities/{cityCode}/barangays/
                        -->

                        <option value="" disabled selected>Please select barangay</option>
                        <!-- Barangay options will be populated by property.js  -->
                    </select>

                    <!-- Hidden input to store the selected barangay -->
                    <input type="hidden" id="selected-barangay" name="selected-barangay" value="" />

                    <!-- input -->
                    <input type="number" placeholder="Rental Price" id="rental-price" name="rental-price" required>
                    <input type="number" placeholder="Maximum Occupancy" id="max-occupancy" name="max-occupancy" required>
                    <textarea class="description" placeholder="Write a description" id="description" name="description" required></textarea>

                    <button class="add-photos-btn">Add all photos</button>
                    <button class="post-btn">Post</button>
                </div>
            </form>
        </div>

        <button class="create-a-post-btn" popovertarget="create-post-popover">
            Create a post
        </button>
    </div>
</body>
</html>
