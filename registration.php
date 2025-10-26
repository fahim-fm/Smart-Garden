<?php
session_start();
include 'php/db_connect.php';

$error = '';
$success = '';

if(isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $error = "Email already registered!";
    } else {
        mysqli_query($conn, "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')");
        $success = "Registration successful! You can now login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | SmartGardenBD</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background: linear-gradient(to right, #81c784, #4caf50);
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .navbar {
      width: 100%;
      padding: 15px 8%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #2e7d32;
      color: white;
      position: fixed;
      top: 0;
      z-index: 100;
    }

    .navbar .logo {
      font-size: 1.5em;
      font-weight: bold;
    }

    .navbar nav a, .user-dropdown {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: 500;
      cursor: pointer;
      position: relative;
    }

    .user-dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      top: 28px;
      right: 0;
      background-color: white;
      color: #2e7d32;
      min-width: 160px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #2e7d32;
    }

    .dropdown-content a:hover {
      background-color: #81c784;
      color: white;
    }

    .login-section {
      background: white;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-top: 80px;
    }

    .login-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.3);
    }

    .login-section h2 {
      margin-bottom: 25px;
      color: #2e7d32;
    }

    .login-form input {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      outline: none;
      transition: border 0.3s ease;
    }

    .login-form input:focus {
      border-color: #4caf50;
    }

    .login-form button {
      background: #4caf50;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 25px;
      width: 100%;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      margin-top: 10px;
    }

    .login-form button:hover {
      background: #388e3c;
      transform: scale(1.05);
    }

    .login-form a {
      color: #4caf50;
      text-decoration: none;
      font-weight: 500;
    }

    .login-form a:hover {
      color: #2e7d32;
    }

    p.error-message {
      color: red;
      margin-bottom: 15px;
      font-weight: 500;
    }

    p.success-message {
      color: green;
      margin-bottom: 15px;
      font-weight: 500;
    }

    .back-home {
      margin-top: 15px;
      display: inline-block;
      color: #2e7d32;
      text-decoration: none;
      font-weight: 500;
      padding: 6px 12px;
      border: 1px solid #2e7d32;
      border-radius: 20px;
      transition: 0.3s;
    }

    .back-home:hover {
      background-color: #2e7d32;
      color: white;
    }

    @media (max-width: 480px) {
      .login-section {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<header class="navbar">
  <div class="logo">🌿 SmartGardenBD</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="products.php">Shop</a>
    <a href="contact.php">Contact</a>

    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
      <div class="user-dropdown">
        <?php echo $_SESSION['user_name']; ?>
        <div class="dropdown-content">
          <a href="profile.php">Profile</a>
          <a href="view_orders_user.php">My Orders</a>
          <a href="php/logout_user.php">Logout</a>
        </div>
      </div>
    <?php else: ?>
      <a href="login_user.php" class="btn-login">Login</a>
    <?php endif; ?>
  </nav>
</header>

<section class="login-section">
  <h2 class="section-title">User Registration</h2>

  <?php 
  if($error) echo "<p class='error-message'>$error</p>"; 
  if($success) echo "<p class='success-message'>$success</p>"; 
  ?>

  <form method="POST" class="login-form">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="register">Register</button>
      <p style="margin-top:10px;">Already have an account? <a href="login_user.php">Login</a></p>
  </form>

  <a href="index.php" class="back-home">Back to Home</a>
</section>

</body>
</html>
