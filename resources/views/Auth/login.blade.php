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
</body>
</html>
