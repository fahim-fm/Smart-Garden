<?php
session_start();
include '../php/db_connect.php';

// Optional: Add admin authentication here

$result = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages | Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<header class="admin-header">
    <h1>🌿 SmartGardenBD Admin</h1>
    <nav>
        <a href="index.php">Dashboard</a>
        <a href="add_product.php">Add Product</a>
        <a href="view_orders.php">View Orders</a>
    
        <a href="view_messages.php" class="active">Messages</a>
        <a href="../php/logout.php" class="logout-btn">Logout</a>
    </nav>
</header>

<section class="admin-content">
    <h2>Contact Messages</h2>

    <?php if(mysqli_num_rows($result) > 0): ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</section>

</body>
</html>
