CREATE TABLE IF NOT EXISTS macos_versions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    version_name VARCHAR(50) NOT NULL,
    release_name VARCHAR(50),
    darwin_os_number FLOAT,
    date_announced DATE,
    date_released DATE,
    latest_release_date DATE
);


