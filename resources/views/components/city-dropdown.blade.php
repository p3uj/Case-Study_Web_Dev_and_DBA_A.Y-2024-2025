<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
</head>
<body>
    <!-- City Dropdown Box -->
    <select name="city" class="city-dropdown" data-city-value="" style="border-radius: 40px; border: none;">
        <option value="" disabled selected>Please select city</option>
        @foreach ($cities as $city)
            <option id="{{ $city['code'] }}" value="{{ $city['name'] }}">
                {{ $city['name'] }}
            </option>
        @endforeach
    </select>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.city-dropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var cityValue = selectedOption.value;

                console.log("Selected City Code:", cityValue);

                this.setAttribute('data-city-value', cityValue);
            });
        });
    });
</script>
</html>
