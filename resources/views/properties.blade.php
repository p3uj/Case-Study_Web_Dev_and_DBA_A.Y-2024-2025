
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/properties.css')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="properties-container">
        <h1>Properties Page</h1>

        <div popover id="create-post-popover">
            <h5>Create a Property Post</h5>

            <!-- Form -->
            <form action="" method="post">
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
                    <select data-live-search="true" name="city" id="city" required>
                        <option value="" disabled selected>Please select city</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                        @endforeach
                    </select>

                    <!-- Barangay Dropdown Box -->
                    <select name="barangay" id="barangay" required>
                        <!-- The value of option should be dynamic.
                            This dropdown should be disable until the city has a value.
                        -->
                        <option value="" disabled selected>Please select barangay</option>
                        {{-- @foreach ($barangays as $barangay) --}}
                            {{-- <option value="{{ $barangay['name'] }}">{{ $barangay['name'] }}</option> --}}
                        {{-- @endforeach --}}
                    </select>

                    <!-- input -->
                    <input type="number" placeholder="Rental Price" id="rental-price" name="rental-price" required>
                    <input type="number" placeholder="Maximum of Occupancy" id="max-occupancy" name="max-occupancy" required>
                    <input type="text" placeholder="Write a description" id="description" name="description" required>

                    <button>Add all photos</button>
                    <button class="post-btn">Post</button>
                </div>
            </form>
        </div>

        <button popovertarget="create-post-popover">
            Create a post
        </button>
    </div>
</body>
</html>
