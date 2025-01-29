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
        <div class="tab-content" id="my-reviews">
            @if (!empty($reviews))
                <div class="reviews-content">
                    @foreach ($reviews as $review)
                        <div class="review-info-container">
                            <div class="user-review-profile">
                                @if ($review->pfp == asset('resources/images/sampleProfile.png'))
                                    <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/uploads/images/profile-pictures/' . $review->pfp) }}" alt="Profile Picture">
                                @endif
                            </div>
                            <div class="reviews">
                                <h3>
                                    @for ($star = 1; $star <= $review->rating; $star++)
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

                            <button class="review-btn" id="reviewBtn" 
                                data-id="{{ $review->id }}" 
                                data-photo="{{ $review->pfp }}"
                                data-duration="{{ $review->created_at }} - {{ $review->lease_end }}"
                                data-location="{{ $review->firstname }} {{ $review->lastname }}"
                                data-info="{{ $review->city }}, {{ $review->barangay }}"
                                data-role="{{ $userRole }}"
                                data-rating="{{ $review->rating }}" 
                                data-desc="{{ $review->review-text }}"
                                data-edit-status="{{ $review->is_edited }}">
                                Edit Review
                            </button>
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

    </div>

    <!-- Include Modal HTML -->
    @include('write-review')
</body>
</html>