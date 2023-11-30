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

  $filterStatus = isset($_GET['filter']) ? $_GET['filter'] : 'all';

  // Get the user ID from the session
  $loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

  // Prepare the SQL query with the filter condition
  if ($filterStatus === 'assigned' && $loggedInUserId !== null) {
      $stmt = $conn->prepare("SELECT * FROM contacts WHERE assigned_to = :loggedInUserId");
      $stmt->bindParam(':loggedInUserId', $loggedInUserId, PDO::PARAM_INT);
      $stmt->execute();
  } elseif ($filterStatus === 'salesLead') {
      $stmt = $conn->prepare("SELECT * FROM contacts WHERE type = 'Sales Lead'");
      $stmt->execute();
  } elseif ($filterStatus === 'support') {
      $stmt = $conn->prepare("SELECT * FROM contacts WHERE type = 'Support'");
      $stmt->execute();
  } else {
      $stmt = $conn->query("SELECT * FROM contacts");
      $stmt->execute();
  }
  
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}
?>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Company</th>
      <th>Type</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['title'] . ' ' . $row['firstname'] . ' ' . $row['lastname']; ?></td>
      <td> <?= $row['email'] ?> </td>
      <td> <?= $row['company'] ?> </td>
      <td> <?= $row['type'] ?> </td>
      <td><a href="contactDetails.html?contactID=<?= $row['id'] ?>">View</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>



