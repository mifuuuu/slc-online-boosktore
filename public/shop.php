<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLC Bookstore</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/shop.css">
</head>
<body>
    <header>
        <div class="header-wrap">
            <h1>Online Bookstore</h1>
            <nav>
                <a href="shop.php">Store</a>
                <a href="#">About</a>
                <a href="#">Contact Us</a>
            </nav>
        </div>
    </header>

    <div class="main">
        <h2>All Books</h2>
        <div id="booksList"></div>
    </div>

    <div id="bookModal" class="modal">
        <div class="modal-box">
            <span class="close">&times;</span>
            <div class="modal-body">
                <img id="bookImg" src="">
                <div class="info">
                    <h3 id="bookName"></h3>
                    <p class="price">₱ <span id="bookPrice"></span></p>
                    <div class="stock-info">
                        <strong>Stock:</strong> <span id="bookStock"></span>
                    </div>
                    <div class="desc">
                        <strong>Description:</strong>
                        <p id="bookDesc"></p>
                    </div>
                    <button id="addBtn">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/shop.js"></script>
</body>
</html>