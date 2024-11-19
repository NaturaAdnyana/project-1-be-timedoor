<?php
require_once(__DIR__ . '/Config/init.php');

$productController = new ProductController();

// call product index

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreAllProducts"])) {
    $productController->restore();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Lists</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="View/Categories/index.php">Categories</a></li>
        </ul>
    </div>
    </nav>
    <main class="container">
        <h2>Product List</h2>
        <a href="view/products/create.php">Add Product</a>
        <br><br>
        <table class="table">
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php if (count($productController->index()) > 0) : ?>
            <?php $counter = 1 ?>
            <?php foreach ($productController->index() as $product) : ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $product["product_name"] ?></td>
                <td><?php echo $product["category_name"] ?></td>
                <td><?php echo $product["price"] ?></td>
                <td><?php echo $product["stock"] ?></td>
                <td>
                <a href="View/Products/detail.php?id=<?php echo $product["id"] ?>">View</a> |
                <a href="View/Products/update.php?id=<?php echo $product["id"] ?>">Update</a> |
                <a href="View/Products/delete.php?id=<?php echo $product["id"] ?>">Delete</a>
                </td>
            </tr>
            <?php $counter++ ?>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td colspan="5">0 result</td>
            </tr>
        <?php endif ?>
        </table>
    </main>
</body>

</html>