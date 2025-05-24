<?php
header('Content-Type: application/json');
session_start();

require_once 'vendor/autoload.php';
require_once 'helpers/functions.php';

use Aries\MiniFrameworkStore\Models\Product;

$response = ['status' => 'error', 'message' => 'An error occurred', 'cart_count' => 0];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    $productId = filter_input(INPUT_POST, 'productId', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, [
        'options' => ['default' => 1, 'min_range' => 1]
    ]);

    if (!$productId) {
        throw new Exception('Invalid product ID');
    }

    if (addToCart($productId, $quantity)) {
        $response = [
            'status' => 'success',
            'message' => 'Product added to cart',
            'cart_count' => countCart(),
            'item' => $_SESSION['cart'][$productId]
        ];
    } else {
        throw new Exception('Failed to add product to cart');
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);