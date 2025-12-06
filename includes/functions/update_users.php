<?php
header("Content-Type: application/json");

require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Method Not Allowed"
    ]);
    exit();
}

try {
    // Get POST data
    $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $userlevel = isset($_POST['userlevel']) ? trim($_POST['userlevel']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!$userId || !$username || !$fullname || !$email || !$userlevel) {
        echo json_encode([
            "success" => false,
            "message" => "Please provide all required fields."
        ]);
        exit();
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode([
            "success" => false,
            "message" => "User not found."
        ]);
        exit();
    }

    // Build SQL dynamically depending on whether password is provided
    if (!empty($password)) {
        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users 
                SET username = :username, fullname = :fullname, email = :email, userlevel = :userlevel, password = :password 
                WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword);
    } else {
        $sql = "UPDATE users 
                SET username = :username, fullname = :fullname, email = :email, userlevel = :userlevel 
                WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
    }

    // Bind common parameters
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':userlevel', $userlevel);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    // Execute
    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "User updated successfully."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Failed to update user."
        ]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>
