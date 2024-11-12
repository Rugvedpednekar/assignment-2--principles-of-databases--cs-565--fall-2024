CREATE TABLE IF NOT EXISTS models (
    model         VARCHAR(100) NOT NULL,
    model_id      VARCHAR(50)  NOT NULL,
    model_number  VARCHAR(50)  NOT NULL,
    part_number   VARCHAR(50)  NOT NULL,
    url           VARCHAR(255) NOT NULL,
    darwin        VARCHAR(20)  NOT NULL,

  PRIMARY KEY(model_id)
);
