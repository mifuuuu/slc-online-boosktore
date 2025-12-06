<?php
header("Content-Type: application/json;");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "message" => "Method Not Allowed",
        "success" => false
    ]);
    exit();
}

require_once '../db.php';

try {
    $userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;

    if ($userId) {
        $sql = "SELECT user_id, username, fullname, email, userlevel, password, created_at, status 
                FROM users WHERE user_id = :user_id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // single row

        if (!$user) {
            echo json_encode([
                "message" => "User not found",
                "success" => false
            ]);
            exit();
        }

        echo json_encode([
            "message" => "User retrieved successfully",
            "success" => true,
            "data" => $user // single object
        ]);

    } else {
        $sql = "SELECT user_id, username, fullname, email, userlevel, created_at, status 
                FROM users ORDER BY user_id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "message" => "Users retrieved successfully",
            "success" => true,
            "data" => $users // array
        ]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "message" => "Error: " . $e->getMessage(),
        "success" => false
    ]);
}
?>
