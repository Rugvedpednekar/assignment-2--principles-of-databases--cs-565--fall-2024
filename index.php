<?php
require("includes/db.php");
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
        <section>
            <h2>How Many Versions of macOS Have Been Released?</h2>
            <div>
            <?php
                echo "<p>There have been <b>" . countOperatingSystemVersions() . "</b> versions of macOS released thus far.</p>";
            ?>
            </div>
        </section>

        <section>
            <h2>Show the Version Name, Release Name, Official Darwin OS Number, Date Announced, Date Released, and Date of Latest Release of All macOS Versions, Listed by Date Order</h2>
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
                        $cols = fetchOperatingSystems();
                        foreach ($cols as $row) {
                            echo "<tr>
                                    <td>{$row['version_name']}</td>
                                    <td>{$row['release_name']}</td>
                                    <td>{$row['darwin']}</td>
                                    <td>{$row['announced']}</td>
                                    <td>{$row['released']}</td>
                                    <td>{$row['last_release']}</td>
                                  </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Show the Version Name (Release Name) and Year Released of all macOS Versions, Listed by Date Released</h2>
            <table>
                <thead>
                    <tr>
                        <th>Version Name (Release Name)</th>
                        <th>Year Released</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cols = fetchOsVersionAndRelease();
                        foreach ($cols as $row) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['released']}</td>
                                  </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Show the Current Inventory (Excluding Comments)</h2>
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
                        $cols = fetchCurrentDeviceInventory();
                        foreach ($cols as $row) {
                            echo "<tr>
                                    <td>{$row['model']}</td>
                                    <td>{$row['model_id']}</td>
                                    <td>{$row['model_number']}</td>
                                    <td>{$row['part_number']}</td>
                                    <td>{$row['serial_number']}</td>
                                    <td>{$row['current_darwin']}</td>
                                    <td>{$row['last_darwin']}</td>
                                    <td><a href='{$row['url']}'>Link</a></td>
                                  </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Show the Model, Installed/Original OS, and the Last Supported OS For the Current Inventory</h2>
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
                        $cols = fetchCurrentInventoryWithOs();
                        foreach ($cols as $row) {
                            echo "<tr>
                                    <td>{$row['model']}</td>
                                    <td>{$row['device_release']}</td>
                                    <td>{$row['model_release']}</td>
                                  </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
