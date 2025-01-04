<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/customizedColor.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/profile.css">
    <script src="../js/navbarComponent.js" defer></script>

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
                <h2>4.0</h2>
                <div class="reviews">
                    <h3>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i> <!--Empty star-->
                    </h3>
                </div>
            </div>
            <p class="bio">
                {{ $user->bio }}
            </p>
        </div>
        <div class="profile-picture">
            <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
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
            @if ($properties->isNotEmpty())
                @foreach ($properties as $property)
                    <div id="property-post" class="property-post-content" data-isPostAvailable="{{$property->is_available}}">
                        <img src="{{ Vite::asset('resources/images/propertysample/property1.png') }}" alt="Image 1">
                        <div class="property-info">
                            <p class="date-posted">{{ $property->date_posted->format('F d, Y \a\t h:i A') }}</p>
                            <h2><img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="location icon">
                                {{ $property->propertyInfo->city }}, {{ $property->propertyInfo->barangay }}
                            </h2>
                            <div class="tags">
                                <a class="unit-type">{{ $property->propertyInfo->unit_category }}</a>
                                <a class="unit-price">₱{{ number_format($property->propertyInfo->rental_price, 2) }} /month</a>
                            </div>
                            <p class="description">
                                {{ $property->propertyInfo->description }}
                            </p>
                            <div class="property-bottom">
                                <div class="reviews">
                                    @for ($star = 1; $star <= 5; $star++)
                                        <!-- If the star is less than or equal to average rating, show the filled star -->
                                        @if ($star <= ($property->averageRating() ?? 0))
                                            <i class="fas fa-star"></i>
                                        <!-- Otherwise, show empty star -->
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <p>{{ $property->averageRating() ?? 0 }} out of 5</p>
                                </div>
                                <div class="">
                                    <button class="delete-btn">Delete</button>
                                    <button class="isAvailable-btn">
                                        {{ $property->is_available ? 'Not Available?' : 'Available?' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="margin: 16px 135px;">
                    <h1>No property posts!</h1>
                </div>
            @endif

        </div>

        <!-- Find Tenant Content -->
        <div class="tab-content">
            <div class="find-tenant-content">
                <div class="find-tenant-info">
                    <p class="date-posted">February 14, 2024 at 11:50 AM</p>
                    <p class="caption">As a landlord, I am currently seeking a responsible tenant for
                        my spacious 2-bedroom apartment located in Makati, Metro Manila. The apartment is
                        available for PHP 25,000 per month, with a security deposit of PHP 50,000. It is
                        equipped with modern amenities, including built-in closets in both bedrooms, a fully
                        equipped kitchen with appliances (stove, refrigerator, microwave), and air-conditioning
                        units in every room. The open-plan living and dining area provides ample space, and the
                        apartment also features a balcony with scenic views of the city skyline. Free parking is
                        available, and high-speed internet access can be arranged for an additional fee. I am
                        looking for a tenant who is responsible, quiet, and able to provide proof of income, such
                        as payslips or bank statements. Smoking is not allowed inside the unit, and pets are only
                        permitted by prior arrangement. If you are interested, please feel free to contact me at
                        (0917) 123-4567 or email me at landlord.makati@example.com to schedule a viewing or for
                        further inquiries. I look forward to hearing from you!

                    </p>
                </div>
                <div class="find-tenant-bottom">
                    <h2>Finding Tenant</h2>
                    <div>
                        <button class="delete-btn">Delete Post</button>
                        <button class="isFound-btn">Already Found?</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review from Tenant Content -->
        <div class="tab-content">
            <div class="reviews-content">
                <div class="review-info-container">
                    <div class="user-review-profile">
                        <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Sample Profile">
                    </div>
                    <div class="reviews">
                        <h3>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i> <!--Empty star-->
                        </h3>
                    </div>
                    <h1>❝</h1>
                    <div class="review-caption">
                        <p>As a landlord, I have had the pleasure of renting to
                            Alice Guo for the past 10 years. Throughout the lease,
                            she has consistently been a respectful and responsible
                            tenant. She has always paid rent on time and kept the
                            property in excellent condition. Any maintenance issues
                            were promptlysfsdfsdf.
                            As a landlord, I have had the pleasure of renting to
                            Alice Guo for the past 10 years. Throughout the lease,
                            she has consistently been a respectful and responsible
                            tenant. She has always paid rent on time and kept the
                            property in excellent condition. Any maintenance issues
                            were promptlysfsdfsdf.
                            As a landlord, I have had the pleasure of renting to
                            Alice Guo for the past 10 years. Throughout the lease,
                            she has consistently been a respectful and responsible
                            tenant. She has always paid rent on time and kept the
                            property in excellent condition. Any maintenance issues
                            were promptlysfsdfsdf.
                            As a landlord, I have had the pleasure of renting to
                            Alice Guo for the past 10 years. Throughout the lease,
                            she has consistently been a respectful and responsible
                            tenant. She has always paid rent on time and kept the
                            property in excellent condition. Any maintenance issues
                            were promptlysfsdfsdf.
                            As a landlord, I have had the pleasure of renting to
                            Alice Guo for the past 10 years. Throughout the lease,
                            she has consistently been a respectful and responsible
                            tenant. She has always paid rent on time and kept the
                            property in excellent condition. Any maintenance issues
                            were promptlysfsdfsdf.
                        </p>
                    </div>
                    <h1 class="quotation-mark-right">❞</h1>
                    <h4>- Do Kyung-Soo</h4>
                    <p class="date-review">July 07, 2024 at 12:00 AM</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
