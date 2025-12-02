<?php require_once "../includes/admin_header.php"; requireAdmin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Inventory</title>
</head>

<body>

    <h2>Inventory</h2>
    
    <!-- Add Item Button -->
    <button id="openModalBtn" class="add-btn">+ Add Item</button>

    <!-- MODAL -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal">
            <span class="close-btn" id="closeModalBtn">&times;</span>

            <h2>Add Items to Inventory</h2>

            <form class="add_users_form" id="add_users_form">
                <input type="text" placeholder="SKU Code" id="update_skucode">
                <input type="text" placeholder="Item Name" id="update_itemname">
                <input type="text" placeholder="Description" id="update_descripton">
                <input type="number" name="item_price" step="0.01" min="0" placeholder="0.00" required id="update_price">
                <input type="number" placeholder="Stock" id="update_stock">
                <button type="submit">Add Item</button>
            </form>
        </div>
    </div>

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

    <script src="../assets/js/get_items.js"></script>
    <?php require_once "../includes/footer.php"; ?>

    <script>
        const modalOverlay = document.getElementById("modalOverlay");
        const openModalBtn = document.getElementById("openModalBtn");
        const closeModalBtn = document.getElementById("closeModalBtn");

        // Open modal
        openModalBtn.addEventListener("click", () => {
            modalOverlay.style.display = "flex";
        });

        // Close modal (X button)
        closeModalBtn.addEventListener("click", () => {
            modalOverlay.style.display = "none";
        });
    </script>

</body>
</html>
