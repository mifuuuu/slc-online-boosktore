    $(document).ready(() => {
        const getItems = () => {
            $.ajax({
                url: "../includes/functions/get_items.php",
                type: "GET",
                success: (res) => {
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
                const imgSrc = item.image ? `data:image/jpeg;base64,${item.image}` : '';
                const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.sku}</td>
                    <td>${item.item_name}</td>
                    <td><img src="${imgSrc}" width="50"></td>
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
                const imgSrc = item.image ? `data:image/jpeg;base64,${item.image}` : '';
                const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.sku}</td>
                    <td>${item.item_name}</td>
                    <td>${item.description}</td>
                    <td>${item.item_price}</td>
                    <td><img src="${imgSrc}" width="50"></td>
                    <td>${item.stock}</td>
                    <td>${item.created_at}</td>
                    <td>
                        <button type="button" class="btn-edititem" data-id="${item.item_id}">Edit</button>
                    </td>
                </tr>`;
                container.append(row);
            });
        };
    // Add function for adding items
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

            const imageFile = $("#add_image")[0].files[0];
            if (imageFile) {
                formData.append("image", imageFile);
            }

            $.ajax({
                url: "../includes/functions/add_items.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);

                    // Reset the form
                    $("#add_item_form")[0].reset();

                    // Show success modal
                    const successModal = new bootstrap.Modal($("#itemSuccessModal"));
                    successModal.show();

                    // Add click handler to OK button
                    $("#itemSuccessOkBtn").off("click").on("click", function() {
                        // Close success modal
                        successModal.hide();
                        
                        // Close the Add Item modal
                        const additemModal = bootstrap.Modal.getInstance($("#additemModal"));
                        if (additemModal) {
                            additemModal.hide();
                        }

                        // Optionally reload items table
                        getItems();
                    });
                }
            });
        });


    //edit item button
        $(document).on("click", ".btn-edititem", function() {
            const itemId = $(this).data("id"); 
            $.ajax({
                url: "../includes/functions/get_items.php", 
                type: "GET",
                dataType: "json",
                data: { item_id: itemId }, 
                success: (res) => {
                    const selectedItem = res.data;
                    $("#update_item_id").val(selectedItem.item_id);
                    $("#update_sku").val(selectedItem.sku);
                    $("#update_item_name").val(selectedItem.item_name);
                    $("#update_description").val(selectedItem.description);
                    $("#update_item_price").val(selectedItem.item_price);
                    $("#update_stock").val(selectedItem.stock);

                    if(selectedItem.image) {
                        $("#current_image_preview").attr("src", "data:image/jpeg;base64," + selectedItem.image);
                    } else {
                        $("#current_image_preview").attr("src", "");
                    }
                    $("#edititemModal").modal("show");
                },
            });
        });

    // Edit submit function
        $("#edit_item_form").on("submit", function(e) {
            e.preventDefault();

            const formData = new FormData();

            formData.append("item_id", $("#update_item_id").val());
            formData.append("sku", $("#update_sku").val());
            formData.append("item_name", $("#update_item_name").val());
            formData.append("description", $("#update_description").val());
            formData.append("item_price", $("#update_item_price").val());
            formData.append("stock", $("#update_stock").val());

            const imageFile = $("#update_image")[0].files[0];
            if (imageFile) {
                formData.append("image", imageFile);
            }

            // Use _method=PUT to indicate update
            formData.append("_method", "PUT");

            $.ajax({
                url: "../includes/functions/update_items.php",
                type: "POST", // MUST be POST for FormData to work
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);

                    // Reset the form
                    $("#edit_item_form")[0].reset();

                    // Show success modal
                    const successModal = new bootstrap.Modal($("#editItemSuccessModal"));
                    successModal.show();

                    // Add click handler to OK button
                    $("#editItemSuccessOkBtn").off("click").on("click", function() {
                        // Close success modal
                        successModal.hide();

                        // Close the Edit Item modal
                        const editItemModal = bootstrap.Modal.getInstance($("#edititemModal"));
                        if (editItemModal) {
                            editItemModal.hide();
                        }

                        // Reload inventory table
                        getItems();
                    });
                }
            });
        });
    });
