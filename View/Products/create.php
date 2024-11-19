<?php
require('../../Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate product_name
    if (empty($_POST["product_name"])) {
        $errors['product_name'] = "Product Name is required";
    } else {
        $product_name = $_POST["product_name"];
    }

    if (empty($_POST["category"])) {
        $errors['category'] = "Category is required";
    } else {
        $category = $_POST["category"];
    }

    // Validate price
    if (empty($_POST["price"])) {
        $errors['price'] = "Price is required";
    } else if (is_numeric($_POST["price"]) == false) {
        $errors['price'] = "Price must be a number";
    } else if (floatval($_POST["price"]) <= 0) {
        $errors['price'] = "Price should be greater than zero";
    } else {
        $price = $_POST["price"];
    }

    // Validate quantity
    if (!isset($_POST["stock"]) || empty($_POST["stock"])) {
        $errors['stock'] = "Stock is required";
    } else if (!is_numeric($_POST["stock"])) {
        $errors['stock'] = "Stock must be a valid number";
    } else if ((int)$_POST["stock"] < 0) {
        $errors['stock'] = "Stock cannot be negative";
    } else if ($_POST["stock"] != (string)(int)$_POST["stock"]) {
        $errors['stock'] = "Stock must be an integer";
    } else {
        $stock = $_POST["stock"];
    }

    // If there are no validation errors, proceed with creating the product
    if (empty($errors)) {
        $data = [
            'product_name' => $product_name,
            'category_id' => $category,
            'price' => $price,
            'stock' => $stock,
            "isDeleted" => 0
        ];

        if ($productController->create($data)) {
            echo "<script>alert('Product added successfully!')</script>";
            header("Location: ../../index.php");
            exit();
        } else {
            echo "<script>alert('Failed to add product!')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <main class="container mt-5 mb-5" style="max-width: 800px; margin: auto;">
        <h2 class="mb-5">Create Product</h2>
        <a href="../../index.php" class="btn btn-outline-secondary mb-3">
            < Back to Product List</a>
                <div class="card">
                    <form action="" method="post" class="card-body">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control">
                        <?php if (isset($errors['product_name'])) : ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                <?php echo $errors['product_name']; ?>
                            </div>
                        <?php endif ?>
                        <br>
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-select">
                            <?php if (count($categoryController->index()) > 0) : ?>
                                <?php $counter = 1 ?>
                                <?php foreach ($categoryController->index() as $category) : ?>
                                    <option value="<?= $category["id"] ?>"><?= $category["category_name"] ?></option>
                                    <?php $counter++ ?>
                                <?php endforeach ?>
                            <?php else : ?>
                                <option>--Belum ada data, buat kategori dahulu.</option>
                            <?php endif ?>
                        </select>
                        <?php if (isset($errors['category'])) : ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                <?php echo $errors['category']; ?>
                            </div>
                        <?php endif ?>
                        <br>
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control">
                        <?php if (isset($errors['price'])) : ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                <?php echo $errors['price']; ?>
                            </div>
                        <?php endif ?>
                        <br>
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="number" name="stock" class="form-control">
                        <?php if (isset($errors['stock'])) : ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                <?php echo $errors['stock']; ?>
                            </div>
                        <?php endif ?>
                        <br>
                        <input type="submit" value="Add Product" class="btn btn-primary w-100">
                    </form>
                </div>
    </main>
</body>

</html>