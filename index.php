<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apple Macintosh Computer Inventory</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,500;1,200;1,500&display=swap">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <?php    
   
   include_once 'includes/config.php';

   // Create database connection
   $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

   if(mysqli_connect_errno())
   {
    echo"Failed to connect";
    exit();
   }
   echo "Connection success!";

   $query = "SELECT COUNT(*) AS total_versions FROM macos_versions";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
   $total_versions = $row['total_versions'];

   // Display total number of macOS versions
   echo "<h2>How Many Versions of macOS Have Been Released?</h2>";
   echo "<p>There have been " . $total_versions . " versions of macOS released thus far.</p>";

   // Close the connection
   mysqli_close($conn);

 
 ?>

</body>
</html>
