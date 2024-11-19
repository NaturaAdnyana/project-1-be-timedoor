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

    // If there are no validation errors, proceed with updating the product
    if (empty($errors)) {
        if ($productController->destroy($id)) {
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
    <h2>Delete Product</h2>
    <a href="../../index.php">Back to Product List</a>
    <br><br>
    <?php if (count($row) > 0) : ?>
        <p>Are you sure you want to delete the following product?</p>
        <table>
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
        <form action="" method="get">
            <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
            <input type="submit" value="Delete Product">
        </form>
    <?php else : ?>
        <p>Data not found!</p>
    <?php endif ?>
</body>

</html>