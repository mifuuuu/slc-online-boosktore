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
$includeMime = isset($_GET['with_mime']) && $_GET['with_mime'] === 'true';

// Helper function to detect MIME type from binary
function getImageMimeType($imageData) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    return $finfo->buffer($imageData);
}

try {
    if ($itemId) {
        $sql = "SELECT * FROM items WHERE item_id = :item_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':item_id', $itemId, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        // Convert BLOB
        if ($item && !empty($item['image'])) {
            if ($includeMime) {
                $mime = getImageMimeType($item['image']);
                $item['image'] = 'data:' . $mime . ';base64,' . base64_encode($item['image']);
            } else {
                $item['image'] = base64_encode($item['image']);
            }
        }

        $responseData = $item;

    } else {
        $sql = "SELECT * FROM items";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($items as &$i) {
            if (!empty($i['image'])) {
                if ($includeMime) {
                    $mime = getImageMimeType($i['image']);
                    $i['image'] = 'data:' . $mime . ';base64,' . base64_encode($i['image']);
                } else {
                    $i['image'] = base64_encode($i['image']);
                }
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
