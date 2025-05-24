<?php
// This must be the VERY first thing with no whitespace before
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Only require other files after session start
require 'vendor/autoload.php';
use Aries\MiniFrameworkStore\Models\Category;

$categories = new Category();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Cars</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
    body.store-body {
        background: linear-gradient(135deg, #2b1055, #7597de);
        color: #f9f9f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        margin: 0;
        padding-top: 80px;
    }

    .navbar {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: #ffffff !important;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .navbar-nav .nav-link {
        color: #f1f1f1 !important;
        transition: color 0.3s ease;
        font-weight: 500;
    }

    .navbar-nav .nav-link:hover {
        color: #ffd369 !important;
    }

    .dropdown-menu {
        background-color: #2f2f2f;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .dropdown-item {
        color: #ffffff;
    }

    .dropdown-item:hover {
        background-color: #444;
        color: #ffd369;
    }

    .icon-link {
        position: relative;
        margin-right: 20px;
        color: #ffffff;
    }

    .icon-link i {
        color: #ffd369;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 10px;
        position: absolute;
        top: -5px;
        right: -10px;
    }

    .nav-item.dropdown .nav-link {
        background: linear-gradient(135deg, #1f1c2c, #928dab);
        color: white !important;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 500;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .nav-item.dropdown .nav-link:hover {
        background-color: #3e3a57;
        transform: translateY(-1px);
    }
    </style>
</head>
<body class="store-body">
    <nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">🛒 Showpeee</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-product.php">Add Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Types of Product
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($categories->getAll() as $category): ?>
                            <li><a class="dropdown-item" href="category.php?name=<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>

            <a class="icon-link" href="cart.php">
                <i class="fas fa-shopping-cart fa-lg"></i>
                <span class="badge bg-success"><?php echo countCart(); ?></span>
            </a>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                      style="padding: 10px 20px; background-color: #1f1c2c; color: white; border-radius: 50px; transition: background-color 0.3s ease;">
                      Hello, <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['name']) : 'Guest'; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (isLoggedIn()): ?>
                            <li><a class="dropdown-item" href="my-account.php">My Account</a></li>
                            <li><a class="dropdown-item" href="dashboard.php">My Orders</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="register.php">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
