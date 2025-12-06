<?php
require_once '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
}

try {
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    $fullname  = $_POST['fullname'];
    $email     = $_POST['email'];
    $userlevel = $_POST['userlevel'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, fullname, email, userlevel) VALUES (:username, :password, :fullname, :email, :userlevel)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":fullname", $fullname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":userlevel", $userlevel);
    $stmt->execute();

    echo json_encode(["success" => true, "message" => "User added successfully"]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
