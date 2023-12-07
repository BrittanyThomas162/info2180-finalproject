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
                    <h1>New User</h1>
                    <div class="record2">
                        <?php
                            session_start();

                            // If ($_SESSION['role'] != 'admin'){
                            //     echo 'access denied';
                            //     exit;
                            //}

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $host = 'localhost';
                                $username = 'admin';
                                $password = 'password123';
                                $dbname = 'dolphin_crm';

                                $link = mysqli_connect($host, $username, $password, $dbname);
                                if($link === false){
                                    die("ERROR: Could not connect. " . mysqli_connect_error());
                                }

                                $fullname = validate_input($_POST['fullname']);
                                $email = validate_input($_POST['email']);
                                $role = validate_input($_POST['role']);
                                $date = validate_input($_POST['date']);

                                // Your additional validation and sanitation code here

                                // Insert data into the database
                                $sql = "INSERT INTO users (firstname, lastname, password, email, role, created_at) VALUES
                                        ('$fname', '$lname', '$hashed_password', '$email', '$role', '$date')";

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

                        <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                            <table>
                                <tr>
                                    <td><label for="fullname">Full Name:</label></td>
                                    <td colspan="3">
                                        <input type="text" placeholder="John Doe" name="fullname" id="fullname" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="email">Email:</label></td>
                                    <td colspan="3">
                                        <input type="email" placeholder="something@example.com" name="email" id="email" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="role">Role:</label></td>
                                    <td>
                                        <select id="role" name="role">
                                            <option value="Admin">Admin</option>
                                            <option value="Member">Member</option>
                                        </select>
                                    </td>
                                    <td><label for="date">Date:</label></td>
                                    <td>
                                        <input type="date" name="date" id="date" required/>
                                    </td>
                                </tr>
                            </table>
                            <div class="save-button">
                                <button type="submit" id="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
