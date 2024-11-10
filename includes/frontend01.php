<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apple Macintosh Computer Inventory</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,500;1,200;1,500&display=swap">
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: 'IBM Plex Sans', sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f9;
    }
    h2 {
      font-size: 24px;
      color: #333;
    }
    p {
      font-size: 18px;
      color: #555;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    .content {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 1000px;
      margin: 20px auto;
    }
    .error {
      color: red;
      font-size: 18px;
    }
  </style>
</head>
<body>

  <div class="content">
    <?php    
      include_once 'includes/config.php';

      // Create database connection
      $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

      if(mysqli_connect_errno()) {
          echo "<p class='error'>Failed to connect to the database: " . mysqli_connect_error() . "</p>";
          exit();
      }

      // Query to count the total number of macOS versions
      $query = "SELECT COUNT(*) AS total_versions FROM macos_versions";
      $result = mysqli_query($conn, $query);

      if ($result) {
          $row = mysqli_fetch_assoc($result);
          $total_versions = $row['total_versions'];

          // Display total number of macOS versions
          echo "<h2>How Many Versions of macOS Have Been Released?</h2>";
          echo "<p>There have been <strong>" . $total_versions . "</strong> versions of macOS released thus far.</p>";
      } else {
          echo "<p class='error'>Error executing query: " . mysqli_error($conn) . "</p>";
      }

      // Query for version details (listed by date order)
      $query_versions = "SELECT version_name, release_name, darwin_os_number, date_announced, date_released, date_latest_release FROM macos_versions ORDER BY date_released";
      $result_versions = mysqli_query($conn, $query_versions);

      if ($result_versions) {
          echo "<h2>Show the Version Name, Release Name, Official Darwin OS Number, Date Announced, Date Released, and Date of Latest Release of All macOS Versions, Listed by Date Order</h2>";
          echo "<table><tr><th>Version Name</th><th>Release Name</th><th>Official Darwin OS Number</th><th>Date Announced</th><th>Date Released</th><th>Date of Latest Release</th></tr>";

          while ($row_versions = mysqli_fetch_assoc($result_versions)) {
              echo "<tr>";
              echo "<td>" . $row_versions['version_name'] . "</td>";
              echo "<td>" . $row_versions['release_name'] . "</td>";
              echo "<td>" . $row_versions['darwin_os_number'] . "</td>";
              echo "<td>" . $row_versions['date_announced'] . "</td>";
              echo "<td>" . $row_versions['date_released'] . "</td>";
              echo "<td>" . $row_versions['date_latest_release'] . "</td>";
              echo "</tr>";
          }
          echo "</table>";
      } else {
          echo "<p class='error'>Error executing query: " . mysqli_error($conn) . "</p>";
      }

      // Query for version name and year released
      $query_versions_year = "SELECT version_name, release_name, year_released FROM macos_versions ORDER BY year_released";
      $result_versions_year = mysqli_query($conn, $query_versions_year);

      if ($result_versions_year) {
          echo "<h2>Show the Version Name (Release Name) and Year Released of All macOS Versions, Listed by Date Released</h2>";
          echo "<table><tr><th>Version Name (Release Name)</th><th>Year Released</th></tr>";

          while ($row_versions_year = mysqli_fetch_assoc($result_versions_year)) {
              echo "<tr>";
              echo "<td>" . $row_versions_year['version_name'] . " (" . $row_versions_year['release_name'] . ")</td>";
              echo "<td>" . $row_versions_year['year_released'] . "</td>";
              echo "</tr>";
          }
          echo "</table>";
      } else {
          echo "<p class='error'>Error executing query: " . mysqli_error($conn) . "</p>";
      }

      // Query for current inventory
      $query_inventory = "SELECT model_name, model_identifier, model_number, part_number, serial_number, darwin_os_number, latest_supporting_darwin_os_number, url FROM inventory";
      $result_inventory = mysqli_query($conn, $query_inventory);

      if ($result_inventory) {
          echo "<h2>Show the Current Inventory (Excluding Comments)</h2>";
          echo "<table><tr><th>Model Name</th><th>Model Identifier</th><th>Model Number</th><th>Part Number</th><th>Serial Number</th><th>Darwin OS Number</th><th>Latest Supporting Darwin OS Number</th><th>URL</th></tr>";

          while ($row_inventory = mysqli_fetch_assoc($result_inventory)) {
              echo "<tr>";
              echo "<td>" . $row_inventory['model_name'] . "</td>";
              echo "<td>" . $row_inventory['model_identifier'] . "</td>";
              echo "<td>" . $row_inventory['model_number'] . "</td>";
              echo "<td>" . $row_inventory['part_number'] . "</td>";
              echo "<td>" . $row_inventory['serial_number'] . "</td>";
              echo "<td>" . $row_inventory['darwin_os_number'] . "</td>";
              echo "<td>" . $row_inventory['latest_supporting_darwin_os_number'] . "</td>";
              echo "<td><a href='" . $row_inventory['url'] . "'>Link</a></td>";
              echo "</tr>";
          }
          echo "</table>";
      } else {
          echo "<p class='error'>Error executing query: " . mysqli_error($conn) . "</p>";
      }

      // Query for installed/original OS and last supported OS for the current inventory
      $query_os = "SELECT model_name, installed_os, last_supported_os FROM model_os_compatibility";
      $result_os = mysqli_query($conn, $query_os);

      if ($result_os) {
          echo "<h2>Show the Model, Installed/Original OS, and the Last Supported OS For the Current Inventory</h2>";
          echo "<table><tr><th>Model</th><th>Installed/Original OS</th><th>Last Supported OS</th></tr>";

          while ($row_os = mysqli_fetch_assoc($result_os)) {
              echo "<tr>";
              echo "<td>" . $row_os['model_name'] . "</td>";
              echo "<td>" . $row_os['installed_os'] . "</td>";
              echo "<td>" . $row_os['last_supported_os'] . "</td>";
              echo "</tr>";
          }
          echo "</table>";
      } else {
          echo "<p class='error'>Error executing query: " . mysqli_error($conn) . "</p>";
      }

      // Close the connection
      mysqli_close($conn);
    ?>
  </div>

</body>
</html>
