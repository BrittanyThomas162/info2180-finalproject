<!DOCTYPE html>
<html>
<head>
    <title>New Contact</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    
    <link rel="stylesheet" type="text/css" href="menu.css">

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
            height: 32px;
            width: 10%;
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
    <h1>New Contact</h1>
    <form action="newContact.php" method="POST" >
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
