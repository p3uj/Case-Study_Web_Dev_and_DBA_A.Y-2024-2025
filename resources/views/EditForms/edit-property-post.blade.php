<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Property Post</title>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/edit-property-post.css') }}">

    @vite('resources/js/edit-dropdown.js')
</head>
<body>
    <x-navbar></x-navbar>

    <!-- Form -->
    <form id="form" action="{{ route('editpropertypost.post') }}" method="post">
        @csrf
        <div class="form-container">
            <!-- Close button with the correct route -->
            <a href="{{ route('user-profile') }}" class="close-btn" onclick="return confirm('Are you sure you want to leave? Any unsaved changes will be lost.')">&times;</a>

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
                <option value="Dormitories" {{ $post->unit_category == "Dormitories" ? 'selected' : '' }}>Dormitories</option>
                <option value="Studio Units" {{ $post->unit_category == "Studio Units" ? 'selected' : '' }}>Studio Units</option>
                <option value="Apartments" {{ $post->unit_category == "Apartments" ? 'selected' : '' }}>Apartments</option>
                <option value="Boarding Houses" {{ $post->unit_category == "Boarding Houses" ? 'selected' : '' }}>Boarding Houses</option>
                <option value="Other" {{ $post->unit_category == "Other" ? 'selected' : '' }}>Other</option>
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
                <option value="" disabled selected>Please select barangay</option>
            </select>
            
            <!-- Input Fields -->
            <input type="number" class="input-field" placeholder="Rental Price" id="rental-price" name="rental-price" value="{{ old('rental-price', $post->rental_price) }}">

            <input type="number" class="input-field" placeholder="Maximum Occupancy" id="max-occupancy" name="max-occupancy" value="{{ old('max-occupancy', $post->max_occupancy) }}">

            <textarea class="description" placeholder="Write a description" id="description" name="description">{{ $post->description }}</textarea>

            <button type="submit" class="save-btn" onclick="return confirm('Are you sure you want to save these changes?')">Save Changes</button>
        </div>
    </form>
</body>
</html>