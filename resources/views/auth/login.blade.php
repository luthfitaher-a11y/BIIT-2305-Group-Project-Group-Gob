<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login — Gob Sports</title>
    @vite(['resources/css/app.css'])
</head>
<body>
<div class="auth-screen">

    {{-- Left panel: branding --}}
    <div class="auth-left">
        <div class="auth-sport-icons">⚽ 🏉 🏸</div>
        <h1><span>Gob</span> Sports</h1>
        <p>Your one-stop destination for Soccer, Rugby, and Badminton gear in Malaysia.</p>
        <div class="auth-tagline">
            <div class="auth-tag">✓ 25+ Premium Products</div>
            <div class="auth-tag">✓ Free shipping over RM500</div>
            <div class="auth-tag">✓ Easy 14-day returns</div>
            <div class="auth-tag">✓ Shariah-compliant platform</div>
        </div>
    </div>

    {{-- Right panel: forms --}}
    <div class="auth-right">
        <div class="auth-box">

            {{-- Error messages --}}
            @if($errors->any())
                <div class="auth-err show">{{ $errors->first() }}</div>
            @endif

            {{-- LOGIN FORM --}}
            <div class="auth-form {{ $form === 'login' ? 'active' : '' }}" id="formLogin">
                <h2>Welcome back</h2>
                <p class="sub">Sign in to your Gob Sports account</p>
                <form method="POST" action="{{ route('auth.doLogin') }}">
                    @csrf
                    <div class="auth-field">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="you@email.com"
                               value="{{ old('email') }}" required>
                    </div>
                    <div class="auth-field">
                        <label>Password</label>
                        <input type="password" name="password"
                               placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="auth-btn">Sign In</button>
                </form>
                <div class="auth-switch">
                    Don't have an account?
                    <a href="{{ route('auth.signup.page') }}">Create one free</a>
                </div>
            </div>
            {{-- END LOGIN FORM --}}

            {{-- SIGNUP FORM --}}
            <div class="auth-form {{ $form === 'signup' ? 'active' : '' }}" id="formSignup">
                <h2>Create account</h2>
                <p class="sub">Join Gob Sports today — it's free</p>
                <form method="POST" action="{{ route('auth.signup') }}">
                    @csrf
                    <div class="auth-field">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Ahmad Razif"
                               value="{{ old('name') }}" required>
                    </div>
                    <div class="auth-field">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="you@email.com"
                               value="{{ old('email') }}" required>
                    </div>
                    <div class="auth-field">
                        <label>Password</label>
                        <input type="password" name="password"
                               placeholder="Min. 6 characters" required>
                    </div>
                    <div class="auth-field">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               placeholder="Re-enter password" required>
                    </div>
                    <button type="submit" class="auth-btn">Create Account</button>
                </form>
                <div class="auth-switch">
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in</a>
                </div>
            </div>
            {{-- END SIGNUP FORM --}}

        </div>
    </div>
</div>
</body>
</html>