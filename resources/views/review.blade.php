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
                            <img src="{{ asset($toReview->FirstPhoto) }}" alt="Image 1">

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
                                <button class="review-btn">Review</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="to-review-content">
                        <img src="asset('resources/images/sampleProfile.png')" alt="Image 1">
                        <div class="to-review-info">
                            <p class="lease-duration">{{ $property->created_at }} - {{ $property->lease_end }}</p>

                            <h2>{{ $property->firstname }} {{ $property->lastname }}</h2>

                            <h5><img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="location icon">
                                {{ $property->city }}, {{ $property->barangay }}
                            </h5>
                            
                            <div class="review-btn-wrapper">
                                <button class="review-btn">Review</button>
                            </div>
                        </div>
                    </div>
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
</body>
</html>