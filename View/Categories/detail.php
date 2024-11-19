<?php
include('../../Config/init.php');

$id = $_GET['id'];

$categoryController = new CategoryController();

$row = $categoryController->show($id);

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

        table {
            max-width: 500px;
            margin-top: 20px;
        }

        /* table td,
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
  <h2>Category Details</h2>
    <a href="index.php">Back to Category List</a>
    <br><br>
    <?php if (count($row) > 0) : ?>
      <table>
        <tr>
          <td>ID</td>
          <td>: <?php echo $row[0]["id"]; ?></td>
        </tr>
        <tr>
          <td>Category Name</td>
          <td>: <?php echo $row[0]["category_name"]; ?></td>
        </tr>
      </table>
    <?php else : ?>
      <p>0 Result</p>
    <?php endif ?>
</body>

</html>