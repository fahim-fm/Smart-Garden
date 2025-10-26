<?php 
session_start();
include 'php/db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartGardenBD | Products</title>
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
    <a href="products.php" class="active">Shop</a>
    <a href="contact.php">Contact</a>

    <?php if(isset($_SESSION['user_logged_in'])): ?>
        <div class="dropdown">
            <a href="#" class="user-name"><?php echo $_SESSION['user_name']; ?> ▼</a>
            <div class="dropdown-content">
                <p>Name: <?php echo $_SESSION['user_name']; ?></p>
                <p>Email: <?php echo $_SESSION['user_email']; ?></p>
                <a href="logout_user.php">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <a href="login_user.php" class="btn-login">Login</a>
    <?php endif; ?>
  </nav>
</header>

<!-- Product Section -->
<section class="product-section">
  <h2 class="section-title">Our Products</h2>
  <div class="product-grid">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM products");
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='product-card'>
                  <img src='images/{$row['image']}' alt='{$row['name']}'>
                  <h3>{$row['name']}</h3>
                  <p class='price'>৳ {$row['price']}</p>
                  <p class='desc'>".substr($row['description'], 0, 60)."...</p>";

          // Show Add to Cart only if user is logged in
          if(isset($_SESSION['user_logged_in'])){
              echo "<a href='cart.php?id={$row['id']}' class='btn-cart'>Add to Cart</a>";
          } else {
              echo "<a href='login_user.php' class='btn-cart'>Login to Add</a>";
          }

          echo "</div>";
      }
    } else {
      echo "<p class='no-products'>No products available right now.</p>";
    }
    ?>
  </div>
</section>

<!-- Footer -->
<footer>
  <p>© 2025 SmartGardenBD | Designed by Rahat</p>
</footer>

</body>
</html>
