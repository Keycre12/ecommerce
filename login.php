<?php
// MUST be first line - no whitespace before!
require 'helpers/functions.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is already logged in - but don't redirect if we're already on my-account.php
if (isset($_SESSION['user']) && basename($_SERVER['PHP_SELF']) !== 'my-account.php') {
    header('Location: my-account.php');
    exit;
}

// Only now include other files
require 'vendor/autoload.php';
use Aries\MiniFrameworkStore\Models\User;

// Initialize variables
$message = '';

// Process login form
if (isset($_POST['submit'])) {
    $user = new User();
    $user_info = $user->login([
        'email' => $_POST['email']
    ]);

    if ($user_info && password_verify($_POST['password'], $user_info['password'])) {
        $_SESSION['user'] = $user_info;
        header('Location: my-account.php');
        exit;
    } else {
        $message = 'Invalid email or password';
    }
}

// Now render the template
template('header.php');
?>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/styles.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
    /* Modern Gradient Theme for Login Page */
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        position: relative;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.05"/><circle cx="90" cy="40" r="1" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
    }

    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 420px;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
    }

    .login-card h1 {
        color: #2d3748;
        font-weight: 800;
        margin-bottom: 8px;
        font-size: 2rem;
        text-align: center;
    }

    .login-card h5 {
        color: #718096;
        font-weight: 500;
        text-align: center;
        margin-bottom: 32px;
        font-size: 1rem;
    }

    .input-group {
        margin-bottom: 20px;
        position: relative;
    }

    .input-group-text {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        font-size: 1.1rem;
        border-radius: 12px 0 0 12px;
        padding: 12px 16px;
        box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.2);
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-left: none;
        color: #2d3748;
        background-color: #ffffff;
        font-weight: 500;
        padding: 12px 16px;
        border-radius: 0 12px 12px 0;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background-color: #ffffff;
    }

    .form-text {
        color: #a0aec0;
        font-size: 0.875rem;
        margin-top: 8px;
    }

    .form-check {
        margin: 24px 0;
    }

    .form-check-input {
        background-color: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 6px;
    }

    .form-check-input:checked {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: #667eea;
    }

    .form-check-label {
        color: #4a5568;
        font-weight: 500;
        margin-left: 8px;
    }

    .btn-gradient {
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 14px 0;
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-gradient:hover::before {
        left: 100%;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-gradient:active {
        transform: translateY(0);
    }

    .text-center {
        margin-top: 24px;
    }

    a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #764ba2;
        text-decoration: none;
    }

    .floating-elements {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .floating-elements::before,
    .floating-elements::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .floating-elements::before {
        width: 60px;
        height: 60px;
        top: 10%;
        right: 10%;
        animation-delay: -2s;
    }

    .floating-elements::after {
        width: 40px;
        height: 40px;
        bottom: 20%;
        left: 15%;
        animation-delay: -4s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.5;
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.8;
        }
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 30px 24px;
            margin: 10px;
        }
        
        .login-card h1 {
            font-size: 1.75rem;
        }
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h1 class="text-center mb-3"><i class="fas fa-user-circle me-2"></i>Login</h1>
        <h5 class="text-center text-danger"><?php echo htmlspecialchars($message); ?></h5>

        <form action="login.php" method="POST">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email address" required>
            </div>
            <div class="form-text mb-2 ms-1">We'll never share your email with anyone else.</div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheck">
                <label class="form-check-label" for="rememberCheck">Remember me</label>
            </div>

            <button type="submit" name="submit" class="btn btn-gradient mb-3 d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>

            <p class="text-center mt-3" style="font-size: 0.9rem;">
                Don't have an account? <a href="register.php" class="text-decoration-none">Register here</a>
            </p>
        </form>
    </div>
</div>

<?php template('footer.php'); ?>