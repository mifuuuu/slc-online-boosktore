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
    // Get all orders
    $sql = "SELECT * FROM orders ORDER BY order_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count pending
    $sqlPending = "SELECT COUNT(*) as pending FROM orders WHERE payment_status = 'pending'";
    $pending = $conn->query($sqlPending)->fetch(PDO::FETCH_ASSOC)['pending'];

    // Count completed
    $sqlCompleted = "SELECT COUNT(*) as completed FROM orders WHERE payment_status = 'completed'";
    $completed = $conn->query($sqlCompleted)->fetch(PDO::FETCH_ASSOC)['completed'];

    echo json_encode([
        "message" => "orders retrieved successfully",
        "success" => true,
        "data" => $orders,
        "stats" => [
            "pending" => $pending,
            "completed" => $completed
        ]
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "message" => "Error: " . $e->getMessage(),
        "success" => false
    ]);
}
?>
