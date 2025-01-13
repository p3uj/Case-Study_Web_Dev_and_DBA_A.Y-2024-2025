<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
</head>
<body>
    <div class="navbar">
        <img src="{{ Vite::asset('resources/images/RentEaseLogo.png') }}" alt="Rent Ease Logo" class="rentease-logo"">
        <form>
            <input type="text" class="searchbar" placeholder="Search a user...">
            <button type="submit">Search</button>
        </form>
        <a href="{{ route("homepage")}}" class="{{ Route::currentRouteName() === 'homepage' ? 'active' : '' }}">Home</a>
        <a href="{{ route("propertiespage")}}" class="{{ Route::currentRouteName() === 'propertiespage' ? 'active' : '' }}">Properties</a>
        <a href="{{ route("findroommateortenantpage")}}" class="{{ Route::currentRouteName() === 'findroommateortenantpage' ? 'active' : '' }}">
            Find {{ Auth::user()->role === 'Landlord' ? 'Tenant' : 'Roommate' }}
        </a>
        <a href="{{ route("postapropertypage")}}" class="{{ Route::currentRouteName() === 'postapropertypage' ? 'active' : '' }}">Post a Property</a>
        <a href="{{ route("reviewpage")}}" class="{{ Route::currentRouteName() === 'reviewpage' ? 'active' : '' }}">Review</a>
        <a href="{{ route("logout") }}" class="logout">Logout</a>
        <a href="{{ route("userprofilepage")}}" class="{{ Route::currentRouteName() == 'userprofilepage' ? 'active' : '' }} profile-border">
            <img src="{{ Vite::asset('resources/images/sampleProfile.png')}}" alt="Sample Profile" class="sample-profile">
        </a>
    </div>
</body>
</html>
