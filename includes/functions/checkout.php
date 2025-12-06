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

    // Try to parse JSON body (sent by client) first
    $rawBody = file_get_contents('php://input');
    $jsonData = json_decode($rawBody, true);

    // Determine source of data (JSON body or regular POST)
    $dataSource = is_array($jsonData) ? $jsonData : $_POST;

    // Required fields
    $requiredFields = ['order_code', 'student_name', 'student_id', 'total', 'payment_method'];
    foreach ($requiredFields as $field) {
        if (!isset($dataSource[$field]) || (is_string($dataSource[$field]) && trim($dataSource[$field]) === '')) {
            http_response_code(400);
            echo json_encode([
                "message" => "Field '$field' is required",
                "success" => false
            ]);
            exit();
        }
    }

    // Collect data from the appropriate source
    $order_code = $dataSource['order_code'];
    $student_name = $dataSource['student_name'];
    $student_id = $dataSource['student_id'];
    $total = $dataSource['total'];
    $payment_method = $dataSource['payment_method'];

    $payment_status = 'pending';
    $created_at = date('Y-m-d H:i:s');

    // Extract cart items from JSON if present, otherwise fall back to POST
    $cart_items = null;
    if (is_array($jsonData) && isset($jsonData['cart_items'])) {
        $cart_items = $jsonData['cart_items'];
    } elseif (isset($_POST['cart_items'])) {
        // fallback if form-encoded array was used
        $cart_items = $_POST['cart_items'];
        if (is_string($cart_items)) {
            $decoded = json_decode($cart_items, true);
            if (is_array($decoded)) $cart_items = $decoded;
        }
    }

    // Insert order and order items inside a transaction
    $conn->beginTransaction();
    try {
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

        if (!$stmt->execute()) {
            throw new Exception('Failed to insert order');
        }

        // Get the newly created order id
        $order_id = $conn->lastInsertId();

        // If cart items provided, insert into order_items (matches DB schema)
        if (is_array($cart_items) && count($cart_items) > 0) {
            $itemSql = "INSERT INTO order_items (order_id, item_id, quantity, price) 
                        VALUES (:order_id, :item_id, :quantity, :price)";
            $itemStmt = $conn->prepare($itemSql);

            foreach ($cart_items as $ci) {
                // Expecting item structure like { item_id, item_price, quantity }
                $item_id = isset($ci['item_id']) ? (int)$ci['item_id'] : (isset($ci['id']) ? (int)$ci['id'] : null);
                $item_price = isset($ci['item_price']) ? (float)$ci['item_price'] : (isset($ci['price']) ? (float)$ci['price'] : 0);
                $quantity = isset($ci['quantity']) ? (int)$ci['quantity'] : 1;

                if ($item_id === null) {
                    throw new Exception('Missing item_id for order item');
                }

                $executed = $itemStmt->execute([
                    ':order_id' => $order_id,
                    ':item_id' => $item_id,
                    ':quantity' => $quantity,
                    ':price' => $item_price
                ]);

                if (!$executed) {
                    throw new Exception('Failed to insert order item');
                }
            }
        }

        $conn->commit();

        echo json_encode([
            "message" => "Order placed successfully",
            "success" => true,
            "order_code" => $order_code,
            "order_id" => $order_id,
            "total" => $total
        ]);
    } catch (Exception $e) {
        $conn->rollBack();
        http_response_code(500);
        echo json_encode([
            "message" => "Error: " . $e->getMessage(),
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
