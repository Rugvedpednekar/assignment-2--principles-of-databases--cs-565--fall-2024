<?php
require("includes/db.php"); // Ensure db.php connects to the database and includes necessary functions
?>

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
    <header>
        <h1>Apple Macintosh Computer Inventory</h1>
    </header>
    <main>
        <!-- Section 1: Number of macOS Versions Released -->
        <section>
            <h2>How Many Versions of macOS Have Been Released?</h2>
            <div>
                <p>There have been <b><?php echo countOperatingSystemVersions(); ?></b> versions of macOS released thus far.</p>
            </div>
        </section>

        <!-- Section 2: macOS Versions Details -->
        <section>
            <h2>Show the Version Name, Release Name, Official Darwin OS Number, Date Announced, Date Released, and Date of Latest Release of All macOS Versions, Listed by Date Order</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Version Name</th>
                            <th>Release Name</th>
                            <th>Official Darwin OS Number</th>
                            <th>Date Announced</th>
                            <th>Date Released</th>
                            <th>Date of Latest Release</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $osVersions = fetchOperatingSystems(); // Fetch operating systems details
                        foreach ($osVersions as $version) {
                            echo "<tr>
                                    <td>{$version['version_name']}</td>
                                    <td>{$version['release_name']}</td>
                                    <td>{$version['darwin']}</td>
                                    <td>{$version['announced']}</td>
                                    <td>{$version['released']}</td>
                                    <td>{$version['last_release']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section 3: Version Name and Year Released -->
        <section>
            <h2>Show the Version Name (Release Name) and Year Released of all macOS Versions, Listed by Date Released</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Version Name (Release Name)</th>
                            <th>Year Released</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $releaseYears = fetchOsVersionAndRelease(); // Fetch versions and year of release
                        foreach ($releaseYears as $year) {
                            echo "<tr>
                                    <td>{$year['name']}</td>
                                    <td>{$year['released']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section 4: Current Inventory (from models table) -->
        <section>
            <h2>Show the Current Inventory (Excluding Comments)</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Model Identifier</th>
                            <th>Model Number</th>
                            <th>Part Number</th>
                            <th>Serial Number</th>
                            <th>Darwin OS Number</th>
                            <th>Latest Supporting Darwin OS Number</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $inventory = fetchCurrentDeviceInventory(); // Fetch current inventory of devices
                        foreach ($inventory as $item) {
                            echo "<tr>
                                    <td>{$item['model']}</td>
                                    <td>{$item['model_id']}</td>
                                    <td>{$item['model_number']}</td>
                                    <td>{$item['part_number']}</td>
                                    <td>{$item['serial_number']}</td>
                                    <td>{$item['current_darwin']}</td>
                                    <td>{$item['last_darwin']}</td>
                                    <td><a href='{$item['url']}' target='_blank' rel='noopener'>Link</a></td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section 5: Model, Installed OS, and Last Supported OS -->
        <section>
            <h2>Show the Model, Installed/Original OS, and the Last Supported OS For the Current Inventory</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Installed/Original OS</th>
                            <th>Last Supported OS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $osCompatibility = fetchCurrentInventoryWithOs(); // Fetch model and OS compatibility
                        foreach ($osCompatibility as $compatibility) {
                            echo "<tr>
                                    <td>{$compatibility['model']}</td>
                                    <td>{$compatibility['device_release']}</td>
                                    <td>{$compatibility['model_release']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>
</body>
</html>
