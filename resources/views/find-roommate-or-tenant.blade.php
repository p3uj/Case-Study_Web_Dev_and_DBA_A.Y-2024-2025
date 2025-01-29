<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Roommate/Tenant</title>

    @vite('resources/css/find-roommate-or-tenant.css')
    @vite('resources/js/property.js')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="tenant-roommate-search-container">
        <div popover id="create-post-popover">
            <h3>Post a {{ $user->role === 'Tenant' ? 'Roommate' : 'Tenant'}} Search</h3>

            <!-- Form -->
            <form id="form" action="{{ route("findroommateortenant.post") }}" method="post">
                @csrf
                <div class="form-container">
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

                    <!-- input -->
                    <textarea class="description" placeholder="Write a description" id="description" name="description" required></textarea>

                    <button class="post-btn">Post</button>
                </div>
            </form>
        </div>

        <button id="create-a-post-btn" class="create-a-post-btn" popovertarget="create-post-popover" data-user-role="">
            Create a post
        </button>
    </div>

    <div class="find-roommate-tenant-content">
        @if (!empty($posts))
            @foreach ($posts as $post)
                <div class="find-roommate-tenant-container" data-user-id="{{ $post->user_id }}">
                    <div class="user-profile">
                        @if (asset('resources/images/' . $post->profile_photo_path) == asset('resources/images/sampleProfile.png'))
                            <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                        @else
                            <img src="{{ asset('storage/uploads/images/profile-pictures/' . $post->profile_photo_path) }}" alt="Profile Picture">
                        @endif
                    </div>
                    <h4>{{ $post->UserName }}</h4>
                    <p class="location">
                        <img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="Location Icon" style="width: 16px; height: 16px; opacity: 0.5">
                        {{ $post->barangay }}, {{ $post->city }}
                    </p>
                    <p class="date-posted">{{ $post->updated_at }}</p><br>
                    <div class="caption">
                        <p>{{ $post->description }}</p>
                    </div><br>
                    <h4 class="category-finding">Finding {{ $post->search_categories }}</h4>
                </div>
            @endforeach
        @else
            <div style="margin-top: 16px;">
                <h1>No Searching Posts!</h1>
            </div>
        @endif
    </div>
</body>
</html>
