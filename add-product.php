<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\Category;
use Aries\MiniFrameworkStore\Models\Product;
use Carbon\Carbon;

$categories = new Category();
$product = new Product();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_FILES['image'];

    // Validate and process the image file
    if ($image['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $targetFile);
    }

    // Insert the product into the database
    $product->insert([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'slug' => strtolower(str_replace(' ', '-', $name)),
        'image_path' => $targetFile,
        'category_id' => $category,
        'created_at' => Carbon::now('Asia/Manila'),
        'updated_at' => Carbon::now()
    ]);

    $message = "Product added successfully!";
}
?>

<!-- New Modern Gradient Style (Colors Only) -->
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        font-family: 'Inter', sans-serif;
    }

    .product-form-wrapper {
        background: transparent;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .card h2.text-primary {
        color: #667eea !important;
    }

    .text-muted {
        color: #718096 !important;
    }

    .form-control,
    .form-select {
        background-color: #ffffff;
        border: 2px solid #e2e8f0;
        color: #2d3748;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background-color: #ffffff;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        font-weight: 600;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    .btn-primary:active {
        transform: translateY(0);
    }
</style>

<!-- Product Page Wrapper with Background Gradient -->
<div class="product-form-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 fw-bold text-primary">Add Products</h2>
                        <p class="text-center text-muted mb-4">Fill in the details below to add the new Product.</p>

                        <?php if (isset($message)): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <form action="add-product.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control rounded-pill px-4" id="productName" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea class="form-control rounded-4 px-4" id="productDescription" name="description" rows="5" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control rounded-pill px-4" id="productPrice" name="price" required>
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Type of Product</label>
                                <select class="form-select rounded-pill px-4" id="productCategory" name="category" required>
                                    <option value="" selected disabled>Select Types of Product</option>
                                    <?php foreach ($categories->getAll() as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="productImage" class="form-label">Image</label>
                                <input class="form-control rounded-pill px-4" type="file" id="productImage" name="image" accept="image/*">
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg rounded-pill">Add New Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>
