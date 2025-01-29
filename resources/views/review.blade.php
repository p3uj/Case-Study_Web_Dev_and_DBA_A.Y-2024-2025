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
                                    data-location="{{ $property->city }}, {{ $property->barangay }}"
                                    data-info="{{ $property->unit_category }}, {{ $property->rental_price }}"
                                    data-role="{{ $userRole }}">
                                    Review
                                </button>
                        </div>
                    @endforeach
                @else
                    @foreach ($toReview as $tenant)
                        <div class="to-review-content">
                            @if ($tenant->pfp == asset('resources/images/sampleProfile.png'))
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
        <div class="tab-content">
            @if (!empty($reviews))
                <div class="reviews-content">
                    @foreach ($reviews as $review)
                        <div class="review-info-container">
                            <div class="user-review-profile">
                                @if ($tenant->pfp == asset('resources/images/sampleProfile.png'))
                                    <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/uploads/images/profile-pictures/' . $tenant->pfp) }}" alt="Profile Picture">
                                @endif
                            </div>
                            <div class="reviews">
                                <h3>
                                    @for ($star = 1; $star <= $review; $star++)
                                        <!-- If the star is less than or equal to average rating, show the filled star -->
                                        @if ($star <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        <!-- Otherwise, show empty star -->
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </h3>

                            </div>
                            <h1>❝</h1>
                            <div class="review-caption">
                                <p>{{ $review->review_text }}</p>
                            </div>
                            <h1 class="quotation-mark-right">❞</h1>
                            <h4>- {{ $review->firstname }} {{ $review->lastname }}</h4>
                            <p class="date-review">{{ $review->updated_at }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="margin: 16px 135px;">
                    <h1>No Reviews Made.</h1>
                    <h3>You have not given a review so far.</h3>
                </div>
            @endif
        </div>

        <div popover id="edit-search-post-popover" data-id="">
            <h3>Edit {{ $user->role === 'Tenant' ? 'Roommate' : 'Tenant'}} Search</h3>

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
    </div>

    <!-- Include Modal HTML -->
    @include('write-review')
</body>
</html>