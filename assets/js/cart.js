$(document).ready(function() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
    }

    function updateCartCount() {
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        $("#cart-count").text(count);
    }

    function renderCart() {
        if(cart.length === 0) {
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
        if(cart[index].quantity < cart[index].stock) {
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
        if(cart[index].quantity <= 0) cart.splice(index, 1);
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

    // Checkout
    $("#checkoutBtn").click(function() {
        if(cart.length === 0) {
            alert("Your cart is empty!");
            return;
        }
        alert("Order placed successfully!");
        saveCart();
        renderCart();
    });

    renderCart();
    updateCartCount();
});
