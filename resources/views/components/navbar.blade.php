<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')

    <!-- Add Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar">
        <img src="{{ Vite::asset('resources/images/RentEaseLogo.png') }}" alt="Rent Ease Logo" class="rentease-logo">
        <form class="search-form" action="{{ route('searchuserresult.post') }}" method="post">
            @csrf
            <input type="text" class="searchbar" name="search-user" placeholder="Search a user...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <a href="{{ route("homepage")}}" class="{{ Route::currentRouteName() === 'homepage' ? 'active' : '' }}">Home</a>
        <a href="{{ route("propertiespage")}}" class="{{ Route::currentRouteName() === 'propertiespage' || Route::currentRouteName() === 'property.post' || Route::currentRouteName() === 'viewpropertypostpage' ? 'active' : '' }} ">Properties</a>
        <a href="{{ route("findroommateortenantpage")}}" class="{{ Route::currentRouteName() === 'findroommateortenantpage' ? 'active' : '' }}">
            Find {{ Auth::user()->role === 'Landlord' ? 'Tenant' : 'Roommate' }}
        </a>
        <a href="{{ route("pendingrentalspage")}}" class="{{ Route::currentRouteName() === 'pendingrentalspage' ? 'active' : '' }}">Pending Rentals</a>
        <a href="{{ route("reviewpage")}}" class="{{ Route::currentRouteName() === 'reviewpage' ? 'active' : '' }}">Review</a>
        <a href="{{ route("logout") }}" class="logout">Logout</a>
        <a href="{{ route("userprofilepage")}}" class="{{ Route::currentRouteName() == 'userprofilepage' ? 'active' : '' }} profile-border">
            @if (asset('resources/images/' . Auth::user()->profile_photo_path) == asset('resources/images/sampleProfile.png'))
                <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture" class="sample-profile">
            @else
                <img src="{{ asset('storage/uploads/images/profile-pictures/' . Auth::user()->profile_photo_path) }}" alt="Profile Picture" class="sample-profile">
            @endif
        </a>
    </div>
</body>
</html>
