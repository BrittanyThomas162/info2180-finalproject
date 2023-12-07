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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dolphin CRM Dashboard</title>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <script src="dashboard.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <p>Dolphin CRM</p>
        </header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">New Contact</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
            <div class="background">
                <div class="records">
                    <div class="top-button">
                        <h1>Users</h1>
                        <div><a href="newuser.php"><i class="fa fa-plus" aria-hidden="true"></i>Add User</a></div>
                    </div>    
                    <div class="record2">
                        <?php
                        foreach ($result as $customer):
                        ?>
                        <div class="tables">
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
                                        <tr>
                                            <td><?= $customer['firstname']." ".$customer['lastname']; ?></td>
                                            <td><?= $customer['email']; ?></td>
                                            <td><?= $customer['role']; ?></td>
                                            <td><?= $customer['created_at']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($link);
?>
