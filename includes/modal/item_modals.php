<!-- add button -->
<div class="modal fade" id="additemModal" tabindex="-1" aria-hidden="true">
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
            <input type="text" class="form-control" placeholder="SKU" id="add_sku" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Item Name" id="add_item_name" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Description" id="add_description">
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" placeholder="Price" id="add_item_price" step="0.01" min="0" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" placeholder="Stock" id="add_stock" min="0" required>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Item Image</label>
            <input type="file" class="form-control" id="add_image" accept="image/*">
          </div>

          <button type="submit" class="btn btn-primary w-100" id="saveItemBtn">Add Item</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit button -->
<div class="modal fade" id="edititemModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Note enctype is required for file uploads -->
        <form id="edit_item_form" enctype="multipart/form-data" method="POST">  
          <div class="mb-3">
            <input type="hidden" class="form-control" placeholder="ID" id="update_item_id" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="SKU" id="update_sku" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Item Name" id="update_item_name" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Description" id="update_description">
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" placeholder="Price" id="update_item_price" step="0.01" min="0" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" placeholder="Stock" id="update_stock" min="0" required>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Item Image</label>
            <img id="current_image_preview" src="" alt="Item Image" width="100" class="mb-2">
            <input type="file" class="form-control" id="update_image" accept="image/*">
          </div>

          <button type="submit" class="btn btn-primary w-100" id="saveItemBtn">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
