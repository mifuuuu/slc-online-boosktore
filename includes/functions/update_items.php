<?php
header("Content-Type: application/json");
require_once '../db.php';

// Detect PUT override
$method = $_SERVER['REQUEST_METHOD'];
if(isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    $method = 'PUT';
}

if($method !== 'PUT') {
    http_response_code(405);
    echo json_encode(["message"=>"Method Not Allowed","success"=>false]);
    exit();
}

// Required fields
$requiredFields = ['item_id','sku','item_name','description','item_price','stock'];
foreach($requiredFields as $field){
    if(!isset($_POST[$field]) || empty(trim($_POST[$field]))){
        http_response_code(400);
        echo json_encode(["message"=>"Field '$field' is required","success"=>false]);
        exit();
    }
}

// Collect data
$item_id = $_POST['item_id'];
$sku = $_POST['sku'];
$item_name = $_POST['item_name'];
$description = $_POST['description'];
$item_price = $_POST['item_price'];
$stock = $_POST['stock'];

// Handle image upload if exists
$imageBlob = null;
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
    $imageBlob = file_get_contents($_FILES['image']['tmp_name']);
}

try {
    if($imageBlob !== null){
        $sql = "UPDATE items 
                SET sku=:sku, item_name=:item_name, description=:description, item_price=:item_price, stock=:stock, image=:image 
                WHERE item_id=:item_id";
    } else {
        $sql = "UPDATE items 
                SET sku=:sku, item_name=:item_name, description=:description, item_price=:item_price, stock=:stock 
                WHERE item_id=:item_id";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sku', $sku);
    $stmt->bindParam(':item_name', $item_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':item_price', $item_price);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);

    if($imageBlob !== null){
        $stmt->bindParam(':image', $imageBlob, PDO::PARAM_LOB);
    }

    if($stmt->execute()){
        echo json_encode(["message"=>"Item updated successfully","success"=>true]);
    } else {
        http_response_code(500);
        echo json_encode(["message"=>"Failed to update item","success"=>false]);
    }

} catch(PDOException $e){
    http_response_code(500);
    echo json_encode(["message"=>"Error: ".$e->getMessage(),"success"=>false]);
}
?>
