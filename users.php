<?php
session_start ();

// If ($_SESSION['role'] != 'admin'){
// 	echo 'acess denied';
// 	exit;
// }

$host = 'localhost';
$username = 'admin';
$password = 'password123';
$dbname = 'dolphin_crm';

$link = mysqli_connect($host, $username, $password, $dbname);
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
else{
	$sql_check = "SELECT * FROM users" ;
	$result = mysqli_query($link,$sql_check);
			}
?>


<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dolphin CRM- Users</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  	<link rel="stylesheet" href="styles.css">
		</head>
	<body>
		<?php include 'header.php';?>
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
