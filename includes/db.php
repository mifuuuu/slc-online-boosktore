  <?php
    //variables
    $host = "localhost";    
    $username = "root";
    $password = "";
    $database = "bookstore_db";

    //create connection to database
    try{
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    }catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            "message" => "connection failed:". $e->getMessage(),
            "success" => false
        ]);
        exit();
    }
?>