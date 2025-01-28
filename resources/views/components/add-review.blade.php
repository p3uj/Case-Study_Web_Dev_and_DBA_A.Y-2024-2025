<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Review Page</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
    @vite('resources/css/add-review.css')
    @vite('resources/js/add-review.js')

</head>
<body>
    <x-navbar></x-navbar>

    <div class="container">
        <!-- Close Button Container (placed below navbar) -->
        <div class="close-btn-container">
            <p id="user-name">User: </p>
            <p id="property-name" style="margin-left: 70px;">Property: </p>
            <a class="close-btn" href="{{ route('userprofilepage') }}">x</a>
        </div>
        <form class="form" id="add-review-form" method="POST" action="{{ route('submit.review') }}">
            @csrf
            <!-- Middle Container with two columns -->
            <div class="s-container">
                <div class="search-container">
                    <input type="text" class="search-bar" id="tenant-search-bar" placeholder="Search Tenant...">
                    <div class="tenant-list" id="tenant-list">
                        @foreach ($tenants as $tenant)
                            <div class="tenant-item" id="tenant-item">
                                <div class="tenant-image">
                                @if ($tenant->profile_photo_path == asset('resources/images/sampleProfile.png'))
                                    <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/uploads/images/profile-pictures/' . $tenant->profile_photo_path) }}" alt="Tenant Image">
                                @endif
                                </div>
                                <div class="tenant">
                                    <p>{{ $tenant->firstname }} {{ $tenant->lastname }}</p>
                                    <button type="button"
                                            class="select-tenant-btn" 
                                            data-tenant-id="{{ $tenant->id }}" 
                                            data-tenant-name="{{ $tenant->firstname }} {{ $tenant->lastname }}">
                                        +
                                    </button>
                                </div>                        
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="search-container">
                    <input type="text" class="search-bar" id="property-search-bar" placeholder="Search Property...">
                    <div class="tenant-list" id="property-list">
                        @foreach ($properties as $property)
                            <div class="tenant-item" id="property-item">
                                <div class="tenant-image">
                                    <img src="{{ asset('storage/uploads/images/property-posts/' . $property->FirstPhoto) }}" alt="Tenant Image">
                                </div>
                                <div class="tenant">
                                    <p>{{ $property->city }}, {{ $property->barangay }}</p>
                                    <button type="button"
                                            class="select-property-btn" 
                                            data-property-id="{{ $property->id }}" 
                                            data-property-name="{{ $property->city }} {{ $property->barangay }}">
                                        +
                                    </button>
                                </div>                        
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Hidden Inputs to Store Selected IDs -->
            <input type="hidden" name="tenant_id" id="tenant_id">
            <input type="hidden" name="property_id" id="property_id">

            <!-- Submit Button Container -->
            <div class="submit-btn-container">
                <button type="submit" class="submit-btn" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
