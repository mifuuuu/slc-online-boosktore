<?php
// Start session and authentication check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($page_title) ? $page_title : 'Dashboard'; ?></title>
    <link rel="stylesheet" href="../assets/css/admin_header.css">
</head>
<body>

<header>
    <div class="logo">
        <h1>logo</h1>
    </div>
    <nav>
        <a href="admin_dashboard.php">Home</a>
        <a href="manage_inventory.php">Inventory</a>
        <a href="manage_staff.php">Staff</a>
        <a href="reports.php">Reports</a>
        <a href="../includes/logout.php" class="logout-btn">Logout</a>
    </nav>
</header>

<main>
