<?php

// Database connection function
function initializeDatabaseConnection(): mysqli {
    // Include the config file for DB credentials
    include_once "config.php";

    // Create a new MySQLi instance to connect to the database
    $db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    // Check if the connection was successful
    if ($db->connect_error) {
        die("Database connection failed: " . $db->connect_error);
    }

    // Set the charset for proper encoding (UTF-8)
    $db->set_charset("utf8mb4");

    return $db;
}

// Function to count the number of OS versions
function countOperatingSystemVersions(): int {
    try {
        $db = initializeDatabaseConnection();
        $query = "SELECT COUNT(*) FROM os";
        $result = $db->query($query);

        if (!$result) {
            throw new Exception("Error executing query: " . $db->error);
        }

        // Fetch the count
        $row = $result->fetch_row();
        return (int)$row[0];  // Return the count
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}

// Function to fetch all operating systems
function fetchOperatingSystems(): array {
    try {
        $db = initializeDatabaseConnection();
        $query = "SELECT version_name, release_name, darwin, announced, released, last_release
                  FROM os
                  NATURAL JOIN dates
                  ORDER BY announced";
        $result = $db->query($query);

        if (!$result) {
            throw new Exception("Error executing query: " . $db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}

// Helper function to format OS version details
function formatVersionColumn(array $col): array {
    $colMod["name"] = $col["version_name"] . " (" . $col["release_name"] . ")";
    $colMod["released"] = substr($col["released"], 0, 4);  // Extract only the year
    return $colMod;
}

// Fetch OS version and release data, formatted
function fetchOsVersionAndRelease(): array {
    try {
        $db = initializeDatabaseConnection();
        $query = "SELECT version_name, release_name, released
                  FROM os
                  NATURAL JOIN dates
                  ORDER BY released";
        $result = $db->query($query);

        if (!$result) {
            throw new Exception("Error executing query: " . $db->error);
        }

        $osData = $result->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array
        return array_map("formatVersionColumn", $osData);  // Format each row
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}

// Function to fetch the current device inventory
function fetchCurrentDeviceInventory(): array {
    try {
        $db = initializeDatabaseConnection();
        $query = "SELECT models.model,
                         models.model_id,
                         models.model_number,
                         models.part_number,
                         models.serial_number,
                         models.darwin AS current_darwin,
                         os.darwin AS last_darwin,
                         models.url
                  FROM models
                  LEFT JOIN os ON models.darwin = os.darwin";
        $result = $db->query($query);

        if (!$result) {
            throw new Exception("Error executing query: " . $db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}

// Function to fetch the current inventory with OS release data
function fetchCurrentInventoryWithOs(): array {
    try {
        $db = initializeDatabaseConnection();
        $query = "SELECT models.model,
                         os_release.release_name AS model_release,
                         installed_release.release_name AS device_release
                  FROM models
                  JOIN os AS os_release ON models.darwin = os_release.darwin
                  JOIN os AS installed_release ON models.darwin = installed_release.darwin";
        $result = $db->query($query);

        if (!$result) {
            throw new Exception("Error executing query: " . $db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}

?>
