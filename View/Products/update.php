<?php
include('../../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();
$categoryController = new CategoryController();

// call product detail
$row = $productController->show($id);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validate product_name
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

    // If there are no validation errors, proceed with updating the product
    if (empty($errors)) {
        $data = [
            'product_name' => $product_name,
            'category_id' => $category,
            'price' => $price,
            'stock' => $stock
        ];

        if ($productController->update($id, $data)) {
            header("Location: ../../index.php");
        } else {
            echo "Error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Update Product</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h2>Update Product</h2>
    <a href="../../index.php">Back to Product List</a>
    <br><br>
    <?php if (count($row) > 0) : ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" value="<?php echo $row[0]['product_name']; ?>" required><br>
            <label for="category">Category: </label>
            <select name="category" id="category">
                <?php if (count($categoryController->index()) > 0) : ?>
                    <?php $counter = 1 ?>
                    <?php foreach ($categoryController->index() as $category) : ?>
                        <option value="<?= $category["id"] ?>" <?php echo $category["id"] === $row[0]['category_id'] ? 'selected' : '' ?>><?= $category["category_name"] ?></option>
                        <?php $counter++ ?>
                    <?php endforeach ?>
                <?php else : ?>
                    <option>--Belum ada data, buat kategori dahulu.</option>
                <?php endif ?>
            </select><br>
            <label for="price">Price:</label>
            <input type="number" name="price" value="<?php echo $row[0]['price']; ?>"
                required><br>
            <label for="stock">Stock:</label>
            <input type="number" name="stock" value="<?php echo $row[0]['stock']; ?>"
                required><br>
            <input type="submit" value="Update Product">
        </form>
    <?php else : ?>
        <p>Data not found</p>
    <?php endif ?>
</body>

</html>