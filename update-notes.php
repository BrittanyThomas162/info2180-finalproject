<?php 

session_start();  

// Set the user ID in the session (for testing purposes)
$_SESSION['user_id'] = '1';       //ENSURE this is stored when logging in

$host = 'localhost';
$username = 'user123';
$password = 'password123';
$dbname = 'dolphin_crm';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$comment = trim(filter_var($_POST['notes'],FILTER_SANITIZE_STRING));
    
    $contactID = isset($_GET['contactID']) ? $_GET['contactID'] : '';
    $created_by = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $created_at = date('Y-m-d H:i:s');

    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("INSERT INTO notes (contact_id,comment,created_by,created_at) VALUES (:contactID,:comment,:created_by,:created_at)");
        $stmt->bindParam(':contactID', $contactID, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':created_by', $created_by, PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);

        $stmt->execute();
    
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }



} 


?>