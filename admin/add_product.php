<?php
include '../php/db_connect.php';

if (isset($_POST['add_product'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $desc = $_POST['description'];
  
  $image = $_FILES['image']['name'];
  $target = "../images/" . basename($image);
  move_uploaded_file($_FILES['image']['tmp_name'], $target);

  $sql = "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$desc', '$image')";
  mysqli_query($conn, $sql);
  header("Location: index.php");
}

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: ../admin_login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product | Admin</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<header class="admin-header">
  <h1>🌿 SmartGardenBD Admin</h1>
  <nav>
    <a href="index.php">Dashboard</a>
    <a href="add_product.php" class="active">Add Product</a>
    <a href="view_orders.php">View Orders</a>
        <a href="view_messages.php">Messages</a>

    <a href="../php/logout.php" class="logout-btn">Logout</a>

  </nav>
</header>

<section class="admin-content">
  <h2>Add New Product</h2>
  <form method="POST" enctype="multipart/form-data" class="add-form">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" name="price" placeholder="Price (৳)" required>
    <textarea name="description" placeholder="Product Description" required></textarea>
    <input type="file" name="image" accept="image/*" required>
    <button type="submit" name="add_product">Add Product</button>
  </form>
</section>

</body>
</html>
