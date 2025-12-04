<!-- add item button -->
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

<!-- edit item button -->
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

<!-- add user modal -->
<div class="modal fade" id="adduserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add_user_form" enctype="multipart/form-data" method="POST">  
          <input type="hidden" id="user_id">

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Username" id="add_username" required>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" id="add_password" required>
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Full Name" id="add_fullname" required>
          </div>

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Email" id="add_email" required>
          </div>

          <div class="mb-3">
            <select class="form-control" id="add_userlevel" required>
              <option value="">Select User Level</option>
              <option value="admin">Admin</option>
              <option value="staff">Staff</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-100" id="addUserBtn">Add User</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(() => {
  $("#togglePassword").on("click", function() {
    const passwordField = $("#password");
    const type = passwordField.attr("type") === "password" ? "text" : "password";
    passwordField.attr("type", type);
    
    $(this).find("i").toggleClass("bi-eye bi-eye-slash");
  });
});
</script>

<!-- edit user modal -->
<div class="modal fade" id="edituserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="edit_user_form" enctype="multipart/form-data" method="POST">  
          <input type="hidden" id="user_id">

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Username" id="edit_username" required>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" id="edit_password" required>
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Full Name" id="edit_fullname" required>
          </div>

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Email" id="edit_email" required>
          </div>

          <div class="mb-3">
            <select class="form-control" id="edit_userlevel" required>
              <option value="">Select User Level</option>
              <option value="admin">Admin</option>
              <option value="staff">Staff</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-100" id="editUserBtn">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>