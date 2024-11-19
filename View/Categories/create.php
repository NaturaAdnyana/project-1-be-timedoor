<?php
require('../../Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $category_name;
  // Validate product_name
  if (empty($_POST["category_name"])) {
    $errors['category_name'] = "Category Name is required";
  } else {
    $category_name = $_POST["category_name"];
  }

  // If there are no validation errors, proceed with creating the product
  if (empty($errors)) {
    $data = [
      "category_name" => $category_name,
      "isDeleted" => 0
    ];
    if ($categoryController->create($data)) {
      echo "<script>alert('Category added successfully!')</script>";
      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Failed to add category!')</script>";
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
  <main class="container mt-5" style="max-width: 800px; margin: auto;">
    <h2 class="mb-5">Create Category</h2>
    <a href="index.php" class="btn btn-outline-secondary mb-3">
      < Back to Category List</a>
        <div class="card">
          <form action="" method="post" class="card-body">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" id="category_name" name="category_name" class="form-control">
            <?php if (isset($errors['category_name'])) : ?>
              <div class="alert alert-danger mt-2" role="alert">
                <?php echo $errors['category_name']; ?>
              </div>
            <?php endif ?>
            <br>
            <input type="submit" value="Add Category" class="btn btn-primary w-100">
          </form>
        </div>
  </main>
</body>

</html>