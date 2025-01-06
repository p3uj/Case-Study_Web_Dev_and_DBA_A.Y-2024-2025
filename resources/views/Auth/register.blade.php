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
                            <input type="radio" name="role" value="tenant" required {{ old('role') == 'tenant' ? 'checked' : '' }}>
                            Tenant
                        </label>
                        <label>
                            <input type="radio" name="role" value="landlord" required {{ old('role') == 'landlord' ? 'checked' : '' }}>
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
</body>
</html>
