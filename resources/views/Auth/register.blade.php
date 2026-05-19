<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase Register</title>
    
    <!-- Link css file -->
    @vite('resources/css/register.css')
</head>
<body>
    <div class="container">
        <div class="left-section"></div>
        <div class="right-section">
            <img src="{{ Vite::asset('resources/images/RentEaseLogo.png') }}" alt="RentEase Logo" class="icon">
            <h1>RentEase</h1>
            <p>Hassle-free and easy way to find a new home!</p>

            <!-- Register form -->
            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <!-- First and Last Name -->
                <div class="form-row">
                    <input type="text" placeholder="First Name" id="firstname" name="firstname" required>
                    <input type="text" placeholder="Last Name" id="lastname" name="lastname" required>
                </div>
                @if ($errors->has('firstname'))
                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                @endif
                @if ($errors->has('lastname'))
                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                @endif

                <!-- City Dropdown Box -->
                <div class="dropdown-container">
                    <select name="city" id="city" data-city-code="" required>
                        <option value="" disabled selected>Please select city</option>
                        @foreach ($cities as $city)
                            <option id="{{ $city['code'] }}"
                                value="{{ $city['name'] }}">
                                {{ $city['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Email -->
                <input type="email" placeholder="Email" id="email" name="email" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif

                <!-- Password -->
                <input type="password" placeholder="Password" id="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif

                <!-- Confirm Password -->
                <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required>

                <!-- Role Selection -->
                <div class="role-selection">
                    <label for="role"><strong>What best describes you?</strong></label><br>
                    <div class="radio-buttons">
                        <label>
                            <input type="radio" name="role" value="Tenant" required {{ old('role') == 'Tenant' ? 'checked' : '' }}>
                            Tenant
                        </label>
                        <label>
                            <input type="radio" name="role" value="Landlord" required {{ old('role') == 'Landlord' ? 'checked' : '' }}>
                            Landlord
                        </label>
                    </div>
                    @if ($errors->has('role'))
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                <!-- Register Button -->
                <button type="submit">Sign Up</button>
            </form>

            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Display the SweetAlert pop-up with the success message
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                showConfirmButton: false, // Disable the confirm button
                timer: 4000 // Wait for 2 seconds (2000ms)
            }).then(() => {
                // Redirect to homepage after the pop-up closes
                window.location.href = "{{ route('homepage') }}";
            });
        </script>
    @endif

</body>
</html>