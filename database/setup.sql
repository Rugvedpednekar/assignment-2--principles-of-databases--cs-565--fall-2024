\W -- Enable all warnings

DROP DATABASE IF EXISTS `computer_inventory`;
CREATE DATABASE IF NOT EXISTS `computer_inventory` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;

CREATE USER IF NOT EXISTS 'computer_inventory_manager'@'localhost' IDENTIFIED BY 'b(79yKo8Ei';
GRANT ALL PRIVILEGES ON computer_inventory.* TO 'computer_inventory_manager'@'localhost';

USE computer_inventory;

SOURCE create_os_table.sql;
SOURCE create_dates_table.sql;
SOURCE create_models_table.sql;

-- populate tables
SOURCE populate_os_table.sql;
SOURCE populate_dates_table.sql;
SOURCE populate_models_table.sql;
