<?php
    header("Content-Type: application/json;");
    if($_SERVER['REQUEST_METHOD'] !== 'GET'){
        http_response_code(405);
        echo json_encode([
            "message" => "Method Not Allowed",
            "success" => false
        ]);
        exit();
    }
    require_once '../db.php';

    try {
         $sql = "SELECT * FROM orders ORDER BY order_id DESC";
         $stmt = $conn->prepare($sql);
         $stmt->execute();
         $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "message" => "orders retrived successfully",
            "success" => true,
            "data" => $orders
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            "message" => "Error: " . $e->getMessage(),
            "success" => false
        ]);
    }
?>