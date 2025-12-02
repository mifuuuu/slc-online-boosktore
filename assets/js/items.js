// alert("update nga");

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
                <td><img src="data:image/jpeg;base64,${item.image}" width="50"></td>
                <td>${item.stock}</td>
                <td>${item.created_at}</td>
            </tr>`;
            container.append(row);
        });
    };

    const uiRenderInventory = (items) => {
        const container = $("#inventory_table");
        container.empty();
        $.each(items, (index, item) => {
            const row = `<tr>
                <td>${index + 1}</td>
                <td>${item.sku}</td>
                <td>${item.item_name}</td>
                <td>${item.description}</td>
                <td>${item.item_price}</td>
                <td><img src="data:image/jpeg;base64,${item.image}" width="50"></td>
                <td>${item.stock}</td>
                <td>${item.created_at}</td>
                <td>
                    <button type="button" class="btn-edititem" data-id="${item.item_id}">Edit</button>
                </td>
            </tr>`;
            container.append(row);
        });
    };

    $("#add_item_form").on("submit", function(e) {
    e.preventDefault();
        // Create a FormData object
        const formData = new FormData();

        // Append text fields
        formData.append("sku", $("#add_sku").val());
        formData.append("item_name", $("#add_item_name").val());
        formData.append("description", $("#add_description").val());
        formData.append("item_price", $("#add_item_price").val());
        formData.append("stock", $("#add_stock").val());

        const imageFile = $("#add_image")[0].files[0]; // make sure your input has id="add_image"
        if (imageFile) {
            formData.append("image", imageFile);
        }

        $.ajax({
            url: "../includes/functions/add_items.php", // replace with your API path
            type: "POST",
            data: formData,
            processData: false, // important for FormData
            contentType: false, // important for FormData
            success: function(res) {
                console.log(res);
                // handle success, e.g., show message, refresh table
            },
            error: function(err) {
                console.error(err);
            }
        });
    });
});
