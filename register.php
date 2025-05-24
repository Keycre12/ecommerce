<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

 <style>
        /* Modern Purple-Blue Theme for Register Page */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #2c3e50;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(102, 126, 234, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(118, 75, 162, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(240, 147, 251, 0.3) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .register-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 12px 25px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            padding: 45px 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
            background-size: 300% 100%;
            animation: colorFlow 8s linear infinite;
        }

        @keyframes colorFlow {
            0% { background-position: 0% 50%; }
            100% { background-position: 300% 50%; }
        }

        h1 {
            color: #2c3e50;
            font-size: 2.25rem;
            margin-bottom: 12px;
            text-align: center;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .subtitle {
            text-align: center;
            color: #6c757d;
            margin-bottom: 35px;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .alert {
            padding: 16px 20px;
            margin-bottom: 25px;
            border-radius: 16px;
            font-size: 0.95rem;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: currentColor;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(34, 197, 94, 0.1));
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #059669;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 24px;
            position: relative;
        }

        .input-group-text {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 14px 18px;
            border-radius: 16px 0 0 16px;
            font-size: 1.1rem;
            box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-left: none;
            border-radius: 0 16px 16px 0;
            padding: 14px 18px;
            font-size: 1rem;
            color: #2c3e50;
            background-color: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
            background-color: #ffffff;
            transform: translateY(-1px);
        }

        .input-group:hover .input-group-text {
            transform: scale(1.02);
            box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.3);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-weight: 700;
            border-radius: 16px;
            padding: 16px 24px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 15px 35px rgba(102, 126, 234, 0.4),
                0 8px 20px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:active {
            transform: translateY(-1px);
        }

        .login-link {
            margin-top: 28px;
            text-align: center;
            color: #6c757d;
            font-size: 1rem;
            font-weight: 500;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 700;
            position: relative;
        }

        .login-link a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .login-link a:hover::after {
            width: 100%;
        }

        /* Floating particles animation */
        .register-card::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(118, 75, 162, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -50px;
            right: -50px;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.3;
            }
            33% {
                transform: translate(-30px, -30px) rotate(120deg);
                opacity: 0.6;
            }
            66% {
                transform: translate(30px, -20px) rotate(240deg);
                opacity: 0.4;
            }
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 35px 28px;
                margin: 15px;
                border-radius: 24px;
            }
            
            h1 {
                font-size: 2rem;
            }

            .input-group-text, .form-control {
                padding: 12px 16px;
            }

            .btn-gradient {
                padding: 14px 20px;
                font-size: 1rem;
            }
        }
    </style>

<?php

use Aries\MiniFrameworkStore\Models\User;
use Carbon\Carbon;

$user = new User();

if (isset($_POST['submit'])) {
    $registered = $user->register([
        'name' => $_POST['full-name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'],
        'birthdate' => $_POST['birthdate'],
        'created_at' => Carbon::now('Asia/Manila'),
        'updated_at' => Carbon::now('Asia/Manila')
    ]);
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

?>

<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<div class="container register-wrapper">
    <div class="register-card">
        <h1 class="text-center mb-3"><i class="fas fa-user-plus me-2"></i>Create Account</h1>

        <?php if (isset($registered)): ?>
            <div class="alert alert-success text-center" role="alert">
                <i class="fas fa-check-circle me-1"></i> You have successfully registered!
                <br><a href="login.php" class="alert-link">Click here to login</a>.
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input name="full-name" type="text" class="form-control" placeholder="Full Name" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="form-text mb-2 ms-1" style="font-size: 0.8rem;">We’ll never share your email with anyone else.</div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                <input name="address" type="text" class="form-control" placeholder="Address">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input name="phone" type="text" class="form-control" placeholder="Phone Number">
            </div>

            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input name="birthdate" type="date" class="form-control">
            </div>

            <button type="submit" name="submit" class="btn btn-gradient">
                <i class="fas fa-user-plus"></i> Register
            </button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>