<?php
require_once __DIR__ . '/vendor/autoload.php';   // ← adjust one “..” if file is deeper
require_once __DIR__ . '/helpers/functions.php';

use Aries\MiniFrameworkStore\Models\Product;

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$productId = $_GET['id'];
$products = new Product();
$product = $products->getById($productId);

$amounLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amounLocale, NumberFormatter::CURRENCY);

template('header.php');
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $product['image_path'] ?>" alt="Product Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1><?php echo $product['name'] ?></h1>
            <h4 class="text-body-secondary">
                <?php echo $pesoFormatter->formatCurrency($product['price'], 'PHP'); ?>
            </h4>
            <p><?php echo $product['description']; ?></p>
            <div class="d-flex">
                <a href="#" class="btn btn-success mr-2 add-to-cart"
                   data-product-id="<?php echo $product['id']; ?>"
                   data-qty="1">
                    Add to Cart
                </a>
            </div>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>
