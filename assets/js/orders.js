$(document).ready(() => {
    let orders = [];               // Store all fetched orders
    let detailedOrder = null;      // Store the currently selected order for detailed modal
    let currentOrderId = null;     // For edit modal

    // ---------------------------
    // Fetch orders from server
    // ---------------------------
    const getOrders = () => {
        $.ajax({
            url: "../includes/functions/get_orders.php",
            type: "GET",
            success: (res) => {
                orders = res.data || [];
                renderOrderCards();
                renderStats(res.stats || { pending: 0, completed: 0 });
                renderRecentOrdersTable();
            },
            error: (xhr, status, error) => {
                console.error("Failed to fetch orders:", error);
            }
        });
    };
    getOrders();

    // ---------------------------
    // Render Recent Orders Table with colored status
    // ---------------------------
    const renderRecentOrdersTable = () => {
        const tbody = $("#recent_orders_table_body");
        if (!tbody.length) {
            console.error("Recent orders table body not found!");
            return;
        }

        tbody.empty();

        // Sort orders by date descending (most recent first)
        const sortedOrders = [...orders].sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

        sortedOrders.forEach(order => {
            let statusColor = '';
            if(order.payment_status.toLowerCase() === 'pending'){
                statusColor = 'color: #f39c12; font-weight: bold;'; // orange
            } else if(order.payment_status.toLowerCase() === 'completed'){
                statusColor = 'color: #27ae60; font-weight: bold;'; // green
            }

            const row = $(`
                <tr>
                    <td>${order.order_id}</td>
                    <td>${order.student_name}</td>
                    <td>${order.student_id}</td>
                    <td>${order.total}</td>
                    <td style="${statusColor}">${order.payment_status}</td>
                    <td>${order.created_at}</td>
                </tr>
            `);
            tbody.append(row);
        });
    };

    // ---------------------------
    // Render order cards with colors
    // ---------------------------
    const renderOrderCards = () => {
        const container = $("#ordersCardsContainer");
        if (!container.length) {
            console.error("Orders container not found!");
            return;
        }

        container.empty();

        orders.forEach(order => {
            let statusColor = '';
            if(order.payment_status.toLowerCase() === 'pending'){
                statusColor = 'style="border-left:5px solid #f39c12; background-color:#fff8e1;"'; // orange
            } else if(order.payment_status.toLowerCase() === 'completed'){
                statusColor = 'style="border-left:5px solid #27ae60; background-color:#e8f8f5;"'; // green
            }

            const card = $(`
                <div class="order-card" data-id="${order.order_id}" ${statusColor}>
                    <h3>Order #${order.order_id}</h3>
                    <p><strong>Student:</strong> ${order.student_name}</p>
                    <p><strong>Total:</strong> ${order.total}</p>
                    <p><strong>Status:</strong> <span class="status-text">${order.payment_status}</span></p>
                </div>
            `);

            container.append(card);
        });
    };

    // ---------------------------
    // Handle card clicks (Event Delegation)
    // ---------------------------
    $("#ordersCardsContainer").on("click", ".order-card", function() {
        const orderId = $(this).data("id").toString();
        const order = orders.find(o => o.order_id.toString() === orderId);

        if(order) {
            openDetailedModal(order);
        } else {
            console.warn("Order not found for ID:", orderId);
        }
    });

    // ---------------------------
    // Render stats cards
    // ---------------------------
    const renderStats = (stats) => {
        $("#pendingCount").text(stats.pending);
        $("#completedCount").text(stats.completed);
    };

    // ---------------------------
    // Open Detailed Modal
    // ---------------------------
    const openDetailedModal = (order) => {
        detailedOrder = order;

        $("#detailOrderId").text(order.order_id);
        $("#detailStudentName").text(order.student_name);
        $("#detailStudentId").text(order.student_id);
        $("#detailTotal").text(order.total);
        $("#detailPaymentStatus").text(order.payment_status);
        $("#detailCreatedAt").text(order.created_at);

        // Render items
        if(order.items && order.items.length > 0){
            let itemsHtml = '<ul>';
            (order.items || []).forEach(item => {
                itemsHtml += `<li>${item.name} - Qty: ${item.quantity}</li>`;
            });
            itemsHtml += '</ul>';
            $("#orderItemsContainer").html(itemsHtml);
        } else {
            $("#orderItemsContainer").html('<p>No items in this order.</p>');
        }

        // Disable Process button if already completed
        if(order.payment_status.toLowerCase() === 'completed'){
            $("#processOrderBtn").prop('disabled', true);
        } else {
            $("#processOrderBtn").prop('disabled', false);
        }

        const detailedModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('orderDetailsModal'));
        detailedModal.show();
    };

    // ---------------------------
    // Process Order button click
    // ---------------------------
    $("#processOrderBtn").click(() => {
        if(detailedOrder){
            $("#verifyOrderCodeInput").val(""); // clear input
            $("#verifyErrorMsg").hide();
            const verifyModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('verifyOrderModal'));
            verifyModal.show();
        }
    });

    // ---------------------------
    // Confirm verification
    // ---------------------------
    $("#confirmVerifyBtn").click(() => {
        const inputCode = $("#verifyOrderCodeInput").val().trim();
        if(detailedOrder && inputCode === detailedOrder.order_code){
            updateOrderStatus(detailedOrder.order_id, "completed");

            // Hide modals
            bootstrap.Modal.getOrCreateInstance(document.getElementById('verifyOrderModal')).hide();
            bootstrap.Modal.getOrCreateInstance(document.getElementById('orderDetailsModal')).hide();
        } else {
            $("#verifyErrorMsg").show();
        }
    });

    // ---------------------------
    // Update order status (AJAX)
    // ---------------------------
    const updateOrderStatus = (orderId, newStatus) => {
        $.ajax({
            url: "../includes/functions/update_orders.php",
            type: "POST",
            data: { order_id: orderId, payment_status: newStatus },
            success: (res) => {
                if(res.success){
                    alert("Order updated successfully!");
                    getOrders();
                } else {
                    alert("Failed to update order.");
                }
            },
            error: (xhr, status, error) => {
                console.error("Failed to update order:", error);
                alert("Failed to update order due to server error.");
            }
        });
    };

    // ---------------------------
    // Open Edit Modal (optional)
    // ---------------------------
    const openEditModal = (order) => {
        currentOrderId = order.order_id;
        $("#modalOrderId").text(order.order_id);
        $("#modalStudentName").text(order.student_name);
        $("#modalStudentId").text(order.student_id);
        $("#modalTotal").text(order.total);
        $("#modalPaymentStatus").val(order.payment_status);
        $("#modalCreatedAt").text(order.created_at);

        const orderModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('orderModal'));
        orderModal.show();
    };

    // Save changes in edit modal
    $("#saveOrderChanges").click(() => {
        const newStatus = $("#modalPaymentStatus").val();
        if(currentOrderId){
            updateOrderStatus(currentOrderId, newStatus);
            bootstrap.Modal.getOrCreateInstance(document.getElementById('orderModal')).hide();
        }
    });

    
});
