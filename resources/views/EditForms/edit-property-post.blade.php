<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Property Post</title>

    @vite('resources/js/edit-dropdown.js')
</head>
<body>
    <x-navbar></x-navbar>

    <!-- Form -->
    <form id="form" action="{{ route('editpropertypost.post') }}" method="post">
        @csrf
        <div class="form-container">
            <!-- Hidden input to hold the id for the server side -->
            <input type="hidden" name="property-post-id" value="{{ $propertyPostId }}">
            <input type="hidden" name="property-info-id" value="{{ $propertyInfoId }}">

            <!-- Fetch values from the database -->
            <select hidden name="default-unit-category" id="">
                <option value="{{ $post->unit_category }}" selected></option>
            </select>
            <select hidden name="default-city" id="">
                <option value="{{ $post->city }}" selected></option>
            </select>
            <select hidden name="default-barangay" id="">
                <option value="{{ $post->barangay }}" selected></option>
            </select>
            <input type="hidden" name="default-rental-price" value="{{ $post->rental_price }}">
            <input type="hidden" name="defualt-max-occupancy" value="{{ $post->max_occupancy }}">
            <textarea hidden name="default-description">{{ $post->description }}</textarea>

            <!-- Unit Category Dropdown Box -->
            <select name="unit-category" id="unit-category" required>
                <option value="" disabled selected>Please select a unit category</option>
                <option value="Dormitories" {{ $post->unit_category == "Dormitories"}} ? @selected(true) : @selected(false)>Dormitories</option>
                <option value="Studio Units" {{ $post->unit_category == "Studio Units"}} ? @selected(true) : @selected(false)>Studio Units</option>
                <option value="Apartments" {{ $post->unit_category == "Apartments"}} ? @selected(true) : @selected(false)>Apartments</option>
                <option value="Boarding Houses" {{ $post->unit_category == "Boarding Houses"}} ? @selected(true) : @selected(false)>Boarding Houses</option>
                <option value="Other" {{ $post->unit_category == "Other"}} ? @selected(true) : @selected(false)>Other</option>
            </select>

            <!-- City Dropdown Box -->
            <select name="city" id="city" data-city-list="{{ json_encode($cities) }}">
                <option value="" disabled selected>Please select city</option>
                @foreach ($cities as $city)
                    <option id="{{ $city['code'] }}" value="{{ $city['name'] }}"
                        {{ $city['name'] === $post->city ? 'selected' : '' }}>
                        {{ $city['name'] }}
                    </option>
                @endforeach
            </select>

            <!-- Hidden input to hold the barangay list for default -->
            <input type="hidden" id="default-barangay-list" data-default-barangay="">

            <!-- Barangay Dropdown Box -->
            <select name="barangay" id="barangay" data-barangay-list="{{ json_encode($barangays) }}"
                data-fetch-barangay="{{ $post->barangay }}">
                <!-- This dropdown should be dynamic based on the selected option in the city.
                            You can use this for API call to get the barangays based on the id(stored as cityCode) of selected option in the city.
                            https://psgc.gitlab.io/api/cities/{cityCode}/barangays/
                        -->
                <option value="" disabled selected>Please select barangay</option>
                <!-- Barangay options will be populated by property.js  -->
            </select>

            <!-- Input Fields -->
            <input type="number" placeholder="Rental Price" id="rental-price" name="rental-price" value="{{ $post->rental_price }}">
            <input type="number" placeholder="Maximum Occupancy" id="max-occupancy" name="max-occupancy" value="{{ $post->max_occupancy }}">
            <textarea class="description" placeholder="Write a description" id="description" name="description">{{ $post->description }}</textarea>

            <button class="post-btn">Post</button>
        </div>
    </form>
</body>
</html>
