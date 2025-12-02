<?php
header("Content-Type: application/json");
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "message" => "Method Not Allowed",
        "success" => false
    ]);
    exit();
}

$itemId = isset($_GET['item_id']) ? intval($_GET['item_id']) : null;

try {
    if ($itemId) {
        $sql = "SELECT * FROM items WHERE item_id = :item_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':item_id', $itemId, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        // Convert BLOB to Base64 if it exists
        if ($item && !empty($item['image'])) {
            $item['image'] = base64_encode($item['image']);
        }

        $responseData = $item;

    } else {
        $sql = "SELECT * FROM items";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convert each BLOB to Base64
        foreach ($items as &$i) {
            if (!empty($i['image'])) {
                $i['image'] = base64_encode($i['image']);
            }
        }

        $responseData = $items;
    }

    echo json_encode([
        "message" => $itemId ? "Item retrieved successfully" : "Items retrieved successfully",
        "success" => true,
        "data" => $responseData
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "message" => "Error: " . $e->getMessage(),
        "success" => false
    ]);
}
?>
