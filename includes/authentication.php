<?php
// inc/auth.php
session_start();

function is_logged_in() {
    return !empty($_SESSION['user_id']);
}

function require_role($roles = []) {
    if (!is_logged_in() || !in_array($_SESSION['role'], $roles)) {
        header('Location: ../login.php');
        exit;
    }
}
