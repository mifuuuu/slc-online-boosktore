<?php require_once "../includes/admin_header.php"; requireAdmin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Admin Dashboard</h1>

    <!-- Stats Cards -->
     <h1>statistics</h1>
        <div class="stats">
            <div class="card">
                <p>Total Pending Orders</p>
                <h2 id="pendingCount">0</h2>
            </div>
        </div>

        <div class="stats">
            <div class="card">
                <p>Total Completed Orders</p>
                <h2 id="completedCount">0</h2>
            </div>
        </div>

        <!-- Low Stock Alerts -->
    <h2>Low Stock Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>SKU Code</th>
                <th>Item Name</th>
                <th>Image</th>
                <th>Stock</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody id="low_on_stock_items">
        </tbody>
    </table>

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
</div>
<script src="../assets/js/get_orders.js"></script>
<script src="../assets/js/get_items.js"></script>
<?php require_once "../includes/footer.php"; ?>
</body>
</html>
