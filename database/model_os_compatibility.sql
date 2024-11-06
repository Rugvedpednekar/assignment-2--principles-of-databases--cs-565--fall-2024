CREATE TABLE IF NOT EXISTS model_os_compatibility (
    model_id INT,
    installed_os VARCHAR(50),
    last_supported_os VARCHAR(50),
    FOREIGN KEY (model_id) REFERENCES models(id)
);