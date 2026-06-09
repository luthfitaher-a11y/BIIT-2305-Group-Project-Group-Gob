<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login — Gob Sports</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>
<body>
<div class="auth-screen">

    
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

    
    <div class="auth-right">
        <div class="auth-box">

            
            <?php if($errors->any()): ?>
                <div class="auth-err show"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>

            
            <div class="auth-form <?php echo e($form === 'login' ? 'active' : ''); ?>" id="formLogin">
                <h2>Welcome back</h2>
                <p class="sub">Sign in to your Gob Sports account</p>
                <form method="POST" action="<?php echo e(route('auth.doLogin')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="auth-field">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="you@email.com"
                               value="<?php echo e(old('email')); ?>" required>
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
                    <a href="<?php echo e(route('auth.signup.page')); ?>">Create one free</a>
                </div>
            </div>
            

            
            <div class="auth-form <?php echo e($form === 'signup' ? 'active' : ''); ?>" id="formSignup">
                <h2>Create account</h2>
                <p class="sub">Join Gob Sports today — it's free</p>
                <form method="POST" action="<?php echo e(route('auth.signup')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="auth-field">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Ahmad Razif"
                               value="<?php echo e(old('name')); ?>" required>
                    </div>
                    <div class="auth-field">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="you@email.com"
                               value="<?php echo e(old('email')); ?>" required>
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
                    <a href="<?php echo e(route('login')); ?>">Sign in</a>
                </div>
            </div>
            

        </div>
    </div>
</div>
</body>
</html><?php /**PATH C:\Users\Welcome\Downloads\GobSports_Laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>