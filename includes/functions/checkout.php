<?php
header("Content-Type: application/json");
require_once '../db.php';

try {
    // Only allow POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            "message" => "Method Not Allowed",
            "success" => false
        ]);
        exit();
    }

    // Required fields
    $requiredFields = ['order_code', 'student_name', 'student_id', 'total', 'payment_method'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            http_response_code(400);
            echo json_encode([
                "message" => "Field '$field' is required",
                "success" => false
            ]);
            exit();
        }
    }

    // Collect POST data
    $order_code = $_POST['order_code'];
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $total = $_POST['total'];
    $payment_method = $_POST['payment_method'];

    $payment_status = 'pending';
    $created_at = date('Y-m-d H:i:s');

    // Insert into database using PDO
    $sql = "INSERT INTO orders 
            (order_code, student_name, student_id, total, payment_method, payment_status, created_at)
            VALUES (:order_code, :student_name, :student_id, :total, :payment_method, :payment_status, :created_at)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':order_code', $order_code);
    $stmt->bindParam(':student_name', $student_name);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->bindParam(':total', $total);
    $stmt->bindParam(':payment_method', $payment_method);
    $stmt->bindParam(':payment_status', $payment_status);
    $stmt->bindParam(':created_at', $created_at);

    if ($stmt->execute()) {
        echo json_encode([
            "message" => "Order placed successfully",
            "success" => true,
            "order_code" => $order_code,
            "total" => $total
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "message" => "Failed to place order",
            "success" => false
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
