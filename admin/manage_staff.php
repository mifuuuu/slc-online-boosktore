<?php require_once "../includes/admin_header.php"; requireAdmin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>User Management</title>
</head>
<body>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#adduserModal"> Add User </button>
        <h2>Users</h2>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>User Level</th>  
                    <th>Date Added</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="users_table_body"></tbody>
        </table>
<script src="../assets/js/user.js"></script>
<?php require_once "../includes/modal/item_modals.php"; ?>
<?php require_once "../includes/footer.php"; ?>
</body>
</html>