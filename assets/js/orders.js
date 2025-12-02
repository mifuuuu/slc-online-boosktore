alert("JS file orders loaded");
$(document).ready(() => {
    const getOrders = () => {
        $.ajax({
            url: "../includes/functions/get_orders.php",
            type: "GET",
            success: (res) => {
                uiRender(res.data);      // table
                uiRenderStats(res.stats); // h2 stats
            }
        });
    };
    getOrders();

    const uiRender = (orders) =>{
        const container = $("#recent_orders_table_body");
        container.empty();

        $.each(orders, (index, order) => {
            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${order.student_name}</td>
                    <td>${order.student_id}</td>
                    <td>${order.total}</td>
                    <td>${order.payment_status}</td>
                    <td>${order.created_at}</td>
                </tr>`;
            container.append(row);
        });
    };

    const uiRenderStats = (stats) => {
        $("#pendingCount").text(stats.pending);
        $("#completedCount").text(stats.completed);
    };
});
