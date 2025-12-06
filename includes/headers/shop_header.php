<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/shop_header.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="../uploads/logo/slc-logo.png" alt="SLC Logo">
        <h1>Welcome to SLC Online Bookstore</h1>
    </div>

    <nav>
        <a href="shop.php">Shop</a>
        <a href="cart.php" id="cart-icon" class="cart-link">
            🛒 <span id="cart-count">0</span>
        </a>
    </nav>
</header>

<script>
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById("cart-count").innerText = count;
    }
    updateCartCount();
    window.addEventListener('storage', updateCartCount);
</script>

</body>
</html>
