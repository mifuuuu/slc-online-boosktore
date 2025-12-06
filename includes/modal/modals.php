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
              <button class="btn btn-outline-secondary" type="button" id="addtogglePassword">
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
          <input type="hidden" id="edit_user_id">

          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Username" id="edit_username" required>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" id="edit_password">
              <button class="btn btn-outline-secondary" type="button" id="edittogglePassword">
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


<!-- USER SUCCESS ADDING MODAL -->
<div class="modal fade" id="successAddModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center p-3">
            <h5 class="mb-2">User Added</h5>
            <p>The user has been added successfully.</p>
            <button id="userSuccessOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>
</div>

<!-- ITEM SUCCESS ADDING MODAL -->
<div class="modal fade" id="itemSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center p-3">
            <h5 class="mb-2">Item Added</h5>
            <p>The item has been added successfully.</p>
            <button id="itemSuccessOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>
</div>

<!-- EDIT ITEM SUCCESS MODAL -->
<div class="modal fade" id="editItemSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center p-3">
            <h5 class="mb-2">Item Updated</h5>
            <p>The item has been updated successfully.</p>
            <button id="editItemSuccessOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>
</div>

<!-- EDIT USER SUCCESS MODAL -->
<div class="modal fade" id="editUserSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center p-3">
            <h5 class="mb-2">User Updated</h5>
            <p>The user has been updated successfully.</p>
            <button id="editUserSuccessOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>
</div>

<!-- checkout modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Your total is: ₱ <span id="modalTotal">0.00</span></p>

        <form id="checkoutForm">
          <!-- Student Name -->
          <div class="mb-3">
            <label for="studentName" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="studentName" required>
          </div>

          <!-- Student ID -->
          <div class="mb-3">
            <label for="studentId" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="studentId" required>
          </div>

          <!-- Payment Method -->
          <div class="mb-3">
            <label for="paymentMethod" class="form-label">Payment Method</label>
            <select class="form-select" id="paymentMethod" required>
              <option value="">-- Select Payment Method --</option>
              <option value="online">Online Payment</option>
              <option value="counter">Pay on the Counter</option>
            </select>
          </div>

          <!-- Online Payment Options (shown only if Online Payment selected) -->
          <div class="mb-3" id="onlinePaymentOptions" style="display:none;">
            <label for="onlineOption" class="form-label">Choose Online Platform</label>
            <select class="form-select" id="onlineOption">
              <option value="">-- Select Platform --</option>
              <option value="gcash">GCash</option>
              <option value="paymaya">PayMaya</option>
              <option value="gotyme">GoTyme</option>
              <option value="bank">Bank Transfer</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="confirmCheckout">Confirm</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Show/hide online payment options
  $("#paymentMethod").on("change", function() {
    if ($(this).val() === "online") {
      $("#onlinePaymentOptions").show();
      $("#onlineOption").attr("required", true);
    } else {
      $("#onlinePaymentOptions").hide();
      $("#onlineOption").attr("required", false);
    }
  });
});
</script>

<!-- Order Confirmation Modal -->
<div class="modal fade" id="orderConfirmationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100">Order Confirmed!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Your order has been placed successfully.</p>
        <p style="font-size: 2rem; font-weight: bold;" id="generatedOrderCode"></p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>




<script>
$(document).on("click", "#addtogglePassword", function() {
    const passwordField = $("#add_password");
    const type = passwordField.attr("type") === "password" ? "text" : "password";
    passwordField.attr("type", type);
    $(this).find("i").toggleClass("bi-eye bi-eye-slash");
});

$(document).on("click", "#edittogglePassword", function() {
    const passwordField = $("#edit_password");
    const type = passwordField.attr("type") === "password" ? "text" : "password";
    passwordField.attr("type", type);
    $(this).find("i").toggleClass("bi-eye bi-eye-slash");
});
</script>