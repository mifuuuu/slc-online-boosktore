<?php require_once "../includes/admin_header.php"; requireAdmin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Inventory</title>
</head>
<body>
    <div class="inventory-container">
         <h2>Add Items to Inventory</h2>
            <form class="add_users_form" id="add_users_form">
                <input type="text" placeholder="SKU Code">
                <input type="text" placeholder="Item Name">
                <input type="text" placeholder="Description">
                <input type="number" name="item_price" step="0.01" min="0" placeholder="0.00" required >
                <input type="number" placeholder="Stock">
                <input type="file" name="image" id="image" accept="image/*" required>
                <button type="submit">Add Item</button>
         </form>
    </div>
    <h2>Inventory</h2>
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>SKU Code</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Stock</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
            <tbody id="inventory_table">
        </tbody>
    </table>

    <script src="../assets/js/get_items.js"></script>
<?php require_once "../includes/footer.php"; ?>
</body>
</html>