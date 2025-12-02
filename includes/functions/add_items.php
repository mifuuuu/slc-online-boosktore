<?php
header("Content-Type: application/json");
require_once '../db.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "message" => "Method Not Allowed",
        "success" => false
    ]);
    exit();
}

// Check required fields
$requiredFields = ['sku', 'item_name', 'description', 'item_price', 'stock'];
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
$sku = $_POST['sku'];
$item_name = $_POST['item_name'];
$description = $_POST['description'];
$item_price = $_POST['item_price'];
$stock = $_POST['stock'];

// Handle image (store as BLOB)
$imageBlob = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $fileType = mime_content_type($_FILES['image']['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        http_response_code(400);
        echo json_encode([
            "message" => "Invalid file type. Only JPG/PNG images are allowed.",
            "success" => false
        ]);
        exit();
    }

    // Read the image file as binary
    $imageBlob = file_get_contents($_FILES['image']['tmp_name']);
}

try {
    // Insert data into database (store image as BLOB)
    $sql = "INSERT INTO items (sku, item_name, description, item_price, stock, image)
            VALUES (:sku, :item_name, :description, :item_price, :stock, :image)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':sku', $sku);
    $stmt->bindParam(':item_name', $item_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':item_price', $item_price);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':image', $imageBlob, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        echo json_encode([
            "message" => "Item added successfully",
            "success" => true
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "message" => "Failed to add item",
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
