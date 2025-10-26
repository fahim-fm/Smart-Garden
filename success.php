<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Success | SmartGardenBD</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .success-section {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 70vh;
      text-align: center;
      padding: 20px;
    }

    .success-section h1 {
      font-size: 2.5em;
      color: #2e7d32;
      margin-bottom: 20px;
      animation: popIn 1s ease;
    }

    .success-section p {
      font-size: 1.2em;
      margin-bottom: 30px;
    }

    .btn-home {
      background: #81c784;
      color: white;
      padding: 12px 25px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
      transition: background 0.3s, transform 0.2s;
    }

    .btn-home:hover {
      background: #66bb6a;
      transform: scale(1.05);
    }

    @keyframes popIn {
      0% { transform: scale(0.5); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

  </style>
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
    <a href="contact.php">Contact</a>
  </nav>
</header>

<!-- Success Section -->
<section class="success-section">
  <img src="images/sucess.png" alt="Order Success" style="width:100px; margin-bottom:20px;">
  <h1>Thank You!</h1>
  <p>Your order has been placed successfully.<br>We will process it and deliver it to you soon.</p>
  <a href="products.php" class="btn-home">Continue Shopping</a>
</section>

<footer>
    <p>© 2025 SmartGardenBD | Designed by Rahat</p>

</footer>

</body>
</html>
