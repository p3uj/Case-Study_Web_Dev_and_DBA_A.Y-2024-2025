<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Searching Post</title>

    @vite('resources/css/edit-profile.css')
    @vite('resources/js/edit-dropdown.js')
    @vite('resources/js/edit-profile.js')
</head>
<body>
    <x-navbar></x-navbar>

    <!-- Form -->
    <form id="form" action="{{ route('editprofilepage.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ route('user-profile') }}">

        <div class="form-container">
            <!-- Close button -->
            <a href="{{ route('user-profile') }}" class="close-btn"
               onclick="return confirm('Are you sure you want to leave? Any unsaved changes will be lost?')">&times;</a>

            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="default-firstname" value="{{ $userInfo->firstname }}">
            <input type="hidden" name="default-lastname" value="{{ $userInfo->lastname }}">
            <input type="hidden" name="default-profile-photo-path" value="{{ $userInfo->profile_photo_path }}">
            <select hidden name="default-city" id="">
                <option value="{{ $userInfo->city }}" selected></option>
            </select>
            <textarea hidden name="default-bio">{{ $userInfo->bio }}</textarea>

            <!-- Profile Section (Centered Profile Picture & File Upload) -->
            <div class="profile-section">
                <div class="profile-picture">
                    <img id="profilePreview"
                    src="{{ asset('resources/images/' . $userInfo->profile_photo_path) == asset('resources/images/sampleProfile.png')
                    ? Vite::asset('resources/images/sampleProfile.png')
                    : asset('storage/uploads/images/profile-pictures/' . $userInfo->profile_photo_path) }}"
                    alt="Profile Picture">
                </div>

                <!-- Hidden File Input with Custom Button -->
                <input type="file" class="file-input" id="image" name="profile-photo-path" accept="image/*">
                <label for="image" class="file-label">Choose File</label>
            </div>

            <!-- Input fields -->
            <input type="text" class="input-field" name="firstname" id="firstname" placeholder="Type your firstname" value="{{ $userInfo->firstname }}">
            <input type="text" class="input-field" name="lastname" id="lastname" placeholder="Type your lastname" value="{{ $userInfo->lastname }}">

            <!-- City Dropdown Box -->
            <select class="input-field" name="city" id="city" data-city-list="{{ json_encode($cities) }}">
                <option value="" disabled selected>Please select city</option>
                @foreach ($cities as $city)
                    <option id="{{ $city['code'] }}" value="{{ $city['name'] }}"
                        {{ $city['name'] === $userInfo->city ? 'selected' : '' }}>
                        {{ $city['name'] }}
                    </option>
                @endforeach
            </select>

            <!-- Bio Textarea -->
            <textarea class="input-field bio" placeholder="Write a Bio" id="bio" name="bio">{{ $userInfo->bio }}</textarea>

            <button type="submit" class="save-btn"
                    onclick="return confirm('Are you sure you want to save these changes?')">Save Changes</button>
        </div>
    </form>
</body>
</html>
