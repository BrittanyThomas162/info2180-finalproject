<?php
session_start();

$_SESSION['user_id'] = '1';       

$host = 'localhost';
$username = 'user123';
$password = 'password123';
$dbname = 'dolphin_crm';


// Database connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the contact ID from the POST data
$contactId = $_POST['id'];

// Get the ID of the logged-in user
$userId = $_SESSION['user_id'];

// Update the assigned_to field in the contacts table
$stmt = $conn->prepare("UPDATE contacts SET assigned_to = :user_id WHERE id = id");
$stmt = $conn->prepare("UPDATE contacts SET assigned_to = :user_id, updated_at = NOW() WHERE id = :contact_id");
$stmt->execute(['user_id' => $userId, 'contact_id' => $contactId]);
$stmt->execute(['user_id' => $userId, 'contact_id' => $contactId]);

?>