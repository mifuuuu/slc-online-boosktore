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

    $item_id = $_GET['item_id'] ?? null;


try {
    if ($item_id) {
        $sql = "SELECT * FROM items WHERE item_id = :item_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            http_response_code(404);
            echo json_encode([
                "message" => "Item not found",
                "success" => false
            ]);
            exit();
        }

        echo json_encode([
            "message" => "Item retrieved successfully",
            "success" => true,
            "data" => $item
        ]);
        exit();
    }

    // If no item_id → get all items
    $sql = "SELECT * FROM items";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "message" => "Items retrieved successfully",
        "success" => true,
        "data" => $items
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "message" => "Error: " . $e->getMessage(),
        "success" => false
    ]);
}
?>
