CREATE TABLE IF NOT EXISTS models (
    id INT PRIMARY KEY AUTO_INCREMENT,
    model_name VARCHAR(100) NOT NULL,
    model_identifier VARCHAR(50),
    model_number VARCHAR(50),
    part_number VARCHAR(50),
    serial_number VARCHAR(50) UNIQUE,
    darwin_os_number FLOAT,
    latest_support_darwin_os FLOAT,
    url VARCHAR(255)
);

