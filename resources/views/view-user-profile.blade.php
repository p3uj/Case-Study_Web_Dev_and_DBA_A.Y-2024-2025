<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
    @vite('resources/css/profile.css')
    @vite('resources/js/profile.js')
    <!-- Font Awesome Icon Library -->
    <script src="https://kit.fontawesome.com/87abdb3ce2.js" crossorigin="anonymous"></script>
</head>
<body>
    <x-navbar></x-navbar>
    <div class="profile-container">
        <div class="profile-info">
            <h1>{{ $user->firstname }} {{ $user->lastname }}</h1>
            <p>{{ $user->role }}</p>
            <p>{{ $user->city }}</p>
            <div class="rating-container">
                <h2>{{ $user->Rating }}</h2>
                <div class="reviews">
                    <h3>
                        @for ($star = 1; $star <= 5; $star++)
                            <!-- If the star is less than or equal to average rating, show the filled star -->
                            @if ($star <= $user->Rating)
                                <i class="fas fa-star"></i>
                            <!-- Otherwise, show empty star -->
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </h3>
                </div>
            </div>
            <p class="bio">
                {{ $user->bio }}
            </p>
        </div>
        <div class="profile-picture">
            @if ( asset('resources/images/' . $user->profile_photo_path) == asset('resources/images/sampleProfile.png'))
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
            @else
                <img src="{{ asset('storage/uploads/images/profile-pictures/' . $user->profile_photo_path) }}" alt="Profile Picture">
            @endif
        </div>
    </div>
    <div class="container">
        <div class="tab-box">
            <button id="property-post-btn" class="tab-btn" data-role="{{$user->role}}">
                Property Post
            </button>
            <button class="tab-btn">
                Find {{ $user->role === 'Landlord' ? 'Tenant' : 'Roommate'}} Post
            </button>
            <button class="tab-btn">
                Review from {{ $user->role === 'Landlord' ? 'Tenant' : 'Landlord'}}
            </button>
        </div>

        <!-- Property Post Content -->
        <div class="tab-content">
            @if (!empty($propertyPost))
                @foreach ($propertyPost as $property)
                    <div id="property-post" class="property-post-content" data-isPostAvailable="{{$property->is_available}}">
                        <img class="unit-photo" data-is-available="{{$property->is_available}}"
                            src="{{ asset('storage/uploads/images/property-posts/' . $property->FirstPhoto) }}" alt="Image 1"
                            onclick="window.location.href='{{ route('viewpropertypostpage', ['id' => $property->id, 'property_info_id' => $property->property_info_id]) }}'"
                        >
                        <div class="property-info" data-is-available="{{$property->is_available}}">
                            <div class="date-and-edit-icon">
                                <p class="date-posted">{{ $property->updated_at }}</p>
                            </div>
                            <h2><img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="location icon">
                                {{ $property->Location }}
                            </h2>
                            <div class="tags"">
                                <a class="unit-type">{{ $property->unit_category }}</a>
                                <a class="unit-price">₱{{ number_format($property->rental_price, 2) }} /month</a>
                                <a class="max-occupancy">Max {{ $property->max_occupancy }} occupants</a>
                            </div>
                            <p class="description">
                                {{ $property->description }}
                            </p>
                            <div class="property-bottom">
                                <div class="reviews" data-is-available="{{$property->is_available}}>
                                    @for ($star = 1; $star <= 6; $star++)
                                        <!-- If the star is less than or equal to average rating, show the filled star -->
                                        @if ($star <= $property->Rating)
                                            <i class="fas fa-star"></i>
                                        <!-- Otherwise, show empty star -->
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <p>{{ $property->Rating }} out of 5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="margin: 16px 135px;">
                    <h1>No Property Posts!</h1>
                </div>
            @endif
        </div>

        <!-- Find Tenant Content -->
        <div class="tab-content">
            @if (!empty($findPost))
                @foreach ($findPost as $searchingPost)
                    <div class="find-tenant-content">
                        <div class="find-tenant-info">
                            <p class="caption">{{ $searchingPost->description }}</p>
                        </div>
                        <div class="find-tenant-bottom">
                            <h2>{{ $searchingPost->is_already_found ? 'Found' : ('Finding ' .$searchingPost->search_categories) }}</h2>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="margin: 16px 135px;">
                    <h1>No Searching Posts!</h1>
                </div>
            @endif
        </div>

        <!-- Review from Tenant Content -->
        <div class="tab-content">
            @if (!empty($reviews))
                <div class="reviews-content">
                    @foreach ($reviews as $review)
                        <div class="review-info-container">
                            <div class="user-review-profile">
                                @if (asset('resources/images/' . $review->profile_photo_path) == asset('resources/images/sampleProfile.png'))
                                    <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/uploads/images/profile-pictures/' . $review->profile_photo_path) }}" alt="Profile Picture">
                                @endif
                            </div>
                            <div class="reviews">
                                <h3>
                                    @for ($star = 1; $star <= 5; $star++)
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
                            <h4>- {{ $review->UserName }}</h4>
                            <p class="date-review">{{ $review->updated_at }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="margin: 16px 135px;">
                    <h1>No Review!</h1>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
