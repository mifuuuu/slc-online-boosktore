<!-- add button -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Note enctype is required for file uploads -->
        <form id="add_item_form" enctype="multipart/form-data" method="POST">  

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="SKU" id="add_sku" name="sku" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Item Name" id="add_item_name" name="item_name" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Description" id="add_description" name="description">
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" placeholder="Price" id="add_item_price" name="item_price" step="0.01" min="0" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" placeholder="Stock" id="add_stock" name="stock" min="0" required>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Item Image</label>
            <input type="file" class="form-control" id="add_image" name="image" accept="image/*">
          </div>

          <button type="submit" class="btn btn-primary w-100" id="saveItemBtn">Add Item</button>
        </form>
      </div>
    </div>
  </div>
</div>
