<?php require_once "../includes/headers/staff_header.php"; requireStaff(); ?>
<script> const userRole = "<?php echo $_SESSION['role']; ?>";</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Home</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Staff Dashboard</h1>
    
    <!-- Orders Section -->
    <h2>Orders</h2>
    <div class="orders-cards" id="ordersCardsContainer"><!-- Order cards will appear here --></div>

    <!-- Stats Cards -->
    <h2>Statistics</h2>
    <div class="stats">
        <div class="card">
            <p>Total Pending Orders</p>
            <h2 id="pendingCount">0</h2>
        </div>
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

</div>

<script src="../assets/js/orders.js"></script>
<script src="../assets/js/staff_items.js"></script>
<?php include_once "../includes/modal/modals.php"; ?>
<?php require_once "../includes/footer.php"; ?>
</body>
</html>
