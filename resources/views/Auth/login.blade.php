<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase Login</title>

    {{-- Link CSS file --}}
    @vite('resources/css/Login.css')
</head>
<body>
    <div class="container">
        <div class="left"></div>
        <div class="right">
            {{-- Display error message if credentials are incorrect --}}
            <div id="error-alert" class="alert hidden">
                <span class="alert-icon">⚠️</span> 
                <span class="alert-message">{{ session('error') }}</span>
            </div>
            <img src="{{ Vite::asset('resources/images/RentEaseLogo.png')}}" alt="RentEase Logo" class="icon">
            <h1>RentEase</h1>
            <p>Hassle-free and easy way to find a new home!</p>

            {{-- Login form --}}
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <input type="text" placeholder="Email" id="email" name="email" required>
                @if ($errors->has('email'))
                    <span class="text-danger">
                        {{ $errors->first('email') }}
                    </span>
                @endif

                <input type="password" placeholder="Password" id="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">
                        {{ $errors->first('password') }}
                    </span>
                @endif

                <button type="submit">Login</button>
            </form>

            <a href="#">Forgot password?</a>
            <div class="register-link">
                <p>Does not have an account yet? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const errorAlert = document.getElementById('error-alert');

            // Only show error if there's an error message (i.e., login failed)
            if (errorAlert && "{{ session('error') }}") {
                // Show the alert (make it visible)
                errorAlert.classList.remove('hidden');
                errorAlert.style.opacity = 1;

                // Hide the alert after 3 seconds (fade it out)
                setTimeout(function () {
                    errorAlert.style.opacity = 0;
                }, 3000);  // 3 seconds
            }
        });
    </script>
</body>
</html>
