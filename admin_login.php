<?php
session_start();
include 'php/db_connect.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Fetch admin user
  $query = "SELECT * FROM admin WHERE username='$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      $_SESSION['admin_logged_in'] = true;
      $_SESSION['admin_username'] = $username;
      header("Location: admin/index.php");
      exit();
    } else {
      $error = "Incorrect password!";
    }
  } else {
    $error = "No such user!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | SmartGardenBD</title>
  <link rel="stylesheet" href="admin/css/admin.css">
</head>
<body>

<section class="login-section">
  <form method="POST" class="login-form">
    <h2>🌿 Admin Login</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
  </form>
</section>

</body>
</html>
