<?php   

session_start();  

// Set the user ID in the session (for testing purposes)
$_SESSION['user_id'] = '1';       //ENSURE this is stored when logging in

$host = 'localhost';
$username = 'user123';
$password = 'password123';
$dbname = 'dolphin_crm';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch contact details
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = :id"); // replace with your actual SQL query
    $stmt->execute(['id' => $id]); // replace $id with the actual contact id

    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="contactDetails.css">
        <title>Contact Details</title>
    </head>
    <body>
        <div class="contact-details">
            <?php if ($contact): ?>
                <div class="contact-name"><?php echo $contact['title'] . ' ' . $contact['firstname'] . ' ' . $contact['lastname']; ?></div>
                <div class="contact-created_at">Created At: <?php echo $contact['created_at']; ?></div>
                <div class="contact-updated_at">Updated At: <?php echo $contact['updated_at']; ?></div>
                <div class="container">
                    <div class="contact-email">Email: <?php echo $contact['email']; ?></div>
                    <div class="contact-company">Company: <?php echo $contact['company']; ?></div>
                    <div class="contact-telephone">Telephone: <?php echo $contact['telephone']; ?></div>
                    <div class="contact-assigned_to">Assigned To: <?php echo $contact['assigned_to']; ?></div>
                </div>
                <div>
                    <p>Notes</p>
                    <div id="display-notes">
                        <!-- notes will appear here -->
                    </div>
                    <div id="add-notes">
                        <!-- May need to pass contact ID in url to update-notes.php -->

                        <form id="add-notes-form" action="update-notes.php" method="post">
                            <div>
                                <label for="notes">Add a note about ...</label>
                            </div>
                            <div>
                                <textarea name="notes" rows="5" cols="100" id="notes" placeholder="Enter details here" required></textarea>
                            </div>
                            <button type="submit" name="submitBtn" id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
        
        </div>    
            <?php else: ?>
                <div>No contact found with id <?php echo $id; ?></div>
            <?php endif; ?>
        </div>
    </body>
</html>

<?php
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
