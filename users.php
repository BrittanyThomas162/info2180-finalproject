<?php
session_start();

$host = 'localhost';
$username = 'admin';
$password = 'password123';
$dbname = 'dolphin_crm';

$link = mysqli_connect($host, $username, $password, $dbname);
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    $sql_check = "SELECT * FROM users";
    $result = mysqli_query($link, $sql_check);
}

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
    $passwordError = "";

    function validate_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $link = mysqli_connect('localhost', 'admin', 'password123', 'dolphin_crm');
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $fname = validate_input($fname);
    $lname = validate_input($lname);
    $email = validate_input($email);
    $role = validate_input($role);

    $password = validate_input($password);
    // Verify passwords
    preg_match('/[0-9]+/', $password, $matches);
    if (sizeof($matches) == 0) {
        $passwordError = "The password must have at least one number <br>";
        echo $passwordError;
        exit;
    }

    preg_match('/[a-z]/', $password, $matches);
    if (sizeof($matches) == 0) {
        $passwordError = "The password must have at least one lowercase letter <br>";
        echo $passwordError;
        exit;
    }

    preg_match('/[A-Z]/', $password, $matches);
    if (sizeof($matches) == 0) {
        $passwordError = "The password must have at least one uppercase letter <br>";
        echo $passwordError;
        exit;
    }

    if (strlen($password) < 8) {
        $passwordError = "The password must have at least eight characters <br>";
        echo $passwordError;
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (firstname, lastname, password, email, role) VALUES
            ('$fname', '$lname', '$hashed_password', '$email', '$role')";

    if (mysqli_query($link, $sql)) {
        echo "Records added successfully.";
    } else {
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin CRM- Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <div class="back">
            <div class="buttons">
                <div><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></div>
                <div><a href="newcontact.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i>New Contact</a></div>
                <div><a href="users.php"><i class="fa fa-users" aria-hidden="true"></i>Users</a></div>
                <hr>
                <div><a href="login.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></div>
            </div>
        </div>    
        <div class="background">
            <div class="records">
                <div class="top-button">
                    <h1>Users</h1>
                    <div><a href="newuser.php"><i class="fa fa-plus" aria-hidden="true"></i>Add User</a></div>
                </div>    
                <div class="record2">
                    <?php
                    session_start();

                    // If ($_SESSION['role'] != 'admin'){
                    // 	echo 'acess denied';
                    // 	exit;
                    //}

                    $host = 'localhost';
                    $username = 'admin';
                    $password = 'password123';
                    $dbname = 'dolphin_crm';

                    $link = mysqli_connect($host, $username, $password, $dbname);
                    if($link === false){
                        die("ERROR: Could not connect. " . mysqli_connect_error());
                    }
                    else {
                        $sql_check = "SELECT * FROM users" ;
                        $result = mysqli_query($link, $sql_check);
                    }
                    ?>
                    <div class="tables">
                        <div class="db">
                            <div>
                                
                            </div>
                        </div>
                        <div class="db">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $customer): ?>
                                    <tr>
                                        <td><?= $customer['firstname']." ".$customer['lastname']; ?></td>
                                        <td><?= $customer['email']; ?></td>
                                        <td><?= $customer['role']; ?></td>
                                        <td><?= $customer['created_at']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


