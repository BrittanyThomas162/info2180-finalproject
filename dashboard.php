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
      <div> 
        <!-- header will appear here -->
        <?php include 'header.php'; ?>
      </div>
      
      <div>
        <!-- menu will appear here -->
        <?php include 'menu.php'; ?>
      </div>
      <main>
        <div class="container">
          <h1>Dashboard</h1>
          <button>Add Contact</button>
        </div>
        <div class="Filter">
          <p>Filter By:</p>
          <ul id="filterOptions">
            <li><a href="#" id="all">All</a></li>
            <li><a href="#" id="salesLead">Sales Leads</a></li>
            <li><a href="#" id="support">Support</a></li>
            <li><a href="#" id="assigned">Assigned to me</a></li>
          </ul>
        </div>
        <div id="contactsTable">
          <!-- contacts will appear here -->
        </div>
      </main>
    </div>
  </body>
</html>
