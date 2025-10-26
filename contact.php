<?php
include 'php/db_connect.php';
$message_sent = false;

if(isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    if(mysqli_query($conn, $sql)) {
        $message_sent = true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | SmartGardenBD</title>
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
    <a href="contact.php" class="active">Contact</a>
  </nav>
</header>

<section class="contact-section">
  <h2 class="section-title">Contact Us</h2>

  <?php if($message_sent): ?>
      <p style="color:green;">✅ Your message has been sent successfully!</p>
  <?php endif; ?>

  <form method="POST" class="contact-form">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <input type="text" name="subject" placeholder="Subject" required>
      <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
      <button type="submit" name="send_message">Send Message</button>
  </form>
</section>

<footer>
  <p>© 2025 SmartGardenBD | Designed by Rahat</p>
</footer>

</body>
</html>
