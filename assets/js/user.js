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

// add user function

});
