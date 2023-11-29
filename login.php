<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "user123";
    $password = "password123";
    $dbname = "dolphin_crm";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $sql = "SELECT id, email, password FROM users WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_email"] = $row["email"];

            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }

    $conn->close();
}
?>
