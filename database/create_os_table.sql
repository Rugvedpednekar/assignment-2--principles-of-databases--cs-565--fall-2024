CREATE TABLE IF NOT EXISTS os (
  version_name   VARCHAR(100)  NOT NULL,
  release_name   VARCHAR(100)  NOT NULL,
  darwin         VARCHAR(20)   NOT NULL,
  url            VARCHAR(100)  DEFAULT NULL,
  comment        TINYTEXT     DEFAULT NULL,

  PRIMARY KEY (darwin)
);
