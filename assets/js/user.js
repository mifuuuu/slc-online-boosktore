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
            processData: false,   // Required for FormData
            contentType: false,   // Required for FormData
            success: function (res) {
                console.log(res);
                $("#add_user_form")[0].reset();

                // Optional: close modal if you have one
                // $("#addUserModal").modal("hide");
            },
        });
    });

// EDIT USER BUTTON
    $(document).on("click", ".btn-edituser", function () {
        const userId = $(this).data("id"); // This is user_id

        $.ajax({
            url: "../includes/functions/get_users.php",
            type: "GET",
            dataType: "json",
            data: { user_id: userId }, // Correct key for database
            success: (res) => {
                const user = res.data;

                $("#edit_user_id").val(user.user_id);   // MUST match backend key
                $("#edit_username").val(user.username);
                $("#edit_fullname").val(user.fullname);
                $("#edit_email").val(user.email);
                $("#edit_userlevel").val(user.userlevel);
                $("#editUserModal").modal("show");
            },
        });
    });
});
