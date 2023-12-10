<?php
session_start();

// Check user role
if ($_SESSION['role'] !== 'admin') {
    echo 'Access denied';
    exit;
}

$passwordError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $username = 'admin';
    $password = 'password123';
    $dbname = 'dolphin_crm';

    $link = mysqli_connect($host, $username, $password, $dbname);
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $fname = validate_input($_POST['fname']);
    $lname = validate_input($_POST['lname']);
    $email = validate_input($_POST['email']);
    $role = validate_input($_POST['role']);
    $password = validate_input($_POST['password']);

    // Password validation
    if (!preg_match('/[0-9]/', $password)) {
        $passwordError .= "The password must have at least one numeric digit\n";
    }

    if (!preg_match('/[a-z]/', $password)) {
        $passwordError .= "The password must have at least one lowercase letter\n";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $passwordError .= "The password must have at least one uppercase letter\n";
    }

    if (strlen($password) < 8) {
        $passwordError .= "The password must have at least eight characters\n";
    }

    // Check if there were password errors
    if (!empty($passwordError)) {
        echo $passwordError;
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO users (firstname, lastname, password, email, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sssss', $fname, $lname, $hashed_password, $email, $role);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Records added successfully.";
    } else {
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
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
	  	<link rel="stylesheet" href="styles.css">
		</head>
	<body>
		<?php include 'header.php';?>
		<div class="container">
			<div class="back">
				<div class="buttons">
					<div><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></div>
					<div><a href="newContact.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i>New Contact</a></div>
					<div><a href="users.php"><i class="fa fa-users" aria-hidden="true"></i>Users</a></div>
					<hr>
					<div><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></div>
				</div>
			</div>	
			<div class="background">
				<div class="records">
					<h1>New User</h1>
					<div class="record2">
						
							<form method = "post" action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
							<div class="table">
								<div class="cell">
									<label for="fname">First Name</label>
									<input type="text" placeholder= "Jane" name="fname" id="fname" required/>
								</div>
								<div class="cell">
									<label for="lname">Last Name</label>
									<input type="text" placeholder= "Doe" name="lname" id="lname" required/>
								</div>
							</div>
							<div class="table">
								<div class="cell">
									<label for="email">Email</label>
									<input type="email" placeholder= "something@example.com" name="email" id="email" required/>
								</div>
								<div class="cell">
									<label>Password</label>
									<input type="text" name="password" id="password" required/>
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
