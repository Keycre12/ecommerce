<?php

if (!function_exists('assets')) {
    function assets($path = '') {
        return "assets/" . ltrim($path, '/');
    }
}

function template($path) {
    include 'templates/' . $path;
}

function countCart() {
    if (!empty($_SESSION['cart'])) {
        // Sum all quantities in the cart
        return array_sum(array_column($_SESSION['cart'], 'quantity'));
    }
    return 0;
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function getCartItems() {
    if (!empty($_SESSION['cart'])) {
        return $_SESSION['cart'];
    }
    return [];
}

function calculateCartTotal() {
    $total = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['total'];
        }
    }
    return $total;
}

function addToCart($productId, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productModel = new Aries\MiniFrameworkStore\Models\Product();
    $product = $productModel->getById($productId);

    if (!$product) {
        return false;
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'product_id' => $productId,
            'name' => $product['name'],
            'price' => $product['price'],
            'image_path' => $product['image_path'],
            'quantity' => $quantity,
            'total' => $product['price'] * $quantity
        ];
    }

    // Update the total for this item
    $_SESSION['cart'][$productId]['total'] = 
        $_SESSION['cart'][$productId]['quantity'] * $_SESSION['cart'][$productId]['price'];

    return true;
}

function removeFromCart($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        return true;
    }
    return false;
}