$(document).ready(function() {
    // Load cart from localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Save cart and update cart count
    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
    }

    function updateCartCount() {
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        $("#cart-count").text(count);
    }

    // Render cart table
    function renderCart() {
        if (cart.length === 0) {
            $("#cartContainer").html("<p>Your cart is empty.</p>");
            $("#cartTotal").text("0.00");
            return;
        }

        let html = '<table class="table table-bordered"><thead><tr><th>Item</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr></thead><tbody>';
        let totalAmount = 0;

        cart.forEach((item, index) => {
            const itemTotal = item.item_price * item.quantity;
            totalAmount += itemTotal;

            const imgSrc = item.item_image
                ? (item.item_image.startsWith('data:') ? item.item_image : `data:image/jpeg;base64,${item.item_image}`)
                : '../assets/images/placeholder.png';

            html += `
                <tr data-index="${index}">
                    <td>
                        <img src="${imgSrc}" style="width:50px; height:50px; object-fit:cover; margin-right:8px;">
                        ${item.item_name}
                    </td>
                    <td>₱ ${item.item_price.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-secondary minus">-</button>
                        <span class="qty mx-2">${item.quantity}</span>
                        <button class="btn btn-sm btn-secondary plus">+</button>
                    </td>
                    <td>₱ ${itemTotal.toFixed(2)}</td>
                    <td><button class="btn btn-sm btn-danger remove">Remove</button></td>
                </tr>
            `;
        });

        html += '</tbody></table>';
        $("#cartContainer").html(html);
        $("#cartTotal").text(totalAmount.toFixed(2));
    }

    // Increase quantity
    $(document).on("click", ".plus", function() {
        const index = $(this).closest("tr").data("index");
        if (cart[index].quantity < (cart[index].stock || 999)) {
            cart[index].quantity += 1;
        } else {
            alert("Reached maximum stock for this item.");
        }
        saveCart();
        renderCart();
    });

    // Decrease quantity
    $(document).on("click", ".minus", function() {
        const index = $(this).closest("tr").data("index");
        cart[index].quantity -= 1;
        if (cart[index].quantity <= 0) cart.splice(index, 1);
        saveCart();
        renderCart();
    });

    // Remove item
    $(document).on("click", ".remove", function() {
        const index = $(this).closest("tr").data("index");
        cart.splice(index, 1);
        saveCart();
        renderCart();
    });

    // Checkout button: show modal
    $("#checkoutBtn").click(function() {
        if (cart.length === 0) {
            alert("Your cart is empty!");
            return;
        }

        // Update modal total
        let totalAmount = cart.reduce((sum, item) => sum + item.item_price * item.quantity, 0);
        $("#modalTotal").text(totalAmount.toFixed(2));

        // Reset form fields
        $("#checkoutForm")[0].reset();
        $("#onlinePaymentOptions").hide();

        // Show modal
        const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        checkoutModal.show();
    });

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

    $(document).on("click", "#confirmCheckout", function() {
        const studentName = $("#studentName").val().trim();
        const studentId = $("#studentId").val().trim();
        const paymentMethod = $("#paymentMethod").val();
        const onlineOption = $("#onlineOption").val();
        const totalAmount = cart.reduce((sum, item) => sum + item.item_price * item.quantity, 0);

        // Validation
        if (!studentName || !studentId || !paymentMethod) {
            alert("Please fill in all required fields.");
            return;
        }
        if (paymentMethod === "online" && !onlineOption) {
            alert("Please select an online payment platform.");
            return;
        }

        // Generate unique order code (format: XXXX-XXXX)
        const part1 = Math.floor(Math.random()*10000).toString().padStart(4,'0');
        const part2 = Math.floor(Math.random()*10000).toString().padStart(4,'0');
        const orderCode = `${part1}-${part2}`;

        // Prepare data
        const postData = {
            order_code: orderCode,
            student_name: studentName,
            student_id: studentId,
            total: totalAmount,
            payment_method: paymentMethod === 'online' ? onlineOption : paymentMethod,
            cart_items: cart // optional: if you want to store items too
        };

        // Send to PHP via AJAX
        $.ajax({
            url: '../includes/functions/checkout.php',
            type: 'POST',
            data: postData,
            success: function(response) {
                if (response.success) {
                    // Set order code in confirmation modal
                    $("#generatedOrderCode").text(response.order_code);

                    // Show the confirmation modal
                    const confirmationModal = new bootstrap.Modal(document.getElementById('orderConfirmationModal'));
                    confirmationModal.show();

                    // Clear cart
                    cart = [];
                    saveCart();
                    renderCart();

                    // Close checkout modal
                    const checkoutModalEl = document.getElementById('checkoutModal');
                    const modal = bootstrap.Modal.getInstance(checkoutModalEl);
                    if (modal) modal.hide();
                } else {
                    alert(response.message || "Something went wrong.");
                }
            },
        });
    });
    renderCart();
    updateCartCount();
});
