<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
    <body>
        <form action="../includes/login.php" method="POST">
            <h2>Welcome to SLC Bookstore</h2>
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit">Login</button>
            <span>note! this login page is only for authorized users only!</span>
        </form>
    </body>
</html>
<?php require_once "../includes/footer.php"; ?>