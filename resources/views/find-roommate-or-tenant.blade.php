<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Roommate/Tenant</title>

    @vite('resources/css/find-roommate-or-tenant.css')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="tenant-roommate-search-container">
        <div popover id="create-post-popover">
            <h3>Post a {{ $user->role === 'Tenant' ? 'Roommate' : 'Tenant'}} Search</h3>

            <!-- Form -->
            <form action="" method="post">
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
                    <select name="barangay" id="barangay" required>
                        <!-- This dropdown should be dynamic based on the selected option in the city.
                            You can use this for API call to get the barangays based on the id(stored as cityCode) of selected option in the city.
                            https://psgc.gitlab.io/api/cities/{cityCode}/barangays/
                        -->
                        <option value="" disabled selected>Please select barangay</option>
                        <option value="{value of barangay}">{Value of Barangay}</option>
                    </select>

                    <!-- input -->
                    <textarea class="description" placeholder="Write a description" id="description" name="description" required></textarea>

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
