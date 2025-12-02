$(document).ready(() => {
    const getItems = () => {
        $.ajax({
            url: "../includes/functions/get_items.php",
            type: "GET",
            success: (res) => {
                // filtering logic, gets low stock if stock goes to 10
                const lowStockItems = res.data.filter(item => item.stock <= 10);
                uiRender(lowStockItems);
                uiRenderInventory(res.data);
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

    const uiRenderInventory = (items) => {
        const container = $("#inventory_table"); // descending dapat to 
        container.empty();
        $.each(items, (index, item) => {
            const row = `<tr>
                <td>${index + 1}</td>
                <td>${item.sku}</td>
                <td>${item.item_name}</td>
                <td>${item.description}</td>
                <td>${item.item_price}</td>
                <td><img src="${item.image}" alt="${item.item_name}" width="50"></td>
                <td>${item.stock}</td>
                <td>${item.created_at}</td>
                <td>
                    <button type="button" class="btn-edititem" data-id="${item.item_id}">Edit</button>
                </td>
            </tr>`;
            container.append(row);
        });
    };

//edit user button
    $(document).on("click", ".btn-edititem", function() {
        const itemId = $(this).data("id");
        $.ajax({
            url: `../includes/functions/update_items.php?item_id=${itemId}`,
            type: "GET",
            datatype: "json",
            success: (res) => {
                const selectedItem = res.data;
                $("#edit_item_id").val(selectedItem.item_id);
                $("#update_skucode").val(selectedItem.sku);
                $("#update_itemname").val(selectedItem.item_name);
                $("#update_descripton").val(selectedItem.description);
                $("#update_price").val(selectedItem.item_price);
                $("#update_stock").val(selectedItem.stock);
            }   
        });
    });
});