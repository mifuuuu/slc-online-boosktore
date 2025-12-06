<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - SLC Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<body>
    <?php include "../includes/headers/shop_header.php"; ?>

    <div class="container my-5">
        <h2 class="mb-4">Your Cart</h2>
        <div id="cartContainer"></div>
        <div class="mt-4 d-flex justify-content-between align-items-center">
            <h4>Total: ₱ <span id="cartTotal">0</span></h4>
            <button id="checkoutBtn" class="btn btn-success">Checkout</button>
        </div>
    </div>

    <?php include "../includes/modal/modals.php"; ?> 
    <script src="../assets/js/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
