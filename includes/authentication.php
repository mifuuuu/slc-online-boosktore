<?php
// authentication.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if not logged in
function checkLogin() {
    if (!isset($_SESSION["user_id"])) {
        header("Location: ../admin/loginpage.php");
        exit;
    }
}

function isAdmin() {
    return isset($_SESSION["userlevel"]) && $_SESSION["userlevel"] === "admin";
}

function isStaff() {
    return isset($_SESSION["userlevel"]) && $_SESSION["userlevel"] === "staff";
}

function requireAdmin() {
    checkLogin();
    if (!isAdmin()) {
        echo "ACCESS DENIED: Admin only.";
        exit;
    }
}

function requireStaff() {
    checkLogin();
    if (!isStaff() && !isAdmin()) {
        echo "ACCESS DENIED: Staff only.";
        exit;
    }
}
?>