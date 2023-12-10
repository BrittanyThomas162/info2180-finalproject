<?php
session_start();

// Check user role
echo $_SESSION['role'];
if ($_SESSION['role'] !== 'admin') {
    echo 'Access denied';
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $username = 'admin';
    $password = 'password123';
    $dbname = 'dolphin_crm';

    $link = mysqli_connect($host, $username, $password, $dbname);
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $firstname = validate_input($_POST['fname']);
    $lastname = validate_input($_POST['lname']);
    $email = validate_input($_POST['email']);
    $role = validate_input($_POST['role']);
    $password = validate_input($_POST['password']);
    $date = date('Y-m-d H:i:s'); // Use current date and time for created_at

    // Additional validation and sanitation code here

    // Hash the password (replace 'your_hashing_algorithm' with an appropriate one)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (firstname, lastname, email, role, password, created_at) VALUES
            ('$firstname', '$lastname', '$email', '$role', '$hashed_password', '$date')";

    if (mysqli_query($link, $sql)) {
        echo "Records added successfully.";
    } else {
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
    }

    mysqli_close($link);
}

function validate_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin CRM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="back">
            <div class="buttons">
                <div><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></div>
                <div><a href="newContactForm.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i>New Contact</a></div>
                <div><a href="users.php"><i class="fa fa-users" aria-hidden="true"></i>Users</a></div>
                <hr>
                <div><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></div> 
            </div>
        </div>
        <div class="background">
            <div class="records">
                <h1>New User</h1>
                <div class="record2">
                    <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                        <div class="table">
                            <div class="cell">
                                <label for="fname">First Name</label>
                                <input type="text" placeholder="Jane" name="fname" id="fname" required />
                            </div>
                            <div class="cell">
                                <label for="lname">Last Name</label>
                                <input type="text" placeholder="Doe" name="lname" id="lname" required />
                            </div>
                        </div>
                        <div class="table">
                            <div class="cell">
                                <label for="email">Email</label>
                                <input type="email" placeholder="something@example.com" name="email" id="email" required />
                            </div>
                            <div class="cell">
                                <label>Password</label>
                                <input type="password" name="password" id="password" required />
                            </div>
                        </div>
                        <div class="table">
                            <div class="cell">
                                <label for="role"> Role</label><br>
                                <select id="role" name="role">
                                    <option value="Admin">Admin</option>
                                    <option value="Member">Member</option>
                                </select>
                            </div><br>
                        </div>
                        <div class="save-button">
                            <button type="submit" id="save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
