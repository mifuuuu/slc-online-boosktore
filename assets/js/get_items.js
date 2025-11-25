alert("JS file items loaded");
$(document).ready(() => {
    const getItems = () => {
        $.ajax({
            url: "../includes/functions/get_items.php",
            type: "GET",
            success: (res) => {
                // filtering logic, gets low stock if stock goes to 10
                const lowStockItems = res.data.filter(item => item.stock < 10);
                uiRender(lowStockItems);
            }
        });
    };
    getItems();

    const uiRender = (items) => {
        const container = $("#low_on_stock_items");
        container.empty();
        $.each(items, (index, item) => {
            const row = `<tr>
                <td>${index + 1}</td>
                <td>${item.sku}</td>
                <td>${item.item_name}</td>
                <td><img src="${item.image}" alt="${item.item_name}" width="50"></td>
                <td>${item.stock}</td>
                <td>${item.created_at}</td>
            </tr>`;
            container.append(row);
        });
    };
});

