<?php
require_once "../includes/admin_header.php";
requireAdmin(); 
?>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Admin Dashboard - Home</h1>

    <!-- Stats Cards -->
    <div class="stats">
        <div class="card">
            <h2>120</h2>
            <p>Total Products</p>
        </div>
        <div class="card">
            <h2>75</h2>
            <p>Total Orders</p>
        </div>
        <div class="card">
            <h2>200</h2>
            <p>Registered Users</p>
        </div>
        <div class="card">
            <h2>$1,500</h2>
            <p>Total Revenue</p>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <h2>Recent Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Total</th>
                <th>Payment Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="recent_orders_table_body">
        </tbody>
    </table>

    <!-- Low Stock Alerts -->
    <div class="low-stock">
        <h2>Low Stock Alerts</h2>
        <ul>
            <li>Pencils - Only 3 left</li>
            <li>Notebooks - Only 2 left</li>
            <li>Markers - Only 5 left</li>
        </ul>
    </div>
</div>
<script src="../assets/js/get-orders.js"></script>
</body>
</html>
