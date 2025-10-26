<?php
session_start();
include 'php/db_connect.php';

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
  header("Location: products.php");
  exit();
}

if (isset($_POST['place_order'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $payment_method = $_POST['payment_method']; // NEW
  $total = $_POST['total'];
  $order_date = date("Y-m-d H:i:s");

  $sql = "INSERT INTO orders (customer_name, phone, address, payment_method, total, order_date)
          VALUES ('$name', '$phone', '$address', '$payment_method', '$total', '$order_date')";
  mysqli_query($conn, $sql);

  $order_id = mysqli_insert_id($conn);

  foreach ($_SESSION['cart'] as $id => $item) {
    $pid = $item['id'];
    $qty = $item['quantity'];
    $price = $item['price'];
    $subtotal = $price * $qty;

    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal)
                         VALUES ('$order_id', '$pid', '$qty', '$price', '$subtotal')");
  }

  unset($_SESSION['cart']);
  header("Location: success.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | SmartGardenBD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="images/logo.jpg" alt="SmartGardenBD Logo" class="logo-img">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="products.php">Shop</a>
      <a href="cart.php">Cart</a>
      <a href="checkout.php" class="active">Checkout</a>
    </nav>
  </header>

  <section class="checkout-section">
    <h2>Checkout</h2>

    <form method="POST" class="checkout-form">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <textarea name="address" placeholder="Delivery Address" required></textarea>

   <!-- Payment Method -->
<div class="checkout-payment">
  <h3>Payment Method</h3>

  <input type="radio" id="cod" name="payment_method" value="Cash on Delivery" required>
  <label for="cod">
    <img src="images/cod.png" alt="Cash on Delivery" class="payment-icon"> Cash on Delivery
  </label>

  <input type="radio" id="bkash" name="payment_method" value="Bkash" required>
  <label for="bkash">
    <img src="images/bkash.jpg" alt="Bkash" class="payment-icon"> Bkash
  </label>

  <input type="radio" id="rocket" name="payment_method" value="Rocket" required>
  <label for="rocket">
    <img src="images/rocket.png" alt="Rocket" class="payment-icon"> Rocket
  </label>

  <input type="radio" id="nagad" name="payment_method" value="Nagad" required>
  <label for="nagad">
    <img src="images/nagad.png" alt="Nagad" class="payment-icon"> Nagad
  </label>
</div>



      <div class="checkout-summary">
        <h3>Order Summary</h3>
        <ul>
          <?php
          $total = 0;
          foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            echo "<li>{$item['name']} (x{$item['quantity']}) - ৳$subtotal</li>";
          }
          ?>
        </ul>
        <p class="checkout-total">Total: <strong>৳<?php echo $total; ?></strong></p>
        <input type="hidden" name="total" value="<?php echo $total; ?>">
      </div>

      <button type="submit" name="place_order" class="btn-checkout">Place Order</button>
    </form>
  </section>

  <footer>
    <p>© 2025 SmartGardenBD | Designed by Rahat</p>
  </footer>

</body>
</html>
