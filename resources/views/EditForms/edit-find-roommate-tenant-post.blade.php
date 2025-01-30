<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Searching Post</title>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/edit-find-roommate-tenant.css') }}">

    @vite('resources/js/edit-dropdown.js')
</head>
<body>
    <x-navbar></x-navbar>

    <!-- Form -->
    <form id="form" action="{{ route('editsearchpost.post') }}" method="post">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ route('user-profile') }}">
        <div class="form-container">
            <!-- Close button -->
            <a href="{{ route('user-profile') }}" class="close-btn" onclick="return confirm('Are you sure you want to leave? Any unsaved changes will be lost.')">&times;</a>

            <!-- Rest of your form remains the same -->
            <input type="hidden" name="id" value="{{ $id }}">

            <select hidden name="default-city" id="">
                <option value="{{ $post->city }}" selected></option>
            </select>
            <select hidden name="default-barangay" id="">
                <option value="{{ $post->barangay }}" selected></option>
            </select>
            <textarea hidden name="default-description">{{ $post->description }}</textarea>

            <!-- City Dropdown Box -->
            <p>City:</p>
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
            <p>Barangay:</p>
            <select name="barangay" id="barangay" data-barangay-list="{{ json_encode($barangays) }}"
                data-fetch-barangay="{{ $post->barangay }}">
                <option value="" disabled selected>Please select barangay</option>
            </select>

            <!-- Description Textarea -->
            <p>Description:</p>
            <textarea class="description" placeholder="Write a description" id="description" name="description">{{ $post->description }}</textarea>

            <button type="submit" class="save-btn" onclick="return confirm('Are you sure you want to save these changes?')">Save Changes</button>
        </div>
    </form>
</body>
</html>
