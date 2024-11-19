<?php
require_once('../../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();

$row = $productController->show($id);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //validate product_name
    if (empty($_GET["id"])) {
        $errors['id'] = "Product Not Found";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["id"])) {
        $errors['id'] = "Product Not Found";
    }
    // If there are no validation errors, proceed with updating the product
    if (empty($errors)) {
        if ($productController->destroy($id)) {
            header("Location: ../../index.php");
            exit();
        }
    } else {
        echo "Error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        } */
    </style>
</head>

<body class="container mt-4">
    <main class="container mt-5" style="max-width: 800px; margin: auto;">
        <h2 class="mb-5">Delete Product</h2>
        <a href="../../index.php" class="btn btn-outline-secondary mb-3">
            < Back to Product List</a>
                <?php if (count($row) > 0) : ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Are you sure you want to delete the following product?</h4>
                            <table class="mb-3">
                                <tr>
                                    <td>ID</td>
                                    <td>: <?php echo $row[0]["id"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Product Name</td>
                                    <td>: <?php echo $row[0]["product_name"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Category Name</td>
                                    <td>: <?php echo $row[0]["category_name"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Price:</td>
                                    <td>: <?php echo $row[0]["price"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Quantity:</td>
                                    <td>: <?php echo $row[0]["stock"]; ?></td>
                                </tr>
                            </table>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
                                <?php if (isset($errors['id'])) : ?>
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <?php echo $errors['id']; ?>
                                    </div>
                                <?php endif ?>
                                <input type="submit" value="Delete Product" class="btn btn-danger w-100">
                            </form>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="alert alert-danger mt-2">Data not found!</p>
                <?php endif ?>
    </main>
</body>

</html>