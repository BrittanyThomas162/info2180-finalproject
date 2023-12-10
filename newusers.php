<?php session_start();
	

	if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])){

        $passwordError= "";

        /**
         * It takes a string, removes leading and trailing whitespace, removes backslashes, and
         * converts special characters to HTML entities.
         * 
         * @param input The input to be validated.
         * 
         * @return the value of the variable .
         */
        function validate_input($input){
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
		
		/* This is connecting to the database. */
        $link = mysqli_connect('localhost', 'admin', 'password123', 'dolphin_crm');
		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

        
        $fname= validate_input($fname);
        $lname= validate_input($lname);
        $email= validate_input($email);
        $role= validate_input($role);

        $password= validate_input($password);
        //Regex to Verify passwords
        preg_match('/[0-9]+/', $password, $matches);
        if (sizeof($matches)== 0){
            $passwordError= "The password must have atleast one number <br>";
            echo $passwordError;
            exit;
        }

        preg_match('/[a-z]/', $password, $matches);
        if (sizeof($matches)== 0){
            $passwordError= "The password must have atleast one lowercase letter <br>";
            echo $passwordError;
            exit;
        }

        preg_match('/[A-Z]/', $password, $matches);
        if (sizeof($matches)== 0){
            $passwordError= "The password must have atleast one Uppercase letter <br>";
            echo $passwordError;
            exit;
        }

        if (strlen($password) < 8){
            $passwordError= "The password must have atleast eight characters <br>";
            echo $passwordError;
            exit;
        } 


		//$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users (firstname, lastname, password, email, role) VALUES
            ('$fname', '$lname', '$password', '$email', '$role')";



		/* This is checking to see if the query was successful. */
        if(mysqli_query($link, $sql)){
			echo "Records added successfully.";
		} else{
			echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
		}
	
	mysqli_close($link);
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
