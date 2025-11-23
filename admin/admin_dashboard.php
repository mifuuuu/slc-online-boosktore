<?php
require_once "../includes/admin_header.php";
requireAdmin(); 
?>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<?php require_once "../includes/footer.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            flex: 1;
            min-width: 200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h2 {
            margin: 0;
            font-size: 2em;
            color: #2c3e50;
        }
        .card p {
            margin: 5px 0 0;
            font-weight: bold;
            color: #7f8c8d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .low-stock {
            margin-top: 30px;
        }
        .low-stock ul {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            list-style-type: none;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
        }
        .low-stock li {
            padding: 8px 0;
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
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
                <th>Items</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#001</td>
                <td>Juan Dela Cruz</td>
                <td>Notebook, Pencil</td>
                <td>$15</td>
                <td>Pending</td>
            </tr>
            <tr>
                <td>#002</td>
                <td>Maria Santos</td>
                <td>Pen, Eraser</td>
                <td>$8</td>
                <td>Completed</td>
            </tr>
            <tr>
                <td>#003</td>
                <td>Carlos Reyes</td>
                <td>Notebook</td>
                <td>$5</td>
                <td>Pending</td>
            </tr>
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

</body>
</html>
