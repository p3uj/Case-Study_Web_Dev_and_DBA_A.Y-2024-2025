<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Searching Post</title>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/edit-find-roommate-tenant.css') }}">

    @vite('resources/css/search-user-result.css')
</head>
<body>
    <x-navbar></x-navbar>
    @if (!empty($users))
        @foreach ($users as $user)
            <div class="container">
                <div class="user-container" onclick="window.location.href='{{ route('viewuserprofilepage', ['userId' => $user->id]) }}'">
                    <div class="user-profile-container">
                        @if ( asset('resources/images/' . $user->profile_photo_path) == asset('resources/images/sampleProfile.png'))
                            <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" alt="Profile Picture">
                        @else
                            <img src="{{ asset('storage/uploads/images/profile-pictures/' . $user->profile_photo_path) }}" alt="Profile Picture">
                        @endif
                    </div>
                    <div class="user-info">
                        <h1 class="user-name">{{ $user->firstname }} {{ $user->lastname }}</h1>
                        <p>{{ $user->role }}</p>
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
                                <p>{{ $user->Rating }} out of 5</p>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div style="margin-top: 16px; margin-left: 135px">
            <h1>No user result!</h1>
        </div>
    @endif
</body>
</html>
