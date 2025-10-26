<?php
session_start();
include 'php/db_connect.php';

// Add item to cart
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  
  // Fetch product info
  $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$product_id");
  $product = mysqli_fetch_assoc($result);

  if ($product) {
    $item = [
      'id' => $product['id'],
      'name' => $product['name'],
      'price' => $product['price'],
      'image' => $product['image'],
      'quantity' => 1
    ];

    // Check if cart exists
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
      if ($cartItem['id'] == $item['id']) {
        $cartItem['quantity']++;
        $found = true;
        break;
      }
    }

    if (!$found) {
      $_SESSION['cart'][] = $item;
    }
  }

  header("Location: cart.php");
  exit();
}

// Remove item
if (isset($_GET['remove'])) {
  $id = $_GET['remove'];
  foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['id'] == $id) {
      unset($_SESSION['cart'][$key]);
    }
  }
  $_SESSION['cart'] = array_values($_SESSION['cart']);
  header("Location: cart.php");
  exit();
}

// Clear all
if (isset($_GET['clear'])) {
  unset($_SESSION['cart']);
  header("Location: cart.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart | SmartGardenBD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">
  <img src="images/logo.jpg" alt="SmartGardenBD Logo" class="logo-img">
  
</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="products.php">Shop</a>
    <a href="cart.php" class="active">Cart</a>
    <a href="contact.php">Contact</a>
  </nav>
</header>

<section class="cart-section">
  <h2 class="section-title">Your Shopping Cart</h2>

  <?php if (!empty($_SESSION['cart'])): ?>
    <table class="cart-table">
      <tr>
        <th>Product</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
      <?php 
      $grand_total = 0;
      foreach ($_SESSION['cart'] as $item): 
        $total = $item['price'] * $item['quantity'];
        $grand_total += $total;
      ?>
      <tr>
        <td><img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>"></td>
        <td><?php echo $item['name']; ?></td>
        <td>৳<?php echo number_format($item['price'], 2); ?></td>
        <td><?php echo $item['quantity']; ?></td>
        <td>৳<?php echo number_format($total, 2); ?></td>
        <td><a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn-remove">Remove</a></td>
      </tr>
      <?php endforeach; ?>
    </table>

    <div class="cart-summary">
      <p><strong>Grand Total:</strong> ৳<?php echo number_format($grand_total, 2); ?></p>
      <div class="cart-buttons">
        <a href="checkout.php" class="btn-shop">Proceed to Checkout</a>
        <a href="cart.php?clear=all" class="btn-clear">Clear Cart</a>
      </div>
    </div>

  <?php else: ?>
    <p class="empty-cart">Your cart is empty 😢</p>
    <a href="products.php" class="btn-shop">Go Shopping</a>
  <?php endif; ?>
</section>

<footer>
  <p>© 2025 SmartGardenBD | Designed by Rahat</p>
</footer>

</body>
</html>
