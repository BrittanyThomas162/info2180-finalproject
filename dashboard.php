<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dolphin CRM Dashboard</title>
    <link rel="stylesheet" href="styles_dash.css" />
    <script src="dashboard.js"></script>
  </head>
  <body>
    <div> 
      <!-- header will appear here -->
      <?php include 'header.php'; ?>
    </div>

      <div class="container">
      
        <div id="menu">
          <!-- menu will appear here -->
          <?php include 'menu.php'; ?>
        </div>
        <main>
          <div id = main-content>
            <div class="dashboard-content">
              <h1>Dashboard</h1>
              <button type="button" id="newContactButton" onclick='window.location.href="newContactForm.php"'> 
                <span class="button-icon">
                <ion-icon name="add-outline"></ion-icon>              
                </span>
                <span class="menu-text">Add Contact</span>
            </div>
            <div class="table-display"> 
              <div class="filter-section">
                <p id="filter"> 
                  <span class="filter-icon">
                  <ion-icon name="funnel-outline"></ion-icon>          
                  </span>
                  <span class="menu-text">Filter By</span>
                </p>
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
          </div>
        </div>

        </main>
      
      </div>

      <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  
  </body>
</html>
