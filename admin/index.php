<?php include '../php/db_connect.php'; 
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
  <title>Admin Dashboard | SmartGardenBD</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<header class="admin-header">
  <h1>🌿 SmartGardenBD Admin Panel</h1>
  <nav>
    <a href="index.php" class="active">Dashboard</a>
    <a href="add_product.php">Add Product</a>
    <a href="view_orders.php">View Orders</a>
            <a href="view_messages.php">Messages</a>

        <a href="../php/logout.php" class="logout-btn">Logout</a>

  </nav>
</header>

<section class="admin-content">
  <h2>All Products</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Name</th>
      <th>Price</th>
      <th>Description</th>
      <th>Action</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM products");
    while ($row = mysqli_fetch_assoc($result)) {
      echo "
      <tr>
        <td>{$row['id']}</td>
        <td><img src='../images/{$row['image']}' width='60'></td>
        <td>{$row['name']}</td>
        <td>৳{$row['price']}</td>
        <td>".substr($row['description'], 0, 60)."...</td>
        <td>
          <a href='delete_product.php?id={$row['id']}' class='btn-delete'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </table>
</section>

<footer class="admin-footer">
  <p>© 2025 SmartGardenBD | Admin Dashboard</p>
</footer>

</body>
</html>
