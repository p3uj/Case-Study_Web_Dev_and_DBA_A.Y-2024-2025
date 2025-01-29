<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Tabs</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
    @vite('resources/css/review.css')
    @vite('resources/js/review.js')
    @vite('resources/css/write-review.css')
    @vite('resources/js/write-review.js')


    <!-- Font Awesome Icon Library -->
    <script src="https://kit.fontawesome.com/87abdb3ce2.js" crossorigin="anonymous"></script>
</head>
<body>
    <x-navbar></x-navbar>
    <div class="container">
        <!-- Tab Navigation -->
        <div class="tab-box">
            <button class="tab-btn active" data-tab="to-review">To Review</button>
            <button class="tab-btn" data-tab="my-reviews">My Reviews</button>
        </div>

        <!-- Tab Content (To Review)-->
        <div class="tab-content active" id="to-review">
            @if (!empty($toReview))
                @if ($userRole == "Tenant")
                    @foreach ($toReview as $property)
                        <div id="property-post" class="to-review-content">
                            <img src="{{ asset('storage/uploads/images/property-posts/' . $property->FirstPhoto) }}" alt="Image 1">

                            <div class="to-review-info">
                                <p class="lease-duration">{{ $property->created_at }} - {{ $property->lease_end }}</p>

                                <h2><img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="location icon">
                                    {{ $property->city }}, {{ $property->barangay }}
                                </h2>

                                <div class="tags">
                                    <a class="unit-type">{{ $property->unit_category }}</a>
                                    <a class="unit-price">₱{{ $property->rental_price }} /month</a>
                                </div>

                                <p class="description">
                                    {{ $property->description }}
                                </p>
                            </div>
                            <div class="review-btn-wrapper">
                                <button class="review-btn" id="reviewBtn" 
                                    data-id="{{ $property->id }}" 
                                    data-photo="{{ $property->FirstPhoto }}"
                                    data-duration="{{ $property->created_at }} - {{ $property->lease_end }}"
                                    data-location="{{ $tenant->city }}, {{ $tenant->barangay }}"
                                    data-info="{{ $tenant->category }}, {{ $tenant->unit_price }}"
                                    data-role="{{ $userRole }}">
                                    Review
                                </button>
                        </div>
                    @endforeach
                @else
                    @foreach ($toReview as $tenant)
                        <div class="to-review-content">
                            @if ($tenant->pfp == "http://localhost/RentEase/public/images/sampleProfile.png")
                                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                            @else
                                <img src="{{ asset('storage/uploads/images/profile-pictures/' . $tenant->pfp) }}" alt="Profile Picture">
                            @endif
                            <div class="to-review-info">
                                <p class="lease-duration">{{ $tenant->created_at }} - {{ $tenant->lease_end }}</p>

                                <h2>{{ $tenant->firstname }} {{ $tenant->lastname }}</h2>

                                <h5><img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="location icon">
                                    {{ $tenant->city }}, {{ $tenant->barangay }}
                                </h5>
                                
                                <div class="review-btn-wrapper">
                                    <button class="review-btn" id="reviewBtn" 
                                        data-id="{{ $tenant->id }}" 
                                        data-photo="{{ $tenant->pfp }}"
                                        data-duration="{{ $tenant->created_at }} - {{ $tenant->lease_end }}"
                                        data-location="{{ $tenant->firstname }} {{ $tenant->lastname }}"
                                        data-info="{{ $tenant->city }}, {{ $tenant->barangay }}"
                                        data-role="{{ $userRole }}">
                                        Review
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @else
                <div style="margin: 16px 135px;">
                    <h1>No {{ $userRole === 'Tenant' ? 'Porperty' : 'Tenant'}} to Review!</h1>
                    <h4>There are no {{ $userRole === 'Tenant' ? 'property' : 'tenant'}} to review so far.</h4>
                </div>
            @endif

        </div>
        <!-- Tab Content (My Reviews) -->
        <div class="tab-content" id="my-reviews">
            <div style="margin: 16px 135px;">
                <h1>No Reviews Made.</h1>
                <h3>You have not given a review so far.</h3>
            </div>
        </div>
    </div>

    <!-- Include Modal HTML -->
    @include('write-review')
</body>
</html>