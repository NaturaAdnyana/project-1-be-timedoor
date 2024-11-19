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
    <main class="container mt-5" style="max-width: 800px; margin: auto;">
        <h2 class="mb-5">Product Details</h2>
        <a href="../../index.php" class="btn btn-outline-secondary mb-3">
            < Back to Product List</a>
                <br><br>
                <?php if (count($row) > 0) : ?>
                    <div class="card">
                        <div class="card-body">
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
                        </div>
                    </div>
                <?php else : ?>
                    <p>0 Result</p>
                <?php endif ?>
    </main>

</body>

</html>