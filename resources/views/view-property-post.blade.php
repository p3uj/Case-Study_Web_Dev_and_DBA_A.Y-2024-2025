<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Property Post</title>

    {{-- Link css and javascript file --}}
    {{-- @vite('resources/css/customizedColor.css') --}}
    @vite('resources/css/view-property-post.css')
    @vite('resources/js/jQuery.js')
    @vite('resources/js/view-property-post.js')
</head>

<body>
    <x-navbar></x-navbar>
    <section class="slider-container">
        <div class="slider-images">
            <div class="slider-img">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="1" />
            </div>
            <div class="slider-img">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="2" />
            </div>
            <div class="slider-img">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="3" />
            </div>
            <div class="slider-img active">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="4" />
            </div>
            <div class="slider-img">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="5" />
            </div>
            <div class="slider-img">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="6" />
            </div>
            <div class="slider-img">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="7" />
            </div>
        </div>
    </section>

    <section class="property-post-info">
        <p class="date-posted">{{ $propertyDetails->updated_at }}</p>
        <h2>
            <img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="Location Icon" style="width: 18px; height: 18px;">
            {{ $propertyDetails->Location }}
        </h2>
        <h1 class="unit-price">₱{{ number_format($propertyDetails->rental_price, 2) }}<span class="per-month"> /month</span></h1>
        <div class="tags">
            <a class="unit-type">{{ $propertyDetails->unit_category }}</a>
            <a class="unit-type">Max of {{ $propertyDetails->max_occupancy }} person occupancy</a>
        </div>
        <p class="description">
            {{ $propertyDetails->description }}
        </p>
        <div class="reviews">
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
        </div>
        <div class="profile-container">
            <div class="user-profile">
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                {{-- Do Kyung-Soo --}}
                <span class="user-name">{{ $propertyDetails->Username }}</span>
            </div>
        </div>
    </section>

</body>

</html>
