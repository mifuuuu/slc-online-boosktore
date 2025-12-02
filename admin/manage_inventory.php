<?php require_once "../includes/admin_header.php"; requireAdmin(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Inventory</title>
</head>
<body>
    <h2>Add Items to Inventory</h2>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#itemModal"> Add Item </button>
        <?php require_once "../includes/modal/item_modals.php"; ?>
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
        <tbody id="inventory_table"></tbody>
    </table>

    <script src="../assets/js/items.js"></script>

<?php require_once "../includes/footer.php"; ?>
</body>
</html>
