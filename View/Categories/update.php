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
    <?php if (count($row) > 0) : ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" value="<?php echo $row[0]['category_name']; ?>" required><br>
            <input type="submit" value="Update Category">
        </form>
    <?php else : ?>
        <p>Data not found</p>
    <?php endif ?>
</body>

</html>