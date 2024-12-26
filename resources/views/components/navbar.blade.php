<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="topnav">
        <img src="{{ Vite::asset('resources/images/RentEaseLogo.png') }}" alt="Rent Ease Logo" class="rentEaseLogo"">
        <form>
            <input type="text" class="searchbar" placeholder="Search a user...">
            <button type="submit">Search</button>
        </form>
        <a href="{{ route("homepage")}}" class="{{ Route::currentRouteName() === 'homepage' ? 'active' : '' }}">Home</a>
        <a href="{{ route("propertiespage")}}" class="{{ Route::currentRouteName() === 'propertiespage' ? 'active' : '' }}">Properties</a>
        <a href="{{ route("findroommateortenantpage")}}" class="{{ Route::currentRouteName() === 'findroommateortenantpage' ? 'active' : '' }}">Find Roommate/Tenant</a>
        <a href="{{ route("postapropertypage")}}" class="{{ Route::currentRouteName() === 'postapropertypage' ? 'active' : '' }}">Post a Property</a>
        <a href="{{ route("aboutuspage")}}" class="{{ Route::currentRouteName() === 'aboutuspage' ? 'active' : '' }}">About Us </a>
        <button class="logout-btn" type="submit">Logout</button>
        <img src="{{ Vite::asset('resources/images/sampleProfile.png')}}" alt="Sample Profile" class="sampleProfile">
    </div>
</body>
</html>
