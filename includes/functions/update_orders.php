<?php
header("Content-Type: application/json;");
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method Not Allowed"]);
    exit();
}

$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;
$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : null;

if(!$order_id || !in_array($payment_status, ['pending','completed'])){
    echo json_encode(["success" => false, "message" => "Invalid data"]);
    exit();
}

try {
    $sql = "UPDATE orders SET payment_status = :status WHERE order_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['status' => $payment_status, 'id' => $order_id]);

    echo json_encode(["success" => true, "message" => "Order updated successfully"]);
} catch(PDOException $e){
    http_response_code(500);
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>
