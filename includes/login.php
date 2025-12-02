<?php
session_start();
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare using PDO
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify hashed password
        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"]  = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["userlevel"] = $user["userlevel"];

            // Redirect based on role
            if ($user["userlevel"] === "admin") {
                header("Location: ../admin/admin_home.php");
                exit;
            } elseif ($user["userlevel"] === "staff") {
                echo "Your userlevel is staff.<br><br>";
                exit;
            } else {
                echo "Invalid credentials.<br><br>";
                echo '<button onclick="window.history.back()">Go Back</button>';
                exit;
            }
        } else {
            echo "Invalid password!<br><br>";
            echo '<button onclick="window.history.back()">Go Back</button>';
        }
    } else {
        echo "User not found!<br><br>";
        echo '<button onclick="window.history.back()">Go Back</button>';
    }
}
?>
