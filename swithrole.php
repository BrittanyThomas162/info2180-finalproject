<?php

session_start();  

// Set the user ID in the session (for testing purposes)
$_SESSION['user_id'] = '1';       //ENSURE this is stored when logging in

$host = 'localhost';
$username = 'user123';
$password = 'password123';
$dbname = 'dolphin_crm';

// Database connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the contact ID and new role from the POST data
$contactId = $_POST['id'];
$newRole = $_POST['type'];

// Update the role field in the contacts table
$stmt = $conn->prepare("UPDATE contacts SET type = :new_role WHERE id = :contact_id");
$stmt->execute(['new_role' => $newRole, 'contact_id' => $contactId]);
?>