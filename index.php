<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php
use Aries\MiniFrameworkStore\Models\Product;

$products      = new Product();
$amounLocale   = 'en_PH';
$pesoFormatter = new NumberFormatter($amounLocale, NumberFormatter::CURRENCY);
?>

<!-- Load external CSS -->
<link rel="stylesheet" href="assets/css/styles.css">

<!-- Gradient-Purple Design (colors only) -->
<style>
/* Store Wrapper background */
.store-wrapper {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    color: #2d3748;
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
}

/* Hero Box */
.hero-box {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    color: #2d3748;
    border-radius: 20px;
    padding: 50px 30px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    text-align: center;
    margin-bottom: 50px;
    position: relative;
    overflow: hidden;
}

.hero-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
}

/* Hero Headings */
.hero-box h1 {
    font-weight: 800;
    font-size: 3.5rem;
    margin-bottom: 15px;
    letter-spacing: 1px;
}

.hero-box p {
    font-size: 1.3rem;
    max-width: 700px;
    margin: 0 auto 25px;
    color: #4a5568;
    opacity: 0.9;
}

/* Product Card */
.product-card {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.25);
}

/* Product Image */
.product-card img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 15px;
    object-fit: cover;
}

/* Product Title */
.product-card .card-title {
    color: #2d3748;
    font-weight: 700;
    font-size: 1.35rem;
    margin-bottom: 10px;
}

/* Price */
.text-success {
    color: #38b2ac !important;
    font-weight: 800;
    font-size: 1.4rem;
    margin-bottom: 15px;
}

/* Description */
.card-text {
    color: #4a5568;
    font-size: 0.95rem;
    margin-bottom: 20px;
}

/* Buttons */
.btn-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 12px 25px;
    border-radius: 30px;
    font-weight: 700;
    border: none;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.35);
}

.btn-modern:hover,
.btn-modern:focus {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-3px);
    box-shadow: 0 8px 22px rgba(102, 126, 234, 0.45);
    color: #fff;
}

.btn-modern i {
    margin-right: 8px;
    font-size: 1.1em;
}

/* Responsive tweaks */
@media (max-width: 768px) {
    .hero-box {
        padding: 40px 20px;
        margin-bottom: 40px;
    }
    .hero-box h1 {
        font-size: 2.5rem;
    }
    .hero-box p {
        font-size: 1rem;
    }
    .product-card {
        padding: 20px;
    }
    .product-card .card-title {
        font-size: 1.2rem;
    }
    .text-success {
        font-size: 1.2rem !important;
    }
    .btn-modern {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .hero-box h1 {
        font-size: 2rem;
    }
    .hero-box p {
        font-size: 0.9rem;
    }
    .product-card {
        margin-bottom: 20px;
    }
}
</style>

<div class="store-wrapper py-4">
    <div class="container">

        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-12">
                <div class="p-4 hero-box text-white" style="
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    border-radius: 12px;
                    padding: 2rem;
                ">
                    <h1 class="display-3 fw-bold">Shop Like There’s No Tomorrow!</h1>
                    <p class="lead">Treat Yourself to Something Amazing.</p>
                </div>
            </div>
        </div>

        <!-- Product Section -->
        <div class="row mb-4">
            <div class="col-5">
                <h2 class="fw-bold">🛒 Your Cart Deserves the Best</h2>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($products->getAll() as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 product-card">
                        <img src="<?php echo $product['image_path'] ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <h6 class="text-success mb-2">
                                <?php echo $pesoFormatter->formatCurrency($product['price'], 'PHP'); ?>
                            </h6>
                            <p class="card-text mb-4">
                                <?php echo strlen($product['description']) > 100
                                    ? substr($product['description'], 0, 100) . '...'
                                    : $product['description']; ?>
                            </p>
                            <div class="mt-auto d-grid gap-2">
                                <a href="product.php?id=<?php echo $product['id'] ?>" class="btn btn-modern btn-view">
                                    <i class="bi bi-eye"></i> View Product
                                </a>
                                <a href="#" class="btn btn-modern btn-cart add-to-cart"
                                   data-productid="<?php echo $product['id'] ?>" data-quantity="1">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>
