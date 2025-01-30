<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile Tabs</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
    @vite('resources/css/pending-rentals.css')

    <!-- Font Awesome Icon Library -->
    <script src="https://kit.fontawesome.com/87abdb3ce2.js" crossorigin="anonymous"></script>
</head>
<body>
    <x-navbar></x-navbar>
    <div class="container">
        @if (!Empty($rentedProperties))
            @foreach ($rentedProperties as $property)
            <div class="property-post-content">
                <div class="to-review-content">
                    <img src="{{ asset('storage/uploads/images/property-posts/' . $property->FirstPhoto) }}" alt="Apartment">
                    <div >
                        <h4><img src="{{ Vite::asset('resources/images/icon/location.png') }}" alt="location icon">
                        {{ $property->city }}, {{ $property->barangay }}
                        </h4>

                        <div class="tags">
                            <a class="unit-type">{{ $property->unit_category }}</a>
                            <a class="unit-price">₱{{ number_format($property->rental_price, 2) }} /month</a>
                            <a class="max-occupancy">Max {{ $property->max_occupancy }} occupants</a>
                        </div>
                    </div>
                    @if ($userRole == 'Landlord')
                        <!-- Form with a button that triggers confirmation -->
                        <form action="{{ route('updatelease') }}" method="POST" class="lease-btn-wrapper">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="reviewId" value="{{ $property->id }}">
                            <input type="hidden" name="postId" value="{{ $property->Post }}">

                            <!-- Change the button type to 'button' and use onclick to trigger confirmation -->
                            <button type="button" class="lease-btn" onclick="confirmEndLease(event)">End Lease</button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        @else
            <div style="margin: 16px 135px;">
                <h1>No Pending Lease.</h1>
                <h3>There is no pending lease as of now.</h3>
            </div>
        @endif      
    </div>

    <script>
        function confirmEndLease(event) {
            // Ask for confirmation before submitting the form
            if (confirm("Are you sure you want to end the lease for this property?")) {
                // If confirmed, submit the form
                event.target.closest('form').submit();
            } else {
                // If canceled, prevent the form submission
                event.preventDefault();
            }
        }
    </script>
</body>
</html>
