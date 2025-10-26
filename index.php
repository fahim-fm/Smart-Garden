<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartGardenBD | Home</title>
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

<section class="hero">
  <div class="hero-content">
    <h1>Grow Smarter with <span>SmartGardenBD</span></h1>
    <p>Your one-stop shop for smart gardening tools and eco-living products.</p>
    <a href="products.php" class="btn-shop">Shop Now</a>
  </div>
</section>

<section class="features">
  <div class="feature-card">
    <img src="images/plant.jpeg" alt="Plants">
    <h3>Healthy Plants</h3>
    <p>Smart care and maintenance tips for your garden.</p>
  </div>
  <div class="feature-card">
    <img src="images/pots.jpeg" alt="Pots">
    <h3>Eco Pots</h3>
    <p>Beautiful and sustainable pots for modern homes.</p>
  </div>
  <div class="feature-card">
    <img src="images/sensors.jpeg" alt="Sensors">
    <h3>Smart Sensors</h3>
    <p>Track moisture, sunlight, and soil temperature easily.</p>
  </div>
</section>

<footer>
  <p>© 2025 SmartGardenBD | Designed by Rahat</p>
</footer>

</body>
</html>
