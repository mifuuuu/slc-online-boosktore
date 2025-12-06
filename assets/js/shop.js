$(document).ready(function() {
    let items = [];
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // ---------- Helper Functions ----------
    function updateCartCount() {
        const total = cart.reduce((sum, item) => sum + item.quantity, 0);
        $("#cart-count").text(total);
    }

    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
        window.dispatchEvent(new Event('storage')); // update header count in other pages
    }

    function addToCart(item) {
        if (item.stock <= 0) {
            alert("Item is out of stock!");
            return;
        }

        const existing = cart.find(x => x.item_id == item.item_id);
        if (existing) {
            if (existing.quantity < item.stock) {
                existing.quantity += 1;
            } else {
                alert("Reached maximum stock for this item.");
                return;
            }
        } else {
            cart.push({
                item_id: item.item_id,
                item_name: item.item_name,
                item_price: parseFloat(item.item_price),
                item_image: item.image,
                quantity: 1,
                stock: item.stock
            });
        }

        saveCart();
        updateCartCount();
        alert("Added to cart!");
    }

    // ---------- Fetch & Render Items ----------
    function getItems() {
        $.ajax({
            url: "../includes/functions/get_items.php?with_mime=true", // ensures proper data URL
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data.success && data.data.length > 0) {
                    items = data.data;
                    renderItems(items);
                } else {
                    $("#booksList").html("<p>No items available.</p>");
                }
            },
            error: function(err) {
                console.error("AJAX error:", err);
                $("#booksList").html("<p>Error fetching items.</p>");
            }
        });
    }

    function renderItems(items) {
        let html = '';
        items.forEach(item => {
            const imgSrc = item.image ? item.image : '../assets/images/placeholder.png';
            const stockText = item.stock > 0 ? `Stock: ${item.stock}` : 'Out of Stock';

            html += `
                <div class="card" data-id="${item.item_id}">
                    <img src="${imgSrc}" alt="${item.item_name}">
                    <h3>${item.item_name}</h3>
                    <p class="price">₱ ${parseFloat(item.item_price).toFixed(2)}</p>
                    <p class="stock ${item.stock <= 0 ? 'stock-out' : item.stock <= 10 ? 'stock-low' : 'stock-ok'}">${stockText}</p>
                    <button class="btn-add" ${item.stock <= 0 ? 'disabled' : ''}>Add to Cart</button>
                </div>
            `;
        });

        $("#booksList").html(html);
    }

    // ---------- Modal ----------
    function showModal(item) {
        if (!item) return;

        const imgSrc = item.image ? item.image : '../assets/images/placeholder.png';
        $("#bookImg").attr("src", imgSrc);
        $("#bookName").text(item.item_name);
        $("#bookPrice").text(parseFloat(item.item_price).toFixed(2));
        $("#bookDesc").text(item.description || "No description");

        if (item.stock > 10) {
            $("#bookStock").text(`In Stock (${item.stock})`).attr("class", "stock-ok");
            $("#addBtn").prop("disabled", false);
        } else if (item.stock > 0) {
            $("#bookStock").text(`Low Stock (${item.stock})`).attr("class", "stock-low");
            $("#addBtn").prop("disabled", false);
        } else {
            $("#bookStock").text("Out of Stock").attr("class", "stock-out");
            $("#addBtn").prop("disabled", true);
        }

        $("#addBtn").attr("data-id", item.item_id);
        $("#bookModal").addClass("show");
    }

    function closeModal() {
        $("#bookModal").removeClass("show");
    }

    // ---------- Event Listeners ----------
    $(document).on("click", ".card", function(e) {
        if ($(e.target).hasClass("btn-add")) return;
        const id = $(this).data("id");
        const item = items.find(x => parseInt(x.item_id) === parseInt(id));
        showModal(item);
    });

    $("#addBtn").click(function() {
        const id = $(this).data("id");
        const item = items.find(x => parseInt(x.item_id) === parseInt(id));
        if (item) addToCart(item);
        closeModal();
    });

    $(document).on("click", ".btn-add", function() {
        const card = $(this).closest(".card");
        const id = card.data("id");
        const item = items.find(x => parseInt(x.item_id) === parseInt(id));
        if (item) addToCart(item);
    });

    $(document).on("click", "#bookModal", closeModal);
    $(document).on("click", ".close", closeModal);
    $(document).on("click", ".modal-box", e => e.stopPropagation());

    // ---------- Initialize ----------
    getItems();
    updateCartCount();
});
