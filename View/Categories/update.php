<?php
include('../../Config/init.php');

$id = $_GET['id'];

$categoryController = new CategoryController();
// call product detail
$row = $categoryController->show($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreAllCategory"])) {
    $categoryController->restore();
    header("Location: index.php");
}


$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validate product_name
    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category Name is required";
    } else {
        $category_name = $_POST["category_name"];
    }

    // If there are no validation errors, proceed with updating the product
    if (empty($errors)) {
        $data = [
            "id" => $id,
            "category_name" => $category_name
        ];

        if ($categoryController->update($id, $data)) {
            header("Location: index.php");
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

        /* form {
            max-width: 600px;
            margin: auto;
        }

        label {
            margin-top: 10px;
        } */
    </style>
</head>

<body>
    <main class="container mt-5" style="max-width: 800px; margin: auto;">
        <h2 class="mb-5">Edit Category</h2>
        <a href="index.php" class="btn btn-outline-secondary mb-3">
            < Back to Category List</a>
                <?php if (count($row) > 0) : ?>
                    <div class="card">
                        <form action="" method="post" class="card-body">
                            <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" value="<?php echo $row[0]['category_name']; ?>" class="form-control">
                            <?php if (isset($errors['category_name'])) : ?>
                                <div class="alert alert-danger mt-2" role="alert">
                                    <?php echo $errors['category_name']; ?>
                                </div>
                            <?php endif ?>
                            <br>
                            <input type="submit" value="Update Category" class="btn btn-primary w-100">
                        </form>
                    </div>
                <?php else : ?>
                    <p>Data not found</p>
                <?php endif ?>
    </main>
</body>

</html>