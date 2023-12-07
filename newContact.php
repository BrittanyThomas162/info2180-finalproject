<?php
session_start();
$_SESSION['user_id'] = '1';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "user123";
    $password = "password123";
    $dbname = "dolphin_crm";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }    


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $title = trim(filter_var($_POST['title'],FILTER_SANITIZE_STRING));
        $firstname = trim(filter_var($_POST['fname'],FILTER_SANITIZE_STRING));
        $lastname = trim(filter_var($_POST['lname'],FILTER_SANITIZE_STRING));
        $email = trim(filter_var($_POST['email'],FILTER_SANITIZE_STRING));
        $telephone = trim(filter_var($_POST['tel'],FILTER_SANITIZE_STRING));
        $company = trim(filter_var($_POST['company'],FILTER_SANITIZE_STRING));
        $assigned_to = trim(filter_var($_POST['assigned'],FILTER_SANITIZE_STRING));
        $type = trim(filter_var($_POST['type'],FILTER_SANITIZE_STRING));

        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $created_by = $_SESSION['user_id'];
        $stmt = $conn->query("SELECT firstname, lastname FROM users WHERE id= '$created_by'");
        // $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        $result = $stmt->fetch_assoc();

        $sql = "INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssssss', $title, $firstname, $lastname, $email, $telephone, $company, $type, $assigned_to, $created_by, $created_at, $updated_at);
        mysqli_stmt_execute($stmt);

        
        if(mysqli_stmt_affected_rows($stmt) > 0){
            echo "Contact created successfully.";
        } else {
            echo "Error creating contact: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>