<?php
include('../../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();

$row = $productController->show($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        /* table {
            width: 100%;
            margin-top: 20px;
        }

        table td,
        table th {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        } */

        a {
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>Product Details</h2>
    <a href="../../index.php">Back to Product List</a>
    <br><br>
    <?php if (count($row) > 0) : ?>
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
                <td>Category</td>
                <td>: <?php echo $row[0]["category_name"]; ?></td>
            </tr>
            <tr>
                <td>Price</td>
                <td>: <?php echo $row[0]["price"]; ?></td>
            </tr>
            <tr>
                <td>Stocks</td>
                <td>: <?php echo $row[0]["stock"]; ?></td>
            </tr>
        </table>
    <?php else : ?>
        <p>0 Result</p>
    <?php endif ?>

</body>

</html>