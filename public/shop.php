<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLC Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/shop.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php include "../includes/headers/shop_header.php"; ?>

    <div class="container my-4">
        <h2 class="mb-3">All Items</h2>
        <div id="booksList" class="row g-3"></div>
    </div>

    <div class="modal fade" id="bookModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="bookName"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body d-flex flex-column flex-md-row gap-3">
            <img id="bookImg" src="" class="img-fluid" style="max-width:250px; object-fit:cover;">
            <div class="info flex-grow-1">
              <p class="price">₱ <span id="bookPrice"></span></p>
              <div class="stock-info mb-2">
                <strong>Stock:</strong> <span id="bookStock"></span>
              </div>
              <div class="desc mb-3">
                <strong>Description:</strong>
                <p id="bookDesc"></p>
              </div>
              <button id="addBtn" class="btn btn-primary" data-id="">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/shop.js"></script>
    <?php require_once "../includes/footer.php"; ?>
</body>
</html>
