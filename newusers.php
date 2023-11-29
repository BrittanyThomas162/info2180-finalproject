<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin CRM</title>
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
                <h1>New User</h1>
                <div class="record2">
                    
                    <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                        <div class="table">
                            <div class="cell">
                                <label for="fname">First Name</label>
                                <input type="text" placeholder="Jane" name="fname" id="fname" required/>
                            </div>
                            <div class="cell">
                                <label for="lname">Last Name</label>
                                <input type="text" placeholder="Doe" name="lname" id="lname" required/>
                            </div>
                        </div>
                        <div class="table">
                            <div class="cell">
                                <label for="email">Email</label>
                                <input type="email" placeholder="something@example.com" name="email" id="email" required/>
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
