<?php include '../php/db_connect.php'; ?>
<?php
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
  <title>Orders | SmartGardenBD Admin</title>
  <link rel="stylesheet" href="css/admin.css">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }
    th {
      background: #2e7d32;
      color: white;
    }
    tr:nth-child(even) {
      background: #f9fff9;
    }

    .expand-btn {
      background: #81c784;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      font-size: 0.9em;
      border: none;
    }
    .expand-btn:hover {
      background: #66bb6a;
    }

    .items-row {
      display: none;
      background: #f1f8f1;
    }
    .items-row td {
      text-align: left;
    }
  </style>
</head>
<body>

<header class="admin-header">
  <h1>🌿 SmartGardenBD Admin</h1>
  <nav>
    <a href="index.php">Dashboard</a>
    <a href="add_product.php">Add Product</a>
    <a href="view_orders.php" class="active">View Orders</a>
    <a href="view_messages.php">Messages</a>
    <a href="../php/logout.php" class="logout-btn">Logout</a>
  </nav>
</header>

<section class="admin-content">
  <h2>Customer Orders</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Customer</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Total</th>
      <th>Date</th>
      <th>Payment</th>
      <th>Items</th>
    </tr>
    <?php
    $orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
    while ($order = mysqli_fetch_assoc($orders)) {

        // Fetch items for this order
        $items_result = mysqli_query($conn, "SELECT * FROM order_items oi JOIN products p ON oi.product_id=p.id WHERE order_id={$order['id']}");
        $items_list = "<ul style='padding-left:15px;margin:0;'>";
        while ($item = mysqli_fetch_assoc($items_result)) {
            $items_list .= "<li>{$item['name']} (x{$item['quantity']}) - ৳{$item['subtotal']}</li>";
        }
        $items_list .= "</ul>";

        echo "
        <tr>
          <td>{$order['id']}</td>
          <td>{$order['customer_name']}</td>
          <td>{$order['phone']}</td>
          <td>{$order['address']}</td>
          <td>৳{$order['total']}</td>
          <td>{$order['order_date']}</td>
          <td>{$order['payment_method']}</td>
          <td><button class='expand-btn' onclick='toggleItems({$order['id']})'>View Items</button></td>
        </tr>
        <tr class='items-row' id='items-{$order['id']}'>
          <td colspan='8'>{$items_list}</td>
        </tr>";
    }
    ?>
  </table>
</section>

<script>
  function toggleItems(orderId) {
    const row = document.getElementById(`items-${orderId}`);
    row.style.display = row.style.display === 'table-row' ? 'none' : 'table-row';
  }
</script>

</body>
</html>
