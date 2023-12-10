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

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dolphin CRM- Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

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
        <td><a href="contactDetails.php?contactID=<?= $row['id'] ?>">View</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>

</html>

