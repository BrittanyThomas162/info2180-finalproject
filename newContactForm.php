<!DOCTYPE html>
<html>
<head>
    <title>New Contact</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="menu.css">

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
            $result = $stmt->fetch_assoc();

            $sql = "INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'sssssssssss', $title, $firstname, $lastname, $email, $telephone, $company, $type, $assigned_to, $created_by, $created_at, $updated_at);
            mysqli_stmt_execute($stmt);

            
            if(mysqli_stmt_affected_rows($stmt) > 0){
                $_SESSION['message'] = "Contact successfully created";
            } else {
                $_SESSION['message'] = "Error creating contact: " . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }
    ?>


   
    <style>
        body{
            color:black;  
        }
        header{
            margin-bottom:20px;
        }
        .main-container {
            display: grid;
            grid-template-columns: 1fr 5fr;
        }

        form {
            /* width: 100%; */
            grid-column:2;
        }
        h1,form{  
            margin-top: 20px;
            margin-bottom: 20px;
            border:1px solid #212529;
            border-radius: 5px;
            padding: 10px;
            margin-left: 10%;
            margin-right: 10%;
        }
        h1{
            margin-top:0;
        }

        .form-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 1em;
        }

        label {
            margin-bottom: 0.5em;
            color:#525156;
        }

        input, select {
            margin-bottom: 1em;
            height: 38px;
            width: 12%;
            font-size: 14px;
        }

        #type{
            width: 200px;
        }

        input{
            width: 70%;
            font-size: 14px;
        }
        
        input[type="submit"]{
            width: 100px;
            height: 32px;
            background-color: #430ABF;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight:bold;
            display: block;
            margin: auto;
        }

    </style> 

</head>
<header>
<?php 
    include "header.php"; 
    ?>
    
</header>
<body>
    <div class="main-container">
        <div class="menu">
            <?php include 'menu.php'; ?>
        </div>
    <div class=contactform>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p style='text-align: center;'>".$_SESSION['message']."</p>";
        // unset the message after displaying it
        unset($_SESSION['message']);
    }
    ?>  
    <h1>New Contact</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
        <div class="form-row">
        <label for="title">Title</label>
        <select id="title" name="title">
            <option value="mr">Mr.</option>
            <option value="ms">Ms.</option>
            <option value="mrs">Mrs.</option>
            <option value="dr">Dr.</option>
        </select>
        </div>
        <div class="form-row">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" required>
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" required>
        </div>
        <div class="form-row">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="tel">Telephone</label>
            <input type="tel" id="tel" name="tel" required>
        </div>
        <div class="form-row">
            <label for="company">Company</label>
            <input type="text" id="company" name="company" required>
            <label for="type">Type</label>
            <select id="type" name="type" required>
                <option value="Sales Lead">Sales Lead</option>
                <option value="Support">Support</option>
            </select>
        </div>
        <div class="form-row">
        <label for="assigned">Assigned To</label>
        <select id="assigned" name="assigned" required>
            <option value="">Select a person...</option>

             <?php
            // Fetch users from the database
            $host = 'localhost';
            $username = 'user123';
            $password = 'password123';
            $dbname = 'dolphin_crm';

            // Database connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $userQuery = "SELECT id, firstname, lastname FROM users";
            $userResult = $conn->query($userQuery);

            if ($userResult->rowCount() > 0) {
                while ($user = $userResult->fetch(PDO::FETCH_ASSOC)) {
                    $userId = $user['id'];
                    $userName = $user['firstname'] . ' ' . $user['lastname'];
                    echo "<option value=\"$userId\">$userName</option>";
                }
            }
            ?>
        </select>
          
        <input type="submit" value="Save">
        </div>
    </form>
    </div>
    </div>
</body>
</html>

