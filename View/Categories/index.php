<?php
require_once('../../Config/init.php');

$categoryController = new CategoryController();

// call product index

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreAllCategory"])) {
    $categoryController->restore();
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
    <nav class="navbar navbar-expand-lg bg-black">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="../../index.php">Products</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="">Categories</a></li>
            </ul>
        </div>
    </nav>
    <main class="container mt-5">
        <h2 class="mb-5">Category List</h2>
        <a href="create.php" class="btn btn-outline-success">+ Add Category</a>
        <br><br>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($categoryController->index()) > 0) : ?>
                    <?php $counter = 1 ?>
                    <?php foreach ($categoryController->index() as $category) : ?>
                        <tr>
                            <td><?php echo $counter ?></td>
                            <td><?php echo $category["category_name"] ?></td>
                            <td>
                                <a href="detail.php?id=<?php echo $category["id"] ?>" class="btn btn-primary">View</a>
                                <a href="update.php?id=<?php echo $category["id"] ?>" class="btn btn-warning">Update</a>
                                <a href="delete.php?id=<?php echo $category["id"] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $counter++ ?>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">0 result</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </main>
</body>

</html>