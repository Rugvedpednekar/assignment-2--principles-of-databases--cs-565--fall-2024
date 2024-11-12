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
        $statement = $db->prepare("SELECT COUNT(*) FROM os");
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
        $statement = $db->prepare("SELECT version_name, release_name, darwin, announced, released, last_release FROM os NATURAL JOIN dates ORDER BY announced");
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
        $statement = $db->prepare("SELECT version_name, release_name, released FROM os NATURAL JOIN dates ORDER BY released");
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
            "SELECT models.model,
                    models.model_id,
                    models.model_number,
                    models.part_number,
                    models.serial_number,
                    models.darwin AS current_darwin,
                    os.darwin AS last_darwin,
                    models.url  -- Explicitly select `models.url`
             FROM models
             LEFT JOIN os ON models.darwin = os.darwin"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
            "SELECT models.model,
                    os_release.release_name AS model_release,
                    installed_release.release_name AS device_release
             FROM models
             JOIN os AS os_release ON models.darwin = os_release.darwin
             JOIN os AS installed_release ON models.darwin = installed_release.darwin"
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
