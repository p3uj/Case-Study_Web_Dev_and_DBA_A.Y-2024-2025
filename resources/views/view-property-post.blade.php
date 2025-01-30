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
        <div class="slider-images" id="slider-images" data-count-unit-photos="{{ $propertyUnitPhotos->count() }}">
            @foreach ($propertyUnitPhotos as $unitPhoto)
                <div class="slider-img">
                    <img src="{{ asset('storage/uploads/images/property-posts/' . $unitPhoto->photo_path) }}" alt="{{$unitPhoto->photo_path}}" />
                </div>
            @endforeach
        </div>
    </section>

    <section class="property-post-info">
        <p class="date-posted">{{ \Carbon\Carbon::parse($propertyDetails->updated_at)->format('F j, Y \a\t g:i A') }}</p>
        <h2>
            <img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="Location Icon" style="width: 18px; height: 18px;">
            {{ $propertyDetails->Location }}
        </h2>
        <h1 class="unit-price">₱{{ number_format($propertyDetails->rental_price, 2) }}<span class="per-month"> /month</span></h1>
        <div class="tags">
            <a class="unit-type">{{ $propertyDetails->unit_category }}</a>
            <a class="unit-type">Max {{ $propertyDetails->max_occupancy }} occupants</a>
        </div>
        <p class="description">
            {{ $propertyDetails->description }}
        </p>
        <div class="reviews">
            @for ($star = 1; $star <= 5; $star++)
            <!-- If the star is less than or equal to average rating, show the filled star -->
                @if ($star <= $propertyDetails->Rating)
                    <i class="fas fa-star"></i>
                <!-- Otherwise, show empty star -->
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor
            <p>{{ $propertyDetails->Rating }} out of 5</p>
        </div>
        <div class="profile-container">
            <div class="user-profile">
                @if (asset('resources/images/' . $propertyDetails->ProfilePhoto) == asset('resources/images/sampleProfile.png'))
                    <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture" onclick="window.location.href='{{ route('viewuserprofilepage', ['userId' => $propertyDetails->user_id]) }}'">
                @else
                    <img src="{{ asset('storage/uploads/images/profile-pictures/' . $propertyDetails->ProfilePhoto) }}" alt="Profile Picture" onclick="window.location.href='{{ route('viewuserprofilepage', ['userId' => $propertyDetails->user_id]) }}'">
                @endif
                {{-- Do Kyung-Soo --}}
                <span class="user-name">{{ $propertyDetails->Username }}</span>
            </div>
        </div>
    </section>

</body>

</html>
