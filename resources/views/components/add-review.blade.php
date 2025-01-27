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
                <input type="text" class="search-bar" placeholder="Search Tenant...">
                <div class="tenant-list">
                    @foreach ($tenants as $tenant)
                        <div class="tenant-item">
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
                <input type="text" class="search-bar" placeholder="Search Property...">
            </div>
        </div>

        <!-- Submit Button Container -->
        <div class="submit-btn-container">
            <button class="submit-btn">Submit</button>
        </div>
    </div>
</body>
</html>
