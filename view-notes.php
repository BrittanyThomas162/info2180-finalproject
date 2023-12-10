<?php   

$host = 'localhost';
$username = 'user123';
$password = 'password123';
$dbname = 'dolphin_crm';

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $contactID = isset($_GET['contactID']) ? $_GET['contactID'] : '';
  //echo $contactID;
  //$contactID = '1'; //JUST for testing, contact id should be passed in the url

  $stmt = $conn->prepare("SELECT users.firstname, users.lastname, notes.comment,notes.created_at FROM notes JOIN users ON notes.created_by=users.id WHERE notes.contact_id = :contactID");
  $stmt->bindParam(':contactID', $contactID, PDO::PARAM_INT);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}
?>
<?php foreach ($results as $row): ?>
  <div class="note">
  <p id="name"><?= $row['firstname'] . ' ' . $row['lastname']; ?></p>
  <p id="note"><?= $row['comment']; ?></p>
    <?php 
    $datetimeString = $row['created_at'];  
    $dateTime = new DateTime($datetimeString);
    $formattedDatetime = $dateTime->format("F j, Y \a\\t ga");
    ?>
    <p id="date"><?= $formattedDatetime; ?></p>
  </div>


<?php endforeach; ?>






