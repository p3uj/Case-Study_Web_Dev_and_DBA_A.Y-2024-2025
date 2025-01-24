<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>

    <!-- Link css and javascript file -->
    @vite('resources/js/filter-property.js')
</head>
<body>
    <!-- City Dropdown Box -->
    <select name="city" class="filter-city" data-filter-city-value="" style="border-radius: 40px; border: none;">
        <option value="" disabled selected>Please select city</option>
        @foreach ($cities as $city)
            <option id="{{ $city['code'] }}" value="{{ $city['name'] }}">
                {{ $city['name'] }}
            </option>
        @endforeach
    </select>
</body>
</html>
