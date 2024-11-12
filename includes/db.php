<?php

function initializeDatabaseConnection(): PDO {
    include_once "config.php";

    $db = new PDO(
        "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
        DBUSER, DBPASS
    );
    return $db;
}

function countOperatingSystemVersions(): int {
    try {
        $db = initializeDatabaseConnection();
        $statement = $db->prepare("SELECT COUNT(*) FROM operating_systems");
        $statement->execute();
        $cols = $statement->fetchAll();
        return $cols[0]['COUNT(*)'];
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function fetchOperatingSystems(): array {
    try {
        $db = initializeDatabaseConnection();
        $statement = $db->prepare("SELECT version_name, release_name, darwin, announced, released, last_release FROM operating_systems NATURAL JOIN dates ORDER BY announced");
        $statement->execute();
        return $statement->fetchAll();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function formatVersionColumn(array $col): array {
    $colMod["name"] = $col["version_name"] . " (" . $col["release_name"] . ")";
    $colMod["released"] = substr($col["released"], 0, 4);
    return $colMod;
}

function fetchOsVersionAndRelease(): array {
    try {
        $db = initializeDatabaseConnection();
        $statement = $db->prepare("SELECT version_name, release_name, released FROM operating_systems NATURAL JOIN dates ORDER BY released");
        $statement->execute();
        return array_map("formatVersionColumn", $statement->fetchAll());
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function fetchCurrentDeviceInventory(): array {
    try {
        $db = initializeDatabaseConnection();
        $statement = $db->prepare(
            "SELECT model, model_id, model_number, part_number, serial_number, devices.darwin AS current_darwin, models.darwin AS last_darwin, url
             FROM devices
             CROSS JOIN models USING(model_id)"
        );
        $statement->execute();
        return $statement->fetchAll();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function fetchCurrentInventoryWithOs(): array {
    try {
        $db = initializeDatabaseConnection();
        $statement = $db->prepare(
            "SELECT model, model_release, device_release
             FROM (
                 (SELECT model, release_name AS model_release
                  FROM models
                  CROSS JOIN operating_systems USING(darwin)
                 ) AS model_releases
                 CROSS JOIN
                 (SELECT model, release_name AS device_release
                  FROM operating_systems
                  CROSS JOIN devices USING(darwin)
                  CROSS JOIN models USING(model_id)
                 ) AS device_releases
                 USING(model)
             )"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

?>
