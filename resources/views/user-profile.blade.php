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
            <a href="{{ route('editprofilepage', ['id' => $user->id]) }}">
                <button class="edit-profile-btn">Edit Profile</button>
            </a>
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
                                <button class="edit-icon" popovertarget="edit-search-post-popover" data-id="{{ $property->id }}"
                                    onclick="window.location.href='{{ route('editpropertypostpage', ['id' => $property->id, 'property_info_id' => $property->property_info_id]) }}'">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAZdJREFUSEu11TnPDWEYxvHf2xAlEQpiS+xrKSGWaCQK38BXUGs0GlrfQa0TFWLtJYpX7EFCFAprg3PJfWQyzjJn3vc8zWRmnvlf93LdzyyY81qYM99yCKzAGazCdXxvBt0WOIvL2DUhs184h2tYjVs4VPsXcRifh9+3Bd5iQ0f4moIfxDt8wU48wkn8DKct8Lvg00q3tuD78Qyn8LWeHcB5XO0rsA53sLuCeT64P1ERp1z7cAkX+wisx+2Cv6+otyOl/YYd+IhklutMJQr8IbZVzY+UYyK4p7JJL44NTPBiXJPH9SCNv9uCvy4X3cPehmie/1tdmhz4A2xuQWLRITzQ48j19MCqN7tm0BWecqU8gWfYMnR/17QMXmIL3lSEr9C2aBwUeNYPrGxypwkMe7KxIIHHoqn502roh0bJ/+thV4HsC/x+TWuOhNS8CY9Ob4GmMQI/ik8jjpQlCzypqR0F75XBhHNv5KuZM1h2gQzKplmprf2x8tZxc5AfzpVySh+dx4NT9QJujBPoA534zbQfy5IF5y7wB1dYahkZIgF+AAAAAElFTkSuQmCC"
                                            style="height: 24px; width: 24px;"
                                        />
                                </button>
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
                                <div class="">
                                    <a href="{{ route('userprofilepage.deleteornotavialproperty', ['id' => $property->id, 'available' => 'null', 'deleted' => 1]) }}">
                                        <button class="delete-btn">
                                            Delete Post
                                        </button>
                                    </a>

                                    <a href="{{ $property->is_available ? route('add.review.page') : route('userprofilepage.deleteornotavialproperty', ['id' => $property->id, 'available' => ($property->is_available == 1) ? 0 : 1, 'deleted' => 'null']) }}">
                                        <button class="isAvailable-btn">
                                            {{ $property->is_available ? 'Not Available?' : 'Available?' }}
                                        </button>
                                    </a>
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
                            <div class="date-and-edit-icon">
                                <p class="date-posted">{{ $searchingPost->updated_at }}</p>
                                <button class="edit-icon" popovertarget="edit-search-post-popover" data-id="{{ $searchingPost->id }}"
                                    onclick="window.location.href='{{ route('editsearchpostpage', ['id' => $searchingPost->id]) }}'">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAZdJREFUSEu11TnPDWEYxvHf2xAlEQpiS+xrKSGWaCQK38BXUGs0GlrfQa0TFWLtJYpX7EFCFAprg3PJfWQyzjJn3vc8zWRmnvlf93LdzyyY81qYM99yCKzAGazCdXxvBt0WOIvL2DUhs184h2tYjVs4VPsXcRifh9+3Bd5iQ0f4moIfxDt8wU48wkn8DKct8Lvg00q3tuD78Qyn8LWeHcB5XO0rsA53sLuCeT64P1ERp1z7cAkX+wisx+2Cv6+otyOl/YYd+IhklutMJQr8IbZVzY+UYyK4p7JJL44NTPBiXJPH9SCNv9uCvy4X3cPehmie/1tdmhz4A2xuQWLRITzQ48j19MCqN7tm0BWecqU8gWfYMnR/17QMXmIL3lSEr9C2aBwUeNYPrGxypwkMe7KxIIHHoqn502roh0bJ/+thV4HsC/x+TWuOhNS8CY9Ob4GmMQI/ik8jjpQlCzypqR0F75XBhHNv5KuZM1h2gQzKplmprf2x8tZxc5AfzpVySh+dx4NT9QJujBPoA534zbQfy5IF5y7wB1dYahkZIgF+AAAAAElFTkSuQmCC"
                                            style="height: 24px; width: 24px;"
                                        />
                                </button>

                            </div>
                            <p class="caption">{{ $searchingPost->description }}</p>
                        </div>
                        <div class="find-tenant-bottom">
                            <h2>{{ $searchingPost->is_already_found ? 'Found' : ('Finding ' .$searchingPost->search_categories) }}</h2>
                            <div>
                                <button class="delete-btn" onclick="window.location.href='{{ route('userprofilepage.updatefoundordeleted', ['id' => $searchingPost->id, 'found' => 'null', 'deleted' => 1]) }}'">
                                    Delete Post
                                </button>
                                <button class="isFound-btn" onclick="window.location.href='{{ route('userprofilepage.updatefoundordeleted', ['id' => $searchingPost->id, 'found' => ($searchingPost->is_already_found == 1) ? 0 : 1, 'deleted' => 'null']) }}'">
                                    {{ $searchingPost->is_already_found == 1 ? 'Not yet Found?' : 'Already Found?' }}
                                </button>
                            </div>
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
