$(document).ready(() => {
    const getUsers = () => {
        $.ajax({
            url: "../includes/functions/get_users.php",
            type: "GET",
            success: (res) => {
                if (res.success) {
                    renderUsers(res.data);
                    renderStats(res.data);
                } else {
                    alert(res.message);
                }
            },
        });
    };
    getUsers();

    const renderUsers = (users) => {
        const container = $("#users_table_body");
        container.empty();

        $.each(users, (index, user) => {
            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${user.username}</td>   
                    <td>${user.fullname}</td>
                    <td>${user.email}</td>
                    <td>${user.userlevel}</td>
                    <td>${user.created_at}</td>
                    <td>${user.status}</td>
                    <td>
                        <button type="button" class="btn-edituser" data-id="${user.user_id}">Edit</button>
                    </td>
                </tr>
            `;
            container.append(row);
        });
    };

    const renderStats = (users) => {
        const activeCount = users.filter(u => u.status === "active").length;
        const inactiveCount = users.filter(u => u.status !== "active").length;
        $("#activeUsersCount").text(activeCount);
        $("#inactiveUsersCount").text(inactiveCount);
    };

// ADD USER FUNCTION
    $("#add_user_form").on("submit", function (e) {
        e.preventDefault();

        const formData = new FormData();

        // Collect form values
        formData.append("username", $("#add_username").val());
        formData.append("password", $("#add_password").val());
        formData.append("fullname", $("#add_fullname").val());
        formData.append("email", $("#add_email").val());
        formData.append("userlevel", $("#add_userlevel").val());
        $.ajax({
            url: "../includes/functions/add_users.php",
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,   // Required for FormData
            contentType: false,   // Required for FormData
            success: function (res) {
                console.log(res);

                if (res.success) {
                    $("#add_user_form")[0].reset();

                    const successModal = new bootstrap.Modal($("#successAddModal"));
                    successModal.show();

                    getUsers();
                } else {
                    alert("Error: " + res.message);
                }
            }
        });
    });
    
        // ✅ Close success modal on OK
    $("#userSuccessOkBtn").on("click", function () {
        const successModal = bootstrap.Modal.getInstance($("#successAddModal"));
        const adduserModal = bootstrap.Modal.getInstance($("#adduserModal"));
        successModal.hide();
        adduserModal.hide();
    });
    // Edit User Button
    $(document).on("click", ".btn-edituser", function() {
        const userId = $(this).data("id");
        $.ajax({
            url: "../includes/functions/get_users.php",
            type: "GET",
            dataType: "json",
            data: { user_id: userId },
            success: (res) => {
                if (res.success && res.data) {
                    const user = res.data;

                    $("#edit_user_id").val(user.user_id);
                    $("#edit_username").val(user.username);
                    $("#edit_fullname").val(user.fullname);
                    $("#edit_email").val(user.email);
                    $("#edit_userlevel").val(user.userlevel);

                    // Optional: leave password blank for security
                    $("#edit_password").val("");

                    // Open modal
                    const editModal = new bootstrap.Modal(document.getElementById("edituserModal"));
                    editModal.show();
                } else {
                    alert(res.message || "Failed to fetch user data");
                }
            }
        });
    });

    // Edit User Submit
    $("#edit_user_form").on("submit", function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append("user_id", $("#edit_user_id").val());
        formData.append("username", $("#edit_username").val());
        formData.append("fullname", $("#edit_fullname").val());
        formData.append("email", $("#edit_email").val());
        formData.append("userlevel", $("#edit_userlevel").val());
        formData.append("_method", "PUT"); // optional for backend

        $.ajax({
            url: "../includes/functions/update_users.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {
                console.log(res);

                if (res.success) {
                    // Reset form
                    $("#edit_user_form")[0].reset();

                    // Show Edit User Success Modal
                    const successModal = new bootstrap.Modal(document.getElementById("editUserSuccessModal"));
                    successModal.show();

                    // OK button handler
                    $("#editUserSuccessOkBtn").off("click").on("click", function() {
                        successModal.hide();

                        // Close edit modal
                        const editModal = bootstrap.Modal.getInstance(document.getElementById("edituserModal"));
                        if (editModal) editModal.hide();

                        getUsers();
                    });
                } else {
                    alert("Error: " + res.message);
                }
            }
        });
    });
});
