<?php
// Start session and authentication check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../authentication.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/admin_header.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="../uploads/logo/slc-logo.png" alt="SLC Bookstore Logo" height="50">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    </div>
    <nav>
        <a href="admin_home.php">Home</a>
        <a href="manage_inventory.php">Inventory</a>
        <a href="manage_staff.php">Staff</a>
        <a href="reports.php">Reports</a>
        <a href="../includes/logout.php" class="logout-btn">Logout</a>
    </nav>
</header>
<main>
    